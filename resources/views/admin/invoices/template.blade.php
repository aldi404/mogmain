<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Invoice {{ $invoice_number }}</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            color: #2c3e50;
            background-color: #fff;
            line-height: 1.4;
            font-size: 13px;
        }
        
        .container {
            max-width: 800px;
            margin: 0 auto;
            padding: 15px;
        }
        
        .header {
            border-bottom: 2px solid #0c724c;
            margin-bottom: 25px;
            padding-bottom: 15px;
        }
        
        .header-top {
            display: table;
            width: 100%;
        }
        
        .company-info {
            display: table-cell;
            width: 65%;
            vertical-align: top;
        }
        
        .logo {
            font-size: 22px;
            font-weight: bold;
            color: #0c724c;
            margin-bottom: 6px;
            letter-spacing: 1px;
        }
        
        .company-address {
            font-size: 11px;
            color: #7f8c8d;
            line-height: 1.3;
            margin-bottom: 10px;
        }
        
        .invoice-info-header {
            display: table-cell;
            width: 35%;
            text-align: right;
            vertical-align: top;
        }
        
        .invoice-title {
            font-size: 20px;
            font-weight: bold;
            color: #0c724c;
            margin-bottom: 8px;
        }
        
        .invoice-meta {
            font-size: 12px;
            color: #7f8c8d;
        }
        
        .invoice-body {
            display: table;
            width: 100%;
            margin-bottom: 25px;
        }
        
        .bill-to {
            display: table-cell;
            width: 50%;
            vertical-align: top;
            padding-right: 20px;
        }
        
        .invoice-details-info {
            display: table-cell;
            width: 50%;
            vertical-align: top;
        }
        
        .section-title {
            font-size: 14px;
            font-weight: bold;
            color: #0c724c;
            border-bottom: 1px solid #0c724c;
            padding-bottom: 5px;
            margin-bottom: 10px;
        }
        
        .info-row {
            margin-bottom: 6px;
            font-size: 12px;
        }
        
        .info-label {
            font-weight: 600;
            color: #0f5132;
            display: inline-block;
            width: 100px;
        }
        
        .invoice-table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
            border: 1px solid #bdc3c7;
            font-size: 12px;
        }
        
        .invoice-table th {
            background: #0c724c;
            color: white;
            padding: 10px;
            text-align: left;
            font-weight: 600;
        }
        
        .invoice-table td {
            padding: 10px;
            border-bottom: 1px solid #ecf0f1;
        }
        
        .invoice-table .amount {
            text-align: right;
            font-weight: 600;
        }
        
        .total-row {
            background: #e8f5e8;
            font-weight: bold;
            border-top: 2px solid #0c724c;
        }
        
        .total-row td {
            color: #0c724c;
            font-size: 14px;
            padding: 12px 10px;
        }
        
        .payment-info {
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            margin: 20px 0;
        }
        
        .payment-title {
            font-size: 14px;
            font-weight: bold;
            color: #0c724c;
            margin-bottom: 12px;
            border-bottom: 1px solid #0c724c;
            padding-bottom: 6px;
        }
        
        .bank-details {
            background: white;
            border: 1px solid #dee2e6;
            border-radius: 4px;
            padding: 12px;
            margin-bottom: 10px;
        }
        
        .bank-row {
            margin-bottom: 4px;
            font-size: 12px;
        }
        
        .bank-label {
            font-weight: 600;
            color: #0f5132;
            display: inline-block;
            width: 100px;
        }
        
        .important-note {
            background: #e8f5e8;
            border: 1px solid #c3e6c3;
            border-radius: 4px;
            padding: 12px;
            margin: 15px 0;
            border-left: 3px solid #0c724c;
            font-size: 11px;
        }
        
        .important-note p {
            color: #155724;
            margin: 0;
        }
        
        .footer {
            margin-top: 30px;
            text-align: center;
            font-size: 10px;
            color: #95a5a6;
            border-top: 1px solid #ecf0f1;
            padding-top: 15px;
        }
        
        .page-break {
            page-break-before: always;
        }
        
        .qris-page {
            text-align: center;
            padding: 20px 0;
        }
        
        .qris-title {
            font-size: 20px;
            color: #0c724c;
            margin-bottom: 20px;
            font-weight: bold;
        }
        
        .qris-image {
            max-width: 550px;
            width: 100%;
            height: auto;
            margin: 0 auto 20px auto;
            display: block;
            border: 2px solid #0c724c;
            border-radius: 8px;
        }
        
        .qris-instructions {
            max-width: 500px;
            margin: 0 auto;
            text-align: left;
            background: #f8f9fa;
            border: 1px solid #dee2e6;
            border-radius: 6px;
            padding: 15px;
            font-size: 11px;
        }
        
        .instructions-title {
            font-size: 14px;
            color: #0c724c;
            margin-bottom: 12px;
            text-align: center;
            font-weight: bold;
        }
        
        .instruction-step {
            margin-bottom: 8px;
            line-height: 1.4;
            color: #2c3e50;
        }
        
        .step-number {
            display: inline-block;
            background: #0c724c;
            color: white;
            width: 18px;
            height: 18px;
            border-radius: 50%;
            text-align: center;
            line-height: 18px;
            font-size: 10px;
            font-weight: bold;
            margin-right: 8px;
        }
        
        .amount-highlight {
            background: #e8f5e8;
            color: #0c724c;
            padding: 1px 4px;
            border-radius: 3px;
            font-weight: bold;
        }
        
        .status-badge {
            background: #e8f5e8;
            color: #0c724c;
            padding: 2px 6px;
            border-radius: 3px;
            font-size: 10px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container">
        <!-- Halaman 1: Detail Invoice -->
        <div class="header">
            <div class="header-top">
                <div class="company-info">
                    <div class="logo">MOGMAIN - EBMA</div>
                    <div class="company-address">
                        Perum Gunung Sari Indah, Blok V No 16<br>
                        Kel. Kedurus, Kec. Karang Pilang, Surabaya 60223
                    </div>
                </div>
                <div class="invoice-info-header">
                    <div class="invoice-title">INVOICE</div>
                    <div class="invoice-meta">
                        <div style="margin-bottom: 3px;"><strong>{{ $invoice_number }}</strong></div>
                        <div>{{ $created_date->format('d F Y') }}</div>
                    </div>
                </div>
            </div>
        </div>

        <div class="invoice-body">
            <div class="bill-to">
                <div class="section-title">TAGIHAN UNTUK</div>
                <div class="info-row">
                    <div class="info-label">Event:</div>
                    {{ $registration->registrationForm->event->title }}
                </div>
                <div class="info-row">
                    <div class="info-label">Tanggal:</div>
                    {{ $registration->registrationForm->event->event_date->format('d F Y') }}
                </div>
                <div class="info-row">
                    <div class="info-label">Lokasi:</div>
                    {{ $registration->registrationForm->event->location }}
                </div>
            </div>
            <div class="invoice-details-info">
                <div class="section-title">DETAIL INVOICE</div>
                <div class="info-row">
                    <div class="info-label">No. Invoice:</div>
                    {{ $invoice_number }}
                </div>
                <div class="info-row">
                    <div class="info-label">Tgl. Terbit:</div>
                    {{ $created_date->format('d F Y') }}
                </div>
                {{-- <div class="info-row">
                    <div class="info-label">Status:</div>
                    <span class="status-badge">Menunggu Pembayaran</span>
                </div> --}}
            </div>
        </div>

        <!-- Tabel Invoice -->
        <table class="invoice-table">
            <thead>
                <tr>
                    <th style="width: 70%;">Deskripsi</th>
                    <th style="width: 30%;">Jumlah</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        Biaya Registrasi<br>
                        <small style="color: #7f8c8d;">{{ $registration->registrationForm->event->title }}</small>
                    </td>
                    <td class="amount">Rp {{ number_format($base_amount, 0, ',', '.') }}</td>
                </tr>
                @if($unique_amount > 0)
                <tr>
                    <td>
                        Kode Pembayaran Unik<br>
                        <small style="color: #7f8c8d;">Untuk identifikasi otomatis</small>
                    </td>
                    <td class="amount">Rp {{ number_format($unique_amount, 0, ',', '.') }}</td>
                </tr>
                @endif
            </tbody>
            <tfoot>
                <tr class="total-row">
                    <td><strong>TOTAL PEMBAYARAN</strong></td>
                    <td class="amount"><strong>Rp {{ number_format($total_amount, 0, ',', '.') }}</strong></td>
                </tr>
            </tfoot>
        </table>

        @if($unique_amount > 0)
        <div class="important-note">
            <p><strong>Penting:</strong> Transfer sesuai nominal <strong>Rp {{ number_format($total_amount, 0, ',', '.') }}</strong>. Kode unik ({{ $unique_amount }}) membantu identifikasi pembayaran otomatis.</p>
        </div>
        @endif

        <!-- Informasi Pembayaran -->
        <div class="payment-info">
            <div class="payment-title">Metode Pembayaran</div>
            
            <div class="bank-details">
                <div class="bank-row">
                    <div class="bank-label">Transfer Bank:</div>
                    Bank Central Asia (BCA)
                </div>
                <div class="bank-row">
                    <div class="bank-label">No. Rekening:</div>
                    4684977999
                </div>
                <div class="bank-row">
                    <div class="bank-label">Atas Nama:</div>
                    Energi Bersama Membangun
                </div>
            </div>
            
            <div style="text-align: center; font-size: 12px; color: #2c3e50; font-weight: 600;">
                Alternatif: Pembayaran QRIS (Lihat halaman berikutnya)
            </div>
        </div>

        <div class="footer">
            <p><strong>Invoice ini dibuat otomatis oleh sistem</strong></p>
            <p>© MOGMAIN - EBMA {{ now()->format('Y') }}</p>
        </div>
    </div>

    <!-- Halaman 2: QRIS -->
    <div class="page-break">
        <div class="container">
            <div class="qris-page">
                <div class="qris-title">Pembayaran QRIS</div>
                
                <img src="{{ public_path('img/QRIS_MOGMAIN.jpg') }}" alt="QRIS MOGMAIN" class="qris-image">
                
                <div style="background: #e8f5e8; border: 1px solid #c3e6c3; border-radius: 4px; padding: 10px; margin-top: 15px; border-left: 3px solid #063d29;">
                    <p style="margin: 0; color: #063d29; font-weight: 500;">
                        <strong>Catatan:</strong> Pastikan nominal sesuai dengan total invoice yaitu : <span class="amount-highlight">Rp {{ number_format($total_amount, 0, ',', '.') }}</span>
                    </p>
                </div>
                {{-- <div class="qris-instructions">
                    <div class="instructions-title">Cara Pembayaran</div>
                    
                    <div class="instruction-step">
                        <span class="step-number">1</span>
                        Buka aplikasi mobile banking atau e-wallet
                    </div>
                    <div class="instruction-step">
                        <span class="step-number">2</span>
                        Pilih menu "Scan QR" atau "QRIS"
                    </div>
                    <div class="instruction-step">
                        <span class="step-number">3</span>
                        Scan kode QR di atas
                    </div>
                    <div class="instruction-step">
                        <span class="step-number">4</span>
                        Masukkan nominal: <span class="amount-highlight">Rp {{ number_format($total_amount, 0, ',', '.') }}</span>
                    </div>
                    <div class="instruction-step">
                        <span class="step-number">5</span>
                        Konfirmasi pembayaran dan upload bukti transfer
                    </div>
                    
                </div> --}}
            </div>
        </div>
    </div>
</body>
</html>
