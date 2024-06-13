<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    private $notification;
    private $email;
    public function __construct($notification, $email)
    {
        $this->notification = $notification;  
        $this->email = $email; 
    }

    public function build()
    {
        return $this
        ->from('onzlah@live.com')
        ->subject("Do not reply this email")
        ->markdown('mail.sendemail')
        ->with([
            'receiver_email' => $this->email,
            'notification' => $this->notification,
        ]);

    }
}
