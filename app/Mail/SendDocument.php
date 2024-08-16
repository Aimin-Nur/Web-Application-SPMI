<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendDocument extends Mailable
{
    public $email, $judul, $deadline;
    public function __construct($email, $judul, $deadline)
    {
        $this->email = $email;
        $this->judul = $judul;
        $this->deadline = $deadline;
    }

    public function build()
    {
        return $this->subject('Dokumen Evaluasi Diri : ' . $this->judul . ' - Deadline: ' . $this->deadline)
                    ->view('emails.dokumen_dikirim')
                    ->with([
                        'email' => $this->email,
                        'judul' => $this->judul,
                        'deadline' => $this->deadline,
                    ]);
    }
}


