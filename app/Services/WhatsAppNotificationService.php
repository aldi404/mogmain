<?php

namespace App\Services;

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use App\Models\EventRegistration;

class WhatsAppNotificationService
{
    protected $whatsappUrl;

    public function __construct()
    {
        $this->whatsappUrl = config('whatsapp.url');
    }

    /**
     * Send WhatsApp notification for new registration
     */
    public function sendNewRegistrationNotification(EventRegistration $registration)
    {
        try {
            $phoneNumber = $this->extractPhoneNumber($registration);
            if (!$phoneNumber) {
                Log::warning('No phone number found for registration', ['id' => $registration->id]);
                return false;
            }

            $eventName = $registration->registrationForm->event->title;
            $statusUrl = route('registrasi.status', $registration->token);

            $message = "*Registrasi Berhasil Diterima!*\n\n";
            $message .= "Halo! Terima kasih telah mendaftar untuk event:\n";
            $message .= "*{$eventName}*\n\n";
            $message .= "Data pendaftaran Anda telah kami terima dan sedang dalam proses pengecekan oleh tim kami.\n\n";
            $message .= "*Status Pendaftaran:* Menunggu Verifikasi\n\n";
            $message .= "Anda dapat memantau status pendaftaran melalui tautan berikut:\n";
            $message .= "{$statusUrl}\n\n";
            $message .= "Kami akan memberitahu Anda setelah proses verifikasi selesai, sekaligus mengirimkan invoice untuk pembayaran.\n";
            $message .= "Silahkan hubungi nomor ini jika ada pertanyaan atau bantuan lebih lanjut\n\n";

            $message .= "Terima kasih!\n*Tim MOGMAIN - EBMA*";

            return $this->sendWhatsAppMessage($phoneNumber, $message);
        } catch (\Exception $e) {
            Log::error('Failed to send new registration notification', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send WhatsApp notification when data is approved
     */
    public function sendDataApprovedNotification(EventRegistration $registration)
    {
        try {
            $phoneNumber = $this->extractPhoneNumber($registration);
            if (!$phoneNumber) {
                Log::warning('No phone number found for registration', ['id' => $registration->id]);
                return false;
            }

            $eventName = $registration->registrationForm->event->title;
            $invoiceUrl = route('registrasi.invoice', $registration->token);
            $uploadUrl = route('registrasi.upload_invoice', $registration->token);
            $statusUrl = route('registrasi.status', $registration->token);
            $baseFee = $registration->registrationForm->event->registration_fee;
            $totalAmount = $registration->total_amount;
            $uniqueAmount = $registration->unique_amount;

            $message = "*Data Pendaftaran Disetujui!*\n\n";
            $message .= "Halo! Terima kasih telah mendaftar:\n";
            $message .= "Event: *{$eventName}*\n";
            $message .= "Status Pendaftaran: *Data Disetujui*\n\n";
            $message .= "*Informasi Pembayaran:*\n";

            if ($baseFee && $baseFee > 0) {
                $message .= "• Biaya Registrasi: *Rp " . number_format($baseFee, 0, ',', '.') . "*\n";
                $message .= "• Kode Unik: *{$uniqueAmount}*\n";
                $message .= "• *Total Pembayaran: Rp " . number_format($totalAmount, 0, ',', '.') . "*\n\n";
                $message .= "*Metode Pembayaran:*\n";
                $message .= "• Transfer Bank:\n";
                $message .= "  BCA - No. Rekening: 4684977999\n";
                $message .= "  a.n. Energi Bersama Membangun\n";
                $message .= "• QRIS (tersedia di halaman invoice)\n";
                $message .= "*Invoice:* {$invoiceUrl}\n\n";
                $message .= "Upload bukti pembayaran di:\n{$uploadUrl}\n\n";
                $message .= "*Penting:* \n";
                $message .= "• Transfer sesuai nominal : *Rp " . number_format($totalAmount, 0, ',', '.') . "*\n";
                $message .= "• Kode unik untuk identifikasi pembayaran Anda\n";
                $message .= "• Upload bukti transfer untuk menyelesaikan registrasi\n\n";
                $message .= "Anda dapat memantau status pendaftaran melalui tautan berikut:\n";
                $message .= "{$statusUrl}\n\n";
                $message .= "Silahkan hubungi nomor ini jika ada pertanyaan atau bantuan lebih lanjut\n\n";
            } else {
                $message .= "Event ini *GRATIS* - tidak ada biaya registrasi.\n";
                $message .= "Registrasi Anda sudah *SELESAI*!\n\n";
            }

            $message .= "Terima kasih!\n*Tim MOGMAIN - EMBA*";

            return $this->sendWhatsAppMessage($phoneNumber, $message);
        } catch (\Exception $e) {
            Log::error('Failed to send data approved notification', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Send WhatsApp notification when registration is completed
     */
    public function sendRegistrationCompletedNotification(EventRegistration $registration)
    {
        try {
            $phoneNumber = $this->extractPhoneNumber($registration);
            if (!$phoneNumber) {
                Log::warning('No phone number found for registration', ['id' => $registration->id]);
                return false;
            }

            $eventName = $registration->registrationForm->event->title;
            $statusUrl = route('registrasi.status', $registration->token);
            $eventDate = $registration->registrationForm->event->event_date->format('d F Y');
            $eventLocation = $registration->registrationForm->event->location;

            $message = "*Registrasi SELESAI!*\n\n";
            $message .= "Selamat! Registrasi Anda telah *BERHASIL*.\n\n";
            $message .= "*Event:* {$eventName}\n";
            $message .= "*Tanggal:* {$eventDate}\n";
            $message .= "*Lokasi:* {$eventLocation}\n\n";
            $message .= "*Status:* TERDAFTAR\n\n";
            $message .= "Anda dapat melihat status pendaftaran melalui tautan berikut:\n";
            $message .= "{$statusUrl}\n\n";
            $message .= "Silahkan hubungi nomor ini jika ada pertanyaan atau bantuan lebih lanjut\n\n";
            $message .= "Sampai jumpa di event!\n*Tim MOGMAIN - EBMA*";

            return $this->sendWhatsAppMessage($phoneNumber, $message);
        } catch (\Exception $e) {
            Log::error('Failed to send registration completed notification', [
                'registration_id' => $registration->id,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }

    /**
     * Extract phone number from registration data
     */
    protected function extractPhoneNumber(EventRegistration $registration)
    {
        $participantData = $registration->participant_data;

        // Get phone number from 'name' field (based on your example)
        $phoneNumber = $participantData['name'] ?? null;

        if (!$phoneNumber) {
            return null;
        }

        // Format phone number
        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);

        // Convert to international format
        if (substr($phoneNumber, 0, 1) === '0') {
            $phoneNumber = '62' . substr($phoneNumber, 1);
        } elseif (substr($phoneNumber, 0, 2) !== '62') {
            $phoneNumber = '62' . $phoneNumber;
        }

        return $phoneNumber;
    }

    /**
     * Send WhatsApp message via API
     */
    protected function sendWhatsAppMessage($phoneNumber, $message)
    {
        try {
            $token = Cache::get("whatsapp:token");
            $senderNumbers = Cache::get("whatsapp:no", []);

            if (empty($token)) {
                Log::error('WhatsApp token not available');
                return false;
            }

            if (empty($senderNumbers)) {
                Log::error('No WhatsApp sender numbers available');
                return false;
            }

            $jid = $senderNumbers[0]; // Use first available sender

            Log::info('Sending WhatsApp message', [
                'to' => $phoneNumber,
                'from' => $jid,
                'message_length' => strlen($message)
            ]);

            $response = Http::withoutVerifying()->asJson()
                ->withHeaders(['Authorization' => 'Bearer ' . $token])
                ->post($this->whatsappUrl . '/api/wa/send', [
                    'jid' => $jid,
                    'to' => $phoneNumber,
                    'message' => $message,
                    'url' => '',
                    'type' => 1
                ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully', [
                    'to' => $phoneNumber,
                    'response' => $response->json()
                ]);
                return true;
            } else {
                Log::error('WhatsApp message failed', [
                    'to' => $phoneNumber,
                    'status' => $response->status(),
                    'response' => $response->body()
                ]);
                return false;
            }
        } catch (\Exception $e) {
            Log::error('WhatsApp send error', [
                'to' => $phoneNumber,
                'error' => $e->getMessage()
            ]);
            return false;
        }
    }
}
