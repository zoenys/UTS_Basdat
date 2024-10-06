<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Validasi Pembayaran - Admin</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">

    <!-- Tombol Logout -->
    <div class="d-flex justify-content-end mb-4">
        <form action="{{ route('logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-danger">Logout</button>
        </form>
    </div>

    <h2 class="text-center">Validasi Pembayaran</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    <!-- Daftar pembayaran yang menunggu validasi -->
    <h3>Menunggu Validasi</h3>
    @if($pendingAppointments->isEmpty())
        <p class="text-center">Tidak ada pembayaran yang perlu divalidasi saat ini.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Nama Psikolog</th>
                <th>Tanggal Konsultasi</th>
                <th>Waktu</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
            </thead>
            <tbody>
            @foreach($pendingAppointments as $appointment)
                <tr>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ $appointment->schedule->psychologist->name }}</td>
                    <td>{{ $appointment->schedule->date }}</td>
                    <td>{{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                    <td>
                        <form action="{{ route('admin.approve.payment', $appointment->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-success">Approve</button>
                        </form>

                        <form action="{{ route('admin.reject.payment', $appointment->id) }}" method="POST" style="display: inline-block;">
                            @csrf
                            <button type="submit" class="btn btn-danger">Reject</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <!-- Daftar pembayaran yang sudah divalidasi -->
    <h3>Riwayat Validasi Pembayaran</h3>
    @if($validatedAppointments->isEmpty())
        <p class="text-center">Belum ada pembayaran yang divalidasi.</p>
    @else
        <table class="table table-bordered mt-4">
            <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Nama Psikolog</th>
                <th>Tanggal Konsultasi</th>
                <th>Waktu</th>
                <th>Status</th>
            </tr>
            </thead>
            <tbody>
            @foreach($validatedAppointments as $appointment)
                <tr>
                    <td>{{ $appointment->user->name }}</td>
                    <td>{{ $appointment->schedule->psychologist->name }}</td>
                    <td>{{ $appointment->schedule->date }}</td>
                    <td>{{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }}</td>
                    <td>{{ ucfirst($appointment->status) }}</td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

</div>

<script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
