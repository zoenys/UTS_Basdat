<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Schedule Management - Psychologist</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Arial', sans-serif;
        }
        .container {
            margin-top: 50px;
            max-width: 100%;
            padding: 0 15px;
        }
        .schedule-card, .form-card {
            background-color: white;
            padding: 30px;
            border-radius: 15px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }
        h2 {
            font-size: 2rem;
            color: #333;
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            border-bottom: 2px solid #007bff;
            padding-bottom: 10px;
        }
        .form-group label {
            font-weight: bold;
            color: #555;
        }
        .form-control {
            height: 50px;
            font-size: 1rem;
            border-radius: 5px;
            border: 1px solid #ced4da;
        }
        .form-control:focus {
            border-color: #007bff;
            box-shadow: 0 0 5px rgba(0, 123, 255, 0.25);
        }
        .btn-submit {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1.1rem;
            width: 100%;
            text-transform: uppercase;
            font-weight: bold;
        }
        .btn-submit:hover {
            background-color: #0056b3;
            transform: translateY(-2px);
        }
        .table {
            margin-top: 20px;
        }
        .table thead th {
            background-color: #007bff;
            color: white;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-size: 1rem;
        }
        .table tbody tr:hover {
            background-color: #f0f0f5;
        }
        .table td {
            vertical-align: middle;
            text-align: center;
        }
        .table td.booked {
            background-color: #ff4d4d;
            color: white;
            font-weight: bold;
        }
        .table td.available {
            background-color: #28a745;
            color: white;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <header>
        <div class="header-area">
            <div class="main-header header-sticky">
                <div class="container-fluid">
                    <div class="row align-items-center">
                        <div class="col-xl-2 col-lg-2 col-md-1">
                            <div class="logo">
                                <a href="index"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="index">Psychologist</a></li>
                                            <li><a href="#">Hello, {{ Auth::user()->name }}</a></li>
                                            <li>
                                                <a href="{{ route('logout') }}"
                                                   onclick="event.preventDefault();
                                                   document.getElementById('logout-form').submit();">
                                                   Logout
                                                </a>
                                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                                    @csrf
                                                </form>
                                            </li>
                                        </ul>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>

    <main>
        <div class="container">
            <!-- Form untuk menambah jadwal -->
            <div class="form-card">
                <h2>Hello, {{ Auth::user()->name }}. Set Your Available Schedule</h2>
                
                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if($errors->any())
                    <div class="alert alert-danger">{{ $errors->first() }}</div>
                @endif

                <form action="{{ route('psychologist.schedule.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="date">Select Date:</label>
                        <input type="date" id="date" name="date" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="start_time">Start Time:</label>
                        <input type="time" id="start_time" name="start_time" class="form-control" required>
                    </div>
                    <div class="form-group">
                        <label for="end_time">End Time:</label>
                        <input type="time" id="end_time" name="end_time" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-submit">Save Schedule</button>
                </form>
            </div>

            <!-- Daftar jadwal yang telah dibuat -->
            <div class="schedule-card">
                <h2>Your Schedule Overview</h2>
                @if($schedules->isNotEmpty())
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Start Time</th>
                                <th>End Time</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($schedules as $schedule)
                                <tr>
                                    <td>{{ $schedule->date }}</td>
                                    <td>{{ $schedule->start_time }}</td>
                                    <td>{{ $schedule->end_time }}</td>
                                    <td class="{{ $schedule->status == 'booked' ? 'booked' : 'available' }}">
                                        {{ ucfirst($schedule->status) }}
                                    </td>
                                    <td>
                                        @if($schedule->status == 'booked')
                                            @foreach($schedule->appointments as $appointment)
                                                <a href="{{ url('/sched/' . $appointment->user->id) }}" class="btn btn-primary">View Patient</a>
                                            @endforeach
                                        @else
                                            <span class="text-muted">No Bookings</span>
                                        @endif
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <p>No schedules available</p>
                @endif
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-area section-bg">
            <div class="container">
                <div class="footer-bottom">
                    <div class="row d-flex justify-content-between align-items-center">
                        <div class="col-xl-9 col-lg-8">
                            <div class="footer-copy-right">
                                <p>&copy;<script>document.write(new Date().getFullYear());</script> All rights reserved.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script src="{{ asset('assets/js/vendor/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

    <!-- Tambahkan JavaScript untuk mengatur tanggal minimal hari ini -->
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const today = new Date().toISOString().split('T')[0];
            document.getElementById("date").setAttribute('min', today);
        });
    </script>
</body>
</html>
