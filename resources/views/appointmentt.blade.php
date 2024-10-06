<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Consultation Schedule - Layanan Psikologi</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <style>
        body {
            background-color: #f0f4f8; /* Softer background */
            font-family: 'Poppins', sans-serif;
        }
        .header-area {
            background: #6ca0dc; /* Soft blue header */
            padding: 10px 0;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        .header-area a {
            color: #fff; /* White link text */
            font-weight: bold;
        }
        .consultation-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            transition: all 0.3s ease;
            margin-bottom: 20px;
        }
        .consultation-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
        }
        .rekam-medis, .chat-button {
            display: inline-block;
            margin-top: 10px;
            padding: 10px 25px;
            border-radius: 50px;
            text-decoration: none;
            font-weight: bold;
            transition: background-color 0.3s ease, transform 0.3s ease;
        }
        .rekam-medis {
            background-color: #007bff;
            color: white;
        }
        .rekam-medis:hover {
            background-color: #0056b3;
            transform: scale(1.05);
        }
        .chat-button {
            background-color: #28a745;
            color: white;
            margin-left: 10px;
        }
        .chat-button:hover {
            background-color: #218838;
            transform: scale(1.05);
        }
        .section-title {
            font-weight: bold;
            font-size: 36px;
            color: #333;
            text-align: center;
            margin-bottom: 50px; /* Space below the title */
        }
        .footer-area {
            background: #343a40;
            padding: 30px 0;
            color: white;
        }
        .footer-copy-right p {
            color: #ddd;
            margin: 0;
            font-size: 14px;
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
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt="Logo"></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="schedule.html">Schedule</a></li>
                                            <li><a href="history.html">History</a></li>
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
        <div class="container section-padding30">
            <div class="section-title">
                <h2>Welcome, Mrs. Han</h2>
                <h3>Jadwal Konsultasi</h3>
            </div>
            <div class="row">
                <!-- Patient 1 -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="consultation-card consultation-online">
                        <h3>John Doe</h3>
                        <p>Jenis Konsultasi: Online</p>
                        <p>Waktu Dijadwalkan: 10:00 AM, 30 September 2024</p>
                        <a href="rekam_medis_1.html" class="rekam-medis">Rekam Medis</a>
                        <a href="chat_john.html" class="chat-button">Chat</a>
                    </div>
                </div>
                <!-- Patient 2 -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="consultation-card consultation-offline">
                        <h3>Jane Smith</h3>
                        <p>Jenis Konsultasi: Offline</p>
                        <p>Waktu Dijadwalkan: 2:00 PM, 30 September 2024</p>
                        <a href="rekam_medis_jane.html" class="rekam-medis">Rekam Medis</a>
                        <a href="chat_jane.html" class="chat-button">Chat</a>
                    </div>
                </div>
                <!-- Patient 3 -->
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="consultation-card consultation-online">
                        <h3>Michael Johnson</h3>
                        <p>Jenis Konsultasi: Online</p>
                        <p>Waktu Dijadwalkan: 3:30 PM, 30 September 2024</p>
                        <a href="rekam_medis_michael.html" class="rekam-medis">Rekam Medis</a>
                        <a href="chat_michael.html" class="chat-button">Chat</a>
                    </div>
                </div>
                <!-- Add more patients as needed -->
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

    <!-- JS here -->
    <script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
