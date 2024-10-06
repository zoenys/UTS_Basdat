<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil Pasien</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>Profil Pasien: {{ $patient->name }}</h2>
    <table class="table table-bordered">
        <tr>
            <th>Nama:</th>
            <td>{{ $patient->name }}</td>
        </tr>
        <tr>
            <th>Email:</th>
            <td>{{ $patient->email }}</td>
        </tr>
        <tr>
            <th>Telepon:</th>
            <td>{{ $patient->phone }}</td> <!-- Pastikan kolom phone ada di tabel users -->
        </tr>
        <tr>
            <th>Riwayat Medis:</th>
            <td>{{ $patient->userProfile->medical_history ?? 'Belum ada riwayat medis' }}</td>
        </tr>
    </table>

    <!-- Tombol Kembali dan Mulai Chat -->
    <div class="d-flex justify-content-between">
        <a href="{{ url('/sched') }}" class="btn btn-secondary">Kembali ke Jadwal</a>
        
        <!-- Tombol Mulai Chat -->
        <a href="{{ url('/chat/' . $patient->id) }}" class="btn btn-primary">Mulai Chat</a>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
