<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendVerificationMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    private $verificationcode;

    public function __construct($verifycode)
    {
        $this->verificationcode = $verifycode;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('onzlah@gmail.com')
        ->subject('Email Verification')
        ->markdown('mail.sendverificationmailtemp')
        ->with([
            'verificationcode' => $this->verificationcode
        ]);
        //return $this->view('views.verification');
    }
}
