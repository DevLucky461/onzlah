<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PartnerMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($partner)
    {
        
        $this->name = $partner->name;
        $this->company = $partner->company;
        $this->position = $partner->position;
        $this->email = $partner->email;
        $this->contact = $partner->contact_number;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from('onzlah@gmail.com')
        ->subject('Potential Partnership')
        ->markdown('mail.partner-mail')
        ->with([
            'name' => $this->name,
            'company' => $this->company,
            'position' => $this->position,
            'email' => $this->email,
            'contact' => $this->contact,
        ]);
    }
}
