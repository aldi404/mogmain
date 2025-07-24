<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class WhatsappJob implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new job instance.
     */
    public function __construct(public $noWa, public $to,public $msg,public $token,public $urlDoc)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
         try {
            Http::withoutVerifying()->asJson()
            ->withHeaders(["Authorization" => "Bearer {$this->token}"])
            ->post(config('whatsapp.url') . '/api/wa/send', [
                    "jid" => $this->noWa,
                    "to" => $this->to,
                    "message" => $this->msg,
                    "url" => $this->urlDoc,
                    "type" => 3
            ]);
        } catch (\Throwable $th) {
            Log::error($th);
        }
    }
}
