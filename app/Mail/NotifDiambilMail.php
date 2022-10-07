<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class NotifDiambilMail extends Mailable
{
    use Queueable, SerializesModels;

     public $ambil_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($ambil_mail)
    {
        //
         $this->ambil_mail = $ambil_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Foto anda sudah bisa diambil')
        ->markdown('emails.notifambil_shipped');
    }
}
