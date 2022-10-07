<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PembayaranMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pembayaran_mail;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($pembayaran_mail)
    {
        //
        $this->pembayaran_mail = $pembayaran_mail;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Pembayaran anda telah dikonfirmasi')
        ->markdown('emails.pembayaran_shipped');
    }
}
