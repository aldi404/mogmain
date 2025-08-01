<?php

namespace App\Http\Controllers\Whatsapp;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappConnectController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    /**
     * Tampilkan halaman management WhatsApp
     */
    function index()
    {
        $noWas = Cache::get("whatsapp:no", []);
        $token = Cache::get("whatsapp:token");

        $status = [
            'connected' => !empty($token),
            'token_exists' => !empty($token),
            'sender_count' => count($noWas),
            'cache_driver' => config('cache.default')
        ];

        return view('admin.whatsapp.index', compact("noWas", "token", "status"));
    }

    function create()
    {
        $token = Cache::get("whatsapp:token");
        return view('admin.whatsapp.form', compact("token"));
    }

    /**
     * Simpan nomor pengirim
     */
    function store(Request $request)
    {
        $request->validate(["no_wa" => "required"]);

        try {
            $noWas = Cache::get("whatsapp:no", []);
            $phoneNumber = $request->input("no_wa");

            // Format ke JID WhatsApp
            $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
            if (substr($phoneNumber, 0, 1) === '0') {
                $phoneNumber = '62' . substr($phoneNumber, 1);
            }
            $jid = $phoneNumber . '@s.whatsapp.net';

            $noWas[] = $jid;
            Cache::put("whatsapp:no", array_values($noWas));

            Log::info('WhatsApp number added', ['jid' => $jid]);
            return redirect()->back()->with('success', 'Nomor berhasil ditambah: ' . $jid);
        } catch (\Exception $e) {
            Log::error('Failed to add WhatsApp number: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menambah nomor: ' . $e->getMessage());
        }
    }

    /**
     * Hapus nomor pengirim
     */
    function delete(Request $request)
    {
        try {
            $index = $request->input('index');
            $noWas = Cache::get("whatsapp:no", []);

            if (isset($noWas[$index])) {
                $deletedNumber = $noWas[$index];
                unset($noWas[$index]);
                Cache::put("whatsapp:no", array_values($noWas));

                Log::info('WhatsApp number deleted', ['jid' => $deletedNumber]);
                return redirect()->back()->with('success', 'Nomor berhasil dihapus: ' . $deletedNumber);
            }

            return redirect()->back()->with('error', 'Nomor tidak ditemukan');
        } catch (\Exception $e) {
            Log::error('Failed to delete WhatsApp number: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Gagal menghapus nomor: ' . $e->getMessage());
        }
    }

    // Method untuk test koneksi
    function testConnection()
    {
        try {
            Log::info('Testing WhatsApp connection');

            $res = Http::withoutVerifying()->asForm()->post(config('whatsapp.url') . '/api/login', [
                'email' => config('whatsapp.email'),
                'password' => config('whatsapp.password')
            ]);

            Log::info('WhatsApp login response', [
                'status' => $res->status(),
                'successful' => $res->successful(),
                'body' => $res->body()
            ]);

            if ($res->successful()) {
                $responseData = $res->json();
                $token = $responseData["data"] ?? $responseData["token"] ?? null;

                if ($token) {
                    Cache::put("whatsapp:token", $token);
                    Log::info('WhatsApp token saved to Redis');
                    return back()->with('success', 'WhatsApp connected! Token tersimpan di Redis.');
                }
            }

            return back()->with('error', 'Failed to connect: ' . $res->body());
        } catch (\Exception $e) {
            Log::error('WhatsApp connection error: ' . $e->getMessage());
            return back()->with('error', 'Connection error: ' . $e->getMessage());
        }
    }

    // Method untuk test kirim pesan
    function testSend()
    {
        try {
            $token = Cache::get("whatsapp:token");
            $noWas = Cache::get("whatsapp:no", []);

            if (empty($token)) {
                return back()->with('error', 'Token tidak ada. Test connection dulu!');
            }

            if (empty($noWas)) {
                return back()->with('error', 'Belum ada nomor pengirim. Tambah nomor dulu!');
            }

            Log::info('Sending test WhatsApp message', [
                'jid' => $noWas[0],
                'to' => '628123456789'
            ]);

            $response = Http::withoutVerifying()->asJson()
                ->withHeaders(["Authorization" => "Bearer $token"])
                ->post(config('whatsapp.url') . '/api/wa/send', [
                    "jid" => $noWas[0],
                    "to" => "628123456789",
                    "message" => "Test pesan dummy dari " . config('app.name') . " - " . now(),
                    "url" => "",
                    "type" => 1
                ]);

            Log::info('WhatsApp send response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return back()->with('success', 'Pesan berhasil dikirim! Response: ' . $response->body());
            }

            return back()->with('error', 'Gagal kirim: ' . $response->body());
        } catch (\Exception $e) {
            Log::error('WhatsApp send error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    /**
     * Test kirim pesan dengan nomor custom
     */
    function sendCustomMessage(Request $request)
    {
        $request->validate([
            'phone_number' => 'required|string|min:10',
            'message' => 'required|string|max:1000'
        ]);

        try {
            $token = Cache::get("whatsapp:token");
            $noWas = Cache::get("whatsapp:no", []);

            if (empty($token)) {
                return back()->with('error', 'Token tidak ada. Test connection dulu!');
            }

            if (empty($noWas)) {
                return back()->with('error', 'Belum ada nomor pengirim. Tambah nomor dulu!');
            }

            // Format nomor penerima
            $phoneNumber = preg_replace('/[^0-9]/', '', $request->phone_number);
            if (substr($phoneNumber, 0, 1) === '0') {
                $phoneNumber = '62' . substr($phoneNumber, 1);
            }

            Log::info('Sending custom WhatsApp message', [
                'from' => $noWas[0],
                'to' => $phoneNumber,
                'message' => $request->message
            ]);

            $response = Http::withoutVerifying()->asJson()
                ->withHeaders(["Authorization" => "Bearer $token"])
                ->post(config('whatsapp.url') . '/api/wa/send', [
                    "jid" => $noWas[0],
                    "to" => $phoneNumber,
                    "message" => $request->message,
                    "url" => "",
                    "type" => 1
                ]);

            Log::info('WhatsApp custom send response', [
                'status' => $response->status(),
                'body' => $response->body()
            ]);

            if ($response->successful()) {
                return back()->with('success', 'Pesan berhasil dikirim ke ' . $phoneNumber . '! Response: ' . $response->body());
            }

            return back()->with('error', 'Gagal kirim ke ' . $phoneNumber . ': ' . $response->body());
        } catch (\Exception $e) {
            Log::error('WhatsApp custom send error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Clear semua cache WhatsApp
    function disconnect()
    {
        try {
            Cache::forget("whatsapp:token");
            Cache::forget("whatsapp:no");
            Log::info('WhatsApp cache cleared');
            return back()->with('success', 'WhatsApp disconnected. Cache cleared.');
        } catch (\Exception $e) {
            Log::error('Failed to disconnect WhatsApp: ' . $e->getMessage());
            return back()->with('error', 'Failed to disconnect: ' . $e->getMessage());
        }
    }

    function qrcode()
    {
        $token = Cache::get("whatsapp:token");

        if (!$token) {
            return redirect()->route('admin.whatsapp.index')
                ->with('error', 'Token tidak tersedia. Lakukan test connection terlebih dahulu.');
        }

        return view('admin.whatsapp.qrcode', compact('token'));
    }

    function storeQr(Request $request)
    {
        $request->validate(["no_wa" => "required"]);

        try {
            $noWas = Cache::get("whatsapp:no", []);
            $jid = $request->input("no_wa");

            // Cek apakah nomor sudah ada
            if (!in_array($jid, $noWas)) {
                $noWas[] = $jid;
                Cache::put("whatsapp:no", array_values($noWas));

                Log::info('WhatsApp number added via QR scan', ['jid' => $jid]);
                return redirect()->route('admin.whatsapp.index')
                    ->with('success', 'Nomor WhatsApp berhasil ditambahkan via QR scan: ' . $jid);
            } else {
                return redirect()->route('admin.whatsapp.index')
                    ->with('info', 'Nomor WhatsApp sudah terdaftar: ' . $jid);
            }
        } catch (\Exception $e) {
            Log::error('Failed to add WhatsApp number via QR: ' . $e->getMessage());
            return redirect()->route('admin.whatsapp.index')
                ->with('error', 'Gagal menambah nomor via QR: ' . $e->getMessage());
        }
    }

    // Method alternatif untuk get QR code via HTTP API (tanpa WebSocket)
    function getQrCode()
    {
        try {
            $token = Cache::get("whatsapp:token");

            if (!$token) {
                return back()->with('error', 'Token tidak tersedia. Lakukan test connection terlebih dahulu.');
            }

            Log::info('Getting QR code via HTTP API');

            // Coba ambil QR code via HTTP endpoint (jika tersedia)
            $response = Http::withoutVerifying()
                ->timeout(30)
                ->withHeaders([
                    'Authorization' => 'Bearer ' . $token
                ])
                ->get(config('whatsapp.url') . '/api/wa/qr-code');

            if ($response->successful()) {
                $data = $response->json();

                if (isset($data['qr_code'])) {
                    return view('admin.whatsapp.qrcode-http', [
                        'qrCode' => $data['qr_code'],
                        'token' => $token
                    ]);
                }
            }

            Log::error('Failed to get QR code via HTTP', [
                'status' => $response->status(),
                'response' => $response->body()
            ]);

            return back()->with('error', 'Gagal mendapatkan QR code. WebSocket method diperlukan.');
        } catch (\Exception $e) {
            Log::error('QR code HTTP error: ' . $e->getMessage());
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // Method untuk test manual tanpa QR (untuk testing lokal)
    function testManualAdd()
    {
        try {
            // Simulasi JID untuk testing
            $testJid = '628123456789@s.whatsapp.net';

            $noWas = Cache::get("whatsapp:no", []);

            if (!in_array($testJid, $noWas)) {
                $noWas[] = $testJid;
                Cache::put("whatsapp:no", array_values($noWas));

                Log::info('Test WhatsApp number added manually', ['jid' => $testJid]);
                return back()->with('success', 'Test nomor berhasil ditambahkan: ' . $testJid);
            } else {
                return back()->with('info', 'Test nomor sudah ada: ' . $testJid);
            }
        } catch (\Exception $e) {
            Log::error('Failed to add test number: ' . $e->getMessage());
            return back()->with('error', 'Gagal menambah test nomor: ' . $e->getMessage());
        }
    }
}
