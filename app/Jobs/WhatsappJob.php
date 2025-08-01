<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Libs\Whatsapp\WhatsappService;
use Illuminate\Support\Facades\Log;

class WhatsappJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $to;
    protected $message;
    protected $jid;

    /**
     * Create a new job instance.
     */
    public function __construct($to, $message, $jid = null)
    {
        $this->to = $to;
        $this->message = $message;
        $this->jid = $jid;

        Log::info('WhatsApp job created', [
            'to' => $to,
            'message' => $message,
            'jid' => $jid
        ]);
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Log::info('WhatsApp job started executing');

            $whatsappService = new WhatsappService();
            $result = $whatsappService->sendMessage($this->to, $this->message, $this->jid);

            Log::info('WhatsApp job completed successfully', [
                'to' => $this->to,
                'message' => $this->message,
                'result' => $result
            ]);
        } catch (\Exception $e) {
            Log::error('WhatsApp job failed: ' . $e->getMessage(), [
                'to' => $this->to,
                'message' => $this->message,
                'error' => $e->getMessage()
            ]);
            throw $e;
        }
    }
}
