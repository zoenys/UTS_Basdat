<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Konsultasi - Layanan Psikologi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <h2>Status Konsultasi Anda</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($appointments->isEmpty())
        <p>Tidak ada konsultasi yang sedang berlangsung.</p>
    @else
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Jadwal Konsultasi</th>
                    <th>Nama Psikolog</th>
                    <th>Status Konsultasi</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
            @foreach ($appointments as $appointment)
                <tr>
                    <td>{{ $appointment->schedule->date }} ({{ $appointment->schedule->start_time }} - {{ $appointment->schedule->end_time }})</td>
                    <td>{{ $appointment->schedule->psychologist->name }}</td>
                    <td>
                        @if($appointment->schedule->status === 'done')
                            <span class="text-success">Selesai</span>
                        @elseif($appointment->status === 'approved')
                            <span class="text-primary">Disetujui</span>
                        @elseif($appointment->status === 'pending_payment')
                            <span class="text-warning">Menunggu Pembayaran</span>
                        @else
                            <span class="text-muted">Menunggu Validasi</span>
                        @endif
                    </td>
                    <td>
                        @if ($appointment->schedule->status === 'done')
                            <!-- Tampilkan tombol Selesai jika status jadwal sudah done -->
                            <button class="btn btn-secondary" disabled>Selesai</button>
                        @elseif ($appointment->status === 'approved' && $appointment->room)
                            <!-- Tampilkan tombol Mulai Chat jika sesi disetujui dan room sudah dibuat -->
                            <a href="{{ route('chat.show', $appointment->room->id) }}" class="btn btn-primary">Mulai Chat</a>
                        @elseif ($appointment->status === 'pending_payment')
                            <!-- Tampilkan pesan Menunggu Pembayaran -->
                            <span class="text-muted">Menunggu Pembayaran</span>
                        @else
                            <!-- Tampilkan pesan Menunggu Validasi -->
                            <span class="text-muted">Menunggu Validasi</span>
                        @endif
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    @endif

    <!-- Tombol Back ke halaman daftar psikolog -->
    <div class="mt-3">
        <a href="{{ url('/doctor') }}" class="btn btn-secondary">Kembali ke Daftar Psikolog</a>
    </div>

</div>
</body>
</html>
