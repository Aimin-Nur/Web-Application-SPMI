<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendTemuanEmail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email;
    protected $temuan;
    protected $rtk;
    protected $deadline;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email, $temuan, $rtk, $deadline)
    {
        $this->email = $email;
        $this->temuan = $temuan;
        $this->rtk = $rtk;
        $this->deadline = $deadline;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Mail::send('emails.temuan_dikirim', ['temuan' => $this->temuan, 'rtk' => $this->rtk, 'deadline' => $this->deadline], function ($message) {
            $message->to($this->email)
                    ->subject('Temuan Audit');
        });
    }
}
