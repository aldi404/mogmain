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
        .invoice-details {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        .invoice-details th,
        .invoice-details td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }
        .invoice-details th {
            background-color: #f8f9fa;
            font-weight: bold;
        }
        .invoice-details .total {
            font-weight: bold;
            background-color: #f2f2f2;
        }
        .payment-note {
            margin-top: 20px;
            padding: 10px;
            background-color: #e9f7ef;
            border-left: 5px solid #0c724c;
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

    <!-- Invoice Details -->
    <table class="invoice-details">
        <thead>
            <tr>
                <th>Deskripsi</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>Biaya Registrasi - {{ $registration->registrationForm->event->title }}</td>
                <td>Rp {{ number_format($base_amount, 0, ',', '.') }}</td>
            </tr>
            @if($unique_amount > 0)
            <tr>
                <td>Kode Pembayaran Unik</td>
                <td>Rp {{ number_format($unique_amount, 0, ',', '.') }}</td>
            </tr>
            @endif
        </tbody>
        <tfoot>
            <tr class="total">
                <td><strong>Total Pembayaran</strong></td>
                <td><strong>Rp {{ number_format($total_amount, 0, ',', '.') }}</strong></td>
            </tr>
        </tfoot>
    </table>

    @if($unique_amount > 0)
    <div class="payment-note">
        <p><strong>Penting:</strong> Harap transfer sesuai dengan jumlah <strong>Rp {{ number_format($total_amount, 0, ',', '.') }}</strong></p>
        <p>Kode unik ({{ $unique_amount }}) membantu kami mengidentifikasi pembayaran Anda secara otomatis.</p>
    </div>
    @endif

    <div class="footer">
        <p>Invoice ini dibuat secara otomatis oleh sistem</p>
        <p>{{ config('app.name') }} - {{ now()->format('Y') }}</p>
    </div>
</body>
</html>
