<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>Medical Psychology - Login</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.ico') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/fontawesome-all.min.css') }}">
    <style>
        body {
            background-color: #f7f7f7;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }
        .container {
            display: flex;
            max-width: 900px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
        }
        .header-area {
            flex: 1;
            padding: 60px;
            background-color: #f1f1f1;
            border-radius: 10px 0 0 10px;
            text-align: center;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .header-area img {
            width: 150px;
            margin-bottom: 20px;
        }
        .header-area h2 {
            font-size: 24px;
            color: #333;
        }
        .login-container {
            flex: 1.5;
            padding: 60px;
        }
        .register-link {
            display: block;
            margin-top: 15px;
            text-align: center;
            font-size: 1.1rem;
        }
        .form-group {
            margin-bottom: 20px;
        }
        .btn-primary {
            width: 100%;
            padding: 15px;
            font-size: 1.5rem;
        }
        .alert {
            margin-top: 10px;
        }
    </style>
</head>
<body>

<div class="container">
    <header class="header-area">
        <img src="{{ asset('assets/img/logo/logo.png') }}" alt="Medical Logo">
        <h2>Layanan Psikologi</h2>
    </header>

    <div class="login-container">
        <h3 class="text-center">Login</h3>

        @if(session('status'))
            <div class="alert alert-success">
                {{ session('status') }}
            </div>
        @endif

        @if(session('error'))
            <div class="alert alert-danger">
                {{ session('error') }}
            </div>
        @endif

        @if(session('unauthorized'))
            <div class="alert alert-danger">
                {{ session('unauthorized') }}
            </div>
        @endif

        <form action="{{ url('/login') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Masukkan Email" value="{{ old('email') }}" required>
                @error('email')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" class="form-control" id="password" name="password" placeholder="Masukkan Password" required>
                @error('password')
                    <div class="alert alert-danger mt-2">{{ $message }}</div>
                @enderror
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">Login</button>
            </div>
            <a href="{{ url('/register') }}" class="register-link">Daftar di sini</a>
        </form>
    </div>
</div>

<script src="{{ asset('assets/js/jquery-1.12.4.min.js') }}"></script>
<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>

</body>
</html>
