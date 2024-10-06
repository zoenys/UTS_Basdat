<!doctype html>
<html lang="id">
<head>
    <meta charset="utf-8">
    <title>Pembayaran - Layanan Psikologi</title>
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
</head>
<body>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-xl-6">
            <h2>Proses Pembayaran Anda</h2>
            <form action="{{ route('user.schedule.processPayment', $appointment->id) }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="bankAccount">Nomor Rekening</label>
                    <input type="text" class="form-control" id="bankAccount" placeholder="Masukkan Nomor Rekening" required>
                </div>
                <div class="form-group">
                    <label for="bank">Bank</label>
                    <input type="text" class="form-control" id="bank" placeholder="Masukkan Nama Bank" required>
                </div>
                <div class="form-group">
                    <label for="cvv">CVV</label>
                    <input type="text" class="form-control" id="cvv" placeholder="Masukkan CVV" required>
                </div>
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Lanjutkan Pembayaran</button>
                </div>
            </form>
        </div>
    </div>
</div>
</body>
</html>
