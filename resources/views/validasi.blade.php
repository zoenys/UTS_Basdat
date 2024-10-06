<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Validasi Pembayaran - Layanan Psikologi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>Validasi Pembayaran</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Jadwal Konsultasi</th>
                <th>Nama Pasien</th>
                <th>Status Pembayaran</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->schedule->date }} ({{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }})</td>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <form action="{{ route('admin.approve.payment', $appointment->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success">Validasi Pembayaran</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>
</body>
</html>
