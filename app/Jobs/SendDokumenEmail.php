<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendDokumenEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $judul;
    protected $deadline;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $judul, $deadline)
    {
        $this->email = $email;
        $this->judul = $judul;
        $this->deadline = $deadline;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.dokumen_dikirim', ['judul' => $this->judul, 'deadline' => $this->deadline], function ($message) {
            $message->to($this->email)
                    ->subject('Dokumen Evaluasi Diri');
        });
    }
}
