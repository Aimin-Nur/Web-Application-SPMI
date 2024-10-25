<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendTemuan extends Mailable
{
    public $email, $temuan, $rtk, $deadline;
    public function __construct($email, $temuan, $rtk, $deadline)
    {
        $this->email = $email;
        $this->temuan = $temuan;
        $this->rtk = $rtk;
        $this->deadline = $deadline;
    }

    public function build()
    {
        return $this->subject('Temuan Audit SPMI')
                    ->view('emails.temuan_dikirim')
                    ->with([
                        'email' => $this->email,
                        'temuan' => $this->temuan,
                        'rtk' => $this->rtk,
                        'deadline' => $this->deadline,
                    ]);
    }
}


