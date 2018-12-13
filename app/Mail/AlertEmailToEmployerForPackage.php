<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AlertEmailToEmployerForPackage extends Mailable
{
    use Queueable, SerializesModels;
    public $email;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name)
    {
        $this->email = $email;
        $this->name = $name;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    { 
        return $this->view('emails.alerttoemployerforpackage')
                    ->from('noreply@workshire.com.my', 'WORKSHIRE NOTIFICATION')
                    ->to($this->email)
                    ->subject('You have 1 notification from Workshire');
    }
}
