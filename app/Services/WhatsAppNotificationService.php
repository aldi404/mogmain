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

            $message = "🎉 *Registrasi Berhasil Diterima!*\n\n";
            $message .= "Halo! Terima kasih telah mendaftar untuk event:\n";
            $message .= "📅 *{$eventName}*\n\n";
            $message .= "✅ Data pendaftaran Anda telah kami terima dan sedang dalam proses pengecekan oleh tim kami.\n\n";
            $message .= "📋 *Status Pendaftaran:* Menunggu Verifikasi\n\n";
            $message .= "🔗 Cek status pendaftaran Anda di:\n{$statusUrl}\n\n";
            $message .= "⏰ Tim kami akan memverifikasi data dalam 1x24 jam.\n\n";
            $message .= "Terima kasih!\n*Tim MOGMAIN*";

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
            $fee = $registration->registrationForm->event->registration_fee;

            $message = "✅ *Data Pendaftaran Disetujui!*\n\n";
            $message .= "Halo! Kabar baik untuk Anda:\n\n";
            $message .= "📅 Event: *{$eventName}*\n";
            $message .= "✅ Status: *Data Disetujui*\n\n";
            $message .= "💰 *Informasi Pembayaran:*\n";

            if ($fee && $fee > 0) {
                $message .= "💵 Biaya Registrasi: *Rp " . number_format($fee, 0, ',', '.') . "*\n\n";
                $message .= "📄 *Invoice:* {$invoiceUrl}\n\n";
                $message .= "📤 Upload bukti pembayaran di:\n{$uploadUrl}\n\n";
                $message .= "⚠️ *Penting:* Segera lakukan pembayaran dan upload bukti transfer untuk menyelesaikan registrasi.\n\n";
            } else {
                $message .= "🆓 Event ini *GRATIS* - tidak ada biaya registrasi.\n";
                $message .= "✅ Registrasi Anda sudah *SELESAI*!\n\n";
            }

            $message .= "Terima kasih!\n*Tim MOGMAIN*";

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
            $eventDate = $registration->registrationForm->event->event_date->format('d F Y');
            $eventLocation = $registration->registrationForm->event->location;

            $message = "*Registrasi SELESAI!*\n\n";
            $message .= "Selamat! Registrasi Anda telah *BERHASIL*.\n\n";
            $message .= "*Event:* {$eventName}\n";
            $message .= "*Tanggal:* {$eventDate}\n";
            $message .= "*Lokasi:* {$eventLocation}\n\n";
            $message .= "*Status:* TERDAFTAR\n\n";
            $message .= "*Info lebih lanjut:*\n";
            $message .= "Hubungi kami jika ada pertanyaan.\n\n";
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
