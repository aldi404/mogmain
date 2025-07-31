<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice_number }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            color: #333;
        }
        .header {
            text-align: center;
            border-bottom: 2px solid #0c724c;
            padding-bottom: 20px;
            margin-bottom: 30px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #0c724c;
        }
        .invoice-title {
            font-size: 18px;
            margin: 10px 0;
        }
        .invoice-info {
            display: table;
            width: 100%;
            margin-bottom: 30px;
        }
        .invoice-info > div {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        .info-section h4 {
            color: #0c724c;
            margin-bottom: 10px;
        }
        .details-table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 30px;
        }
        .details-table th,
        .details-table td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .details-table th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .total-section {
            text-align: right;
            margin-top: 20px;
        }
        .total-amount {
            font-size: 18px;
            font-weight: bold;
            color: #0c724c;
        }
        .footer {
            margin-top: 50px;
            text-align: center;
            font-size: 12px;
            color: #666;
        }
    </style>
</head>
<body>
    <div class="header">
        <div class="logo">{{ config('app.name', 'Event Management') }}</div>
        <div class="invoice-title">INVOICE REGISTRASI EVENT</div>
    </div>

    <div class="invoice-info">
        <div class="info-section">
            <h4>Informasi Invoice</h4>
            <p><strong>No. Invoice:</strong> {{ $invoice_number }}</p>
            <p><strong>Tanggal:</strong> {{ $created_date->format('d M Y') }}</p>
            <p><strong>Status:</strong> Menunggu Pembayaran</p>
        </div>
        <div class="info-section">
            <h4>Informasi Event</h4>
            <p><strong>Event:</strong> {{ $registration->registrationForm->event->title }}</p>
            <p><strong>Tanggal Event:</strong> {{ $registration->registrationForm->event->event_date->format('d M Y') }}</p>
            <p><strong>Lokasi:</strong> {{ $registration->registrationForm->event->location }}</p>
        </div>
    </div>

    <table class="details-table">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th>Jumlah</th>
                <th>Harga Satuan</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Biaya Registrasi - {{ $registration->registrationForm->event->title }}</td>
                <td>1</td>
                <td>Rp {{ number_format($amount, 0, ',', '.') }}</td>
                <td>Rp {{ number_format($amount, 0, ',', '.') }}</td>
            </tr>
        </tbody>
    </table>

    <div class="total-section">
        <p class="total-amount">Total Pembayaran: Rp {{ number_format($amount, 0, ',', '.') }}</p>
    </div>

    <div style="margin-top: 30px;">
        <h4>Informasi Pembayaran</h4>
        <p><strong>Bank:</strong> BCA</p>
        <p><strong>No. Rekening:</strong> 1234567890</p>
        <p><strong>Atas Nama:</strong> Event Management System</p>
        <p><strong>Jumlah Transfer:</strong> Rp {{ number_format($amount, 0, ',', '.') }}</p>
    </div>

    <div style="margin-top: 30px;">
        <h4>Catatan:</h4>
        <ul>
            <li>Harap transfer sesuai dengan jumlah yang tertera pada invoice</li>
            <li>Upload bukti transfer melalui sistem untuk verifikasi</li>
            <li>Hubungi admin jika ada pertanyaan terkait pembayaran</li>
        </ul>
    </div>

    <div class="footer">
        <p>Invoice ini dibuat secara otomatis oleh sistem</p>
        <p>{{ config('app.name') }} - {{ now()->format('Y') }}</p>
    </div>
</body>
</html>
