<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PemesananMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pemesanan_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pemesanan_mail)
    {
        //
        $this->pemesanan_mail = $pemesanan_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pemesaan anda berhasil dilakukan')
        ->markdown('emails.pemesanan_shipped');
    }
}
