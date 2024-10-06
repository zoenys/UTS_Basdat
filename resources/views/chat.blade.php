<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Chat Room UI - Layanan Psikologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- CSS here -->
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
                            <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                        </div>
                    </div>
                    <div class="col-xl-10 col-lg-10 col-md-10">
                        <nav>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<div class="container">
    <div class="chat-room">
        <div class="card">
            <div class="card-header"><h3>Chat Room</h3></div>
            <div class="card-body" id="message_area">
                <!-- Example chat messages -->
                <div class="message-box">
                    <span class="from">Dr. Alvin:</span> Hi there! <br>
                    <span class="time">2:30 PM</span>
                </div>
                <div class="message-box">
                    <span class="from">You:</span> Hello....<br>
                    <span class="time">2:31 PM</span>
                </div>
                <!-- Add more chat bubbles dynamically here -->
            </div>
        </div>

        <form id="chat-room-frm" class="mt-3">
            <div class="input-group">
                <textarea class="form-control" id="chat_message" name="chat_message" placeholder="Type a message..." rows="2"></textarea>
                <div class="input-group-append">
                    <button type="button" class="btn btn-primary">Send <i class="fa fa-paper-plane"></i></button>
                </div>
            </div>
        </form>
    </div>

    <div class="users-online">
        <div class="card">
            <div class="card-header">Users Online</div>
            <div class="card-body" id="user_list">
                <!-- Example user -->
                <div class="user-profile">
                    <img src="assets/img/gallery/team2.png" alt="Dr. Alvin">
                    <span>Dr. Alvin <i class="fa fa-circle text-success"></i></span>
                </div>
                <div class="user-profile">
                    <span>You <i class="fa fa-circle text-success"></i></span>
                </div>
                <!-- Add more users dynamically here -->
            </div>
        </div>
    </div>
</div>

<!-- JS here -->
<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
<script src="{{ asset('assets/js/main.js') }}"></script>

</body>
</html>
