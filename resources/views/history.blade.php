<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Riwayat Konsultasi - Layanan Psikologi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mt-5">
        <h2>Riwayat Konsultasi Anda</h2>

        @if($rooms->isEmpty())
            <p>Tidak ada riwayat sesi.</p>
        @else
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>Tanggal Konsultasi</th>
                        <th>Psikolog</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($rooms as $room)
                        <tr>
                            <td>{{ $room->appointment->schedule->date }}</td>
                            <td>{{ $room->appointment->schedule->psychologist->name }}</td>
                            <td>
                                <!-- Tombol untuk melihat riwayat tanpa chat -->
                                <a href="{{ route('chat.show', $room->id) }}" class="btn btn-primary">Lihat Riwayat</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Tombol Kembali -->
        <div class="mt-3">
            <a href="{{ url('/sched') }}" class="btn btn-secondary">Kembali ke Halaman Psikolog</a>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.min.js') }}"></script>
</body>
</html>
