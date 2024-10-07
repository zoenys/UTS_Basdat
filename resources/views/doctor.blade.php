<!doctype html>
<html class="no-js" lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Our Psychologists</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
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
                                        <li><a href="index.html">Home</a></li>
                                        <li><a href="about.html">About</a></li>
                                        <li><a href="about.html">Psychologists</a></li>
                                        <li><a href="contact.html">Contact</a></li>
                                    </ul>
                                </nav>
                            </div>
                            <div class="header-right-btn f-right d-none d-lg-block ml-30">
                                @if(Auth::check())
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                                        @csrf
                                        <button type="submit" class="btn header-btn ml-3" style="background-color: #dc3545; color: white;">Logout</button>
                                    </form>
                                @endif
                            </div>
                        </div>
                    </div>   
                    <div class="col-12">
                        <div class="mobile_menu d-block d-lg-none"></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<main>
    <div class="slider-area2">
        <div class="slider-height2 d-flex align-items-center">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="hero-cap hero-cap2 text-center">
                            <h2>
                                Welcome, 
                                @if(Auth::check())
                                    {{ Auth::user()->name }}
                                @else
                                    Guest
                                @endif
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="team-area section-padding30">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-6">
                    <div class="section-tittle text-center mb-100">
                        <h2>Our Psychologists</h2>
                    </div>
                </div>
            </div>

            <div class="row">
                @foreach($psychologists as $psychologist)
                    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12">
                        <div class="single-team mb-30 shadow-lg p-3 bg-white rounded">
                            <div class="team-img">
                                <img src="{{ asset('assets/img/default-profile.png') }}" alt="{{ $psychologist->user->name }}" class="img-fluid">
                            </div>
                            <div class="team-caption text-center mt-3">
                                <h3>{{ $psychologist->user->name }}</h3>
                                <span>{{ $psychologist->specialization }}</span>
                                <p>Experience: {{ $psychologist->experience }} years</p>
                                <p>Hire Date: {{ $psychologist->hire_date }}</p>
                                <div class="consult-btn mt-20">
                                    <!-- Mengirim ID psikolog pada URL -->
                                    <a href="{{ url('/choose-schedule?psychologistId=' . $psychologist->user->id) }}" class="btn btn-primary">Konsultasi Sekarang</a>
                                </div>
                                
                                <!-- Tambahkan tombol Cek Status Konsultasi -->
                                <div class="status-btn mt-20">
                                    <!-- Mengirim ID psikolog pada URL -->
                                    <a href="{{ url('/status?psychologistId=' . $psychologist->user->id) }}" class="btn btn-secondary">Cek Status Konsultasi</a>
                                </div>
                            </div>
                            
                        </div>
                    </div>
                @endforeach            
            </div>
        </div>
    </div>
</main>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
