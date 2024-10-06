<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Rekam Medis - John Doe</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">

    <style>
        body {
            background-color: #f0f4f8;
            font-family: 'Poppins', sans-serif;
        }
        .header-area {
            background: #6ca0dc;
            padding: 10px 0;
        }
        .header-area a {
            color: #fff;
            font-weight: bold;
        }
        .container {
            margin-top: 40px;
        }
        .record-card {
            background: white;
            padding: 30px;
            border-radius: 10px;
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.1);
        }
        h2 {
            font-size: 2rem;
            text-align: center;
            font-weight: bold;
            margin-bottom: 30px;
        }
        h3 {
            font-size: 1.5rem;
            margin-bottom: 20px;
            font-weight: bold;
        }
        .btn-back, .btn-primary {
            margin-top: 20px;
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
                                <a href="index.html"><img src="assets/img/logo/logo.png" alt=""></a>
                            </div>
                        </div>
                        <div class="col-xl-10 col-lg-10 col-md-10">
                            <div class="menu-main d-flex align-items-center justify-content-end">
                                <div class="main-menu f-right d-none d-lg-block">
                                    <nav>
                                        <ul id="navigation">
                                            <li><a href="schedule">Schedule</a></li>
                                            <li><a href="history">Appointment</a></li>

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
            <div class="record-card">
                <h2>Rekam Medis - John Doe</h2>
                <h3>Patient Information</h3>
                <p><strong>Name:</strong> John Doe</p>
                <p><strong>Age:</strong> 30</p>
                <p><strong>Gender:</strong> Male</p>
                <p><strong>Consultation Type:</strong> Online</p>
                <p><strong>Scheduled Time:</strong> 10:00 AM, September 30, 2024</p>

                <h3>Medical History</h3>
                <ul>
                    <li>Allergy: Penicillin</li>
                    <li>Previous Conditions: Hypertension</li>
                    <li>Current Medications: Lisinopril</li>
                </ul>

                <h3>Treatment Plan</h3>
                <p>Follow-up in 2 weeks. Continue medication and monitor blood pressure.</p>
                
                <h3>Notes</h3>
                <p>Patient reported feeling better after starting treatment.</p>
                <a href="edit_record.html" class="btn btn-primary">Edit Medical Record</a>
            </div>
        </div>
    </main>

    <footer>
        <div class="footer-area">
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
