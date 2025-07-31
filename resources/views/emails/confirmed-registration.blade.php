<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Registrasi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            line-height: 1.6;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
        }
        .header {
            background-color: #0c724c;
            color: white;
            text-align: center;
            padding: 20px;
            margin: -20px -20px 20px -20px;
        }
        .content {
            padding: 20px 0;
        }
        .info-box {
            background-color: #f8f9fa;
            border-left: 4px solid #0c724c;
            padding: 15px;
            margin: 20px 0;
        }
        .button {
            display: inline-block;
            background-color: #0c724c;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            margin: 10px 0;
        }
        .footer {
            text-align: center;
            padding-top: 20px;
            border-top: 1px solid #eee;
            color: #666;
            font-size: 14px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h2>Konfirmasi Registrasi</h2>
            <p>Event Management System</p>
        </div>
        
        <div class="content">
            <h3>Halo {{ $participantName }},</h3>
            
            <p>Terima kasih telah mendaftar! Registrasi Anda telah berhasil diterima dan sedang dalam proses verifikasi.</p>
            
            <div class="info-box">
                <h4>Detail Registrasi:</h4>
                <p><strong>ID Registrasi:</strong> #{{ $registration->id }}</p>
                <p><strong>Event:</strong> {{ $event->title }}</p>
                <p><strong>Tanggal Registrasi:</strong> {{ $registration->created_at->format('d M Y, H:i') }}</p>
                <p><strong>Status:</strong> Menunggu Verifikasi Admin</p>
            </div>
            
            <h4>Langkah Selanjutnya:</h4>
            <ol>
                <li>Admin akan melakukan verifikasi data Anda</li>
                <li>Setelah disetujui, Anda akan mendapat invoice untuk pembayaran</li>
                <li>Upload bukti transfer setelah melakukan pembayaran</li>
                <li>Admin akan memverifikasi pembayaran Anda</li>
                <li>Registrasi selesai!</li>
            </ol>
            
            <p>Anda dapat memantau status registrasi Anda melalui link berikut:</p>
            <p style="text-align: center;">
                <a href="{{ $statusUrl }}" class="button">Cek Status Registrasi</a>
            </p>
            
            <p>Jika ada pertanyaan, silakan hubungi kami melalui:</p>
            <ul>
                <li>Email: admin@mogmain.com</li>
                <li>Phone: +62 123 456 7890</li>
            </ul>
        </div>
        
        <div class="footer">
            <p>Email ini dikirim secara otomatis, mohon tidak membalas email ini.</p>
            <p>&copy; {{ date('Y') }} Event Management System. All rights reserved.</p>
        </div>
    </div>
</body>
</html>
