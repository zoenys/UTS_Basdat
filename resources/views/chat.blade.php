<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Chat Room UI - Layanan Psikologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <style>
        body {
            display: flex;
            flex-direction: column;
            height: 100vh;
            margin: 0;
            background-color: #f7f7f7;
        }
        .container {
            flex-grow: 1;
            display: flex;
            padding: 20px;
        }
        .chat-room {
            flex: 2;
            margin-right: 20px;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .users-online {
            flex: 1;
            background: white;
            border-radius: 5px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .message-box {
            padding: 10px;
            margin: 10px 0;
            border-radius: 5px;
            background-color: #e6e6e6;
        }
        .message-box .from {
            font-weight: bold;
        }
        .message-box .time {
            font-size: 12px;
            color: gray;
            text-align: right;
        }
        #message_area {
            height: 400px;
            overflow-y: auto;
            padding: 15px;
            border: 1px solid #ddd;
            border-radius: 5px;
            background-color: #f9f9f9;
        }
        .input-group {
            margin-top: 10px;
        }
        .user-profile {
            display: flex;
            align-items: center;
            margin-bottom: 10px;
        }
        .user-profile img {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            margin-right: 10px;
        }
    </style>
</head>
<body>

<header>
    <div class="header-area">
        <div class="main-header header-sticky">
            <div class="container-fluid">
                <div class="row align-items-center justify-content-center">
                    <div class="col-auto">
                        <div class="logo">
                            <a href="index.html"><img src="{{ asset('assets/img/logo/logo.png') }}" alt="Logo"></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="chat-room">
        <div class="card">
            <div class="card-header"><h3>Chat Room</h3>
                <span id="timer"></span> <!-- Timer akan ditampilkan di sini --></div>
            <div class="card-body" id="message_area">
                @foreach($room->messages as $message)
                    <div class="message-box">
                        <span class="from">{{ $message->sender->name }}:</span> {{ $message->message }}<br>
                        <span class="time">{{ $message->created_at->format('h:i A') }}</span>
                    </div>
                @endforeach
            </div>
        </div>

        <form id="chat-room-frm" class="mt-3" method="POST" action="{{ route('chat.send', $room->id) }}">
            @csrf
            <div class="input-group">
                <textarea class="form-control" id="chat_message" name="message" placeholder="Type a message..." rows="2"></textarea>
                <div class="input-group-append">
                    <button type="submit" class="btn btn-primary">Send <i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="users-online">
        <div class="card">
            <div class="card-header">
                Users Online
                <span id="timer"></span> <!-- Timer akan ditampilkan di sini -->
            </div>
            <div class="card-body" id="user_list">
                @foreach($users as $user)
                    <div class="user-profile">
                        <img src="{{ asset('assets/img/gallery/default-profile.png') }}" alt="{{ $user->name }}">
                        <span>{{ $user->name }} 
                            <!-- Tampilkan tanda hijau jika user aktif (online) -->
                            @if(Cache::has('user-is-online-' . $user->id))
                                <i class="fa fa-circle text-success"></i>
                            @else
                                <i class="fa fa-circle text-secondary"></i>
                            @endif
                        </span>
                    </div>
                @endforeach
            </div>
        </div>

        @if(Auth::user()->role === 'psikolog')
        <form method="POST" action="{{ route('chat.endSession', $room->id) }}">
            @csrf
            <button type="submit" class="btn btn-danger mt-3">Akhiri Sesi</button>
        </form>
        @endif
    </div>
</div>

<!-- JS here -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script>
    // Hitung mundur timer berdasarkan waktu dari backend (dalam detik)
    let duration = {{ $remainingTime }};
    let countdownTimer = setInterval(function() {
        if (duration <= 0) {
            clearInterval(countdownTimer);
            window.location.href = "{{ Auth::user()->role === 'psikolog' ? route('psychologist.schedule.index') : route('user.schedule.status') }}";
        } else {
            let minutes = Math.floor(duration / 60);
            let seconds = duration % 60;
            document.getElementById("timer").innerText = minutes + ":" + (seconds < 10 ? "0" : "") + seconds;
            duration--;
        }
    }, 1000);
</script>

</body>
</html>
