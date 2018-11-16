<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
 

class SendMailJobAlert extends Mailable
{
    use Queueable, SerializesModels; 
    public $user_id;
    public $email;
    public $jobs;
    public $name;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $jobs, $user_id, $name)
    { 
        $this->user_id = $user_id; 
        $this->email = $email; 
        $this->jobs = $jobs;   
        $this->name = $name;   
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {     
        return $this->view('emails.jobalert')   
                    ->to($this->email, $this->name)
                    ->subject('We have jobs that might interest you'); 
    }
}
