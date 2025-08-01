<?php

namespace App\Libs\Whatsapp;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Exception;

class WhatsappService
{
    protected $config;

    public function __construct()
    {
        $this->config = config('whatsapp');
    }

    /**
     * Login dan dapatkan token
     */
    public function login()
    {
        try {
            // Debug semua config yang dibaca
            Log::info('WhatsApp config debug', [
                'url' => $this->config['url'],
                'email' => $this->config['email'],
                'password' => $this->config['password'],
                'password_length' => strlen($this->config['password']),
                'all_config' => $this->config
            ]);

            // Cek apakah config sudah diset dengan benar
            if (empty($this->config['url']) || empty($this->config['email']) || empty($this->config['password'])) {
                throw new Exception('WhatsApp configuration is incomplete. Please check your .env file.');
            }

            $loginData = [
                'email' => $this->config['email'],
                'password' => $this->config['password']
            ];

            Log::info('Sending login request with data:', $loginData);

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->post($this->config['url'] . '/api/login', $loginData);

            Log::info('WhatsApp login response', [
                'status' => $response->status(),
                'success' => $response->successful(),
                'response_body' => $response->body()
            ]);

            if ($response->successful()) {
                $data = $response->json();
                $token = $data['token'] ?? null;

                if ($token) {
                    // Simpan token ke file cache (expire 24 jam)
                    Cache::put('whatsapp:token', $token, now()->addHours(24));
                    Log::info('WhatsApp token saved to file cache', ['token_length' => strlen($token)]);
                    return $token;
                } else {
                    Log::error('Token not found in response', ['response_data' => $data]);
                    throw new Exception('Token not found in login response');
                }
            }

            // Parse error response untuk pesan yang lebih informatif
            $errorData = $response->json();
            $errorMessage = $errorData['msg'] ?? 'Unknown error';

            Log::error('WhatsApp login failed', [
                'status' => $response->status(),
                'error_message' => $errorMessage,
                'full_response' => $response->body()
            ]);

            throw new Exception('Failed to get WhatsApp token: ' . $errorMessage);
        } catch (Exception $e) {
            Log::error('WhatsApp login error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Ambil token dari cache atau login ulang
     */
    public function getToken()
    {
        $token = Cache::get('whatsapp:token');

        if (!$token) {
            Log::info('Token not found in cache, attempting login...');
            $token = $this->login();
        } else {
            Log::info('Token found in cache', ['token_length' => strlen($token)]);
        }

        return $token;
    }

    /**
     * Simpan nomor pengirim ke file cache
     */
    public function saveSenderNumbers(array $numbers)
    {
        Cache::put('whatsapp:no', $numbers, now()->addDays(30)); // Cache for 30 days
        Log::info('WhatsApp sender numbers saved to file cache', ['numbers' => $numbers]);
        return true;
    }

    /**
     * Ambil nomor pengirim dari cache
     */
    public function getSenderNumbers()
    {
        $numbers = Cache::get('whatsapp:no', []);
        Log::info('Retrieved sender numbers from cache', ['numbers' => $numbers]);
        return $numbers;
    }

    /**
     * Kirim pesan WhatsApp
     */
    public function sendMessage($to, $message, $jid = null)
    {
        try {
            $token = $this->getToken();

            // Ambil JID dari cache jika tidak disediakan
            if (!$jid) {
                $senderNumbers = $this->getSenderNumbers();
                $jid = $senderNumbers[0] ?? null;

                if (!$jid) {
                    throw new Exception('No sender number available. Please add a sender number first.');
                }
            }

            Log::info('Sending WhatsApp message', [
                'to' => $to,
                'jid' => $jid,
                'message' => $message,
                'token_length' => strlen($token)
            ]);

            $response = Http::withoutVerifying()
                ->timeout(30)
                ->asJson()
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])
                ->post($this->config['url'] . '/api/wa/send', [
                    'jid' => $jid,
                    'to' => $to,
                    'message' => $message,
                    'url' => '',
                    'type' => 1
                ]);

            Log::info('WhatsApp send response', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            if ($response->successful()) {
                Log::info('WhatsApp message sent successfully', [
                    'to' => $to,
                    'jid' => $jid,
                    'message' => $message
                ]);
                return $response->json();
            }

            Log::error('WhatsApp send message failed', [
                'status' => $response->status(),
                'response' => $response->body(),
                'to' => $to,
                'jid' => $jid
            ]);

            throw new Exception('Failed to send WhatsApp message: ' . $response->body());
        } catch (Exception $e) {
            Log::error('WhatsApp send error: ' . $e->getMessage());
            throw $e;
        }
    }

    /**
     * Test kirim pesan dummy
     */
    public function sendDummyMessage()
    {
        return $this->sendMessage('628123456789', 'Test pesan dummy dari MOGMAIN - ' . now()->format('Y-m-d H:i:s'));
    }

    /**
     * Cek status koneksi
     */
    public function checkConnection()
    {
        try {
            $token = Cache::get('whatsapp:token');
            $senderNumbers = $this->getSenderNumbers();

            return [
                'connected' => !empty($token),
                'token_exists' => !empty($token),
                'token_length' => $token ? strlen($token) : 0,
                'sender_numbers' => $senderNumbers,
                'sender_count' => count($senderNumbers),
                'cache_driver' => config('cache.default')
            ];
        } catch (Exception $e) {
            return [
                'connected' => false,
                'error' => $e->getMessage()
            ];
        }
    }

    /**
     * Clear all WhatsApp cache data
     */
    public function clearCache()
    {
        Cache::forget('whatsapp:token');
        Cache::forget('whatsapp:no');
        Log::info('WhatsApp cache cleared');
        return true;
    }
}
