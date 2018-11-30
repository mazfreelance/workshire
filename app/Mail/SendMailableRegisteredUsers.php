<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendMailableRegisteredUsers extends Mailable
{
    use Queueable, SerializesModels;
    public $totalSeeker;
    public $totalEmployer;
    public $monday;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($totalSeeker, $totalEmployer, $monday, $sunday)
    {
        $this->totalSeeker  = $totalSeeker;
        $this->totalEmployer  = $totalEmployer;
        $this->monday  = $monday;
        $this->sunday  = $sunday;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {    
        $email_primary = \DB::table('admin_email')->whereRaw('class = "primary"')->whereRaw('type = "signup"')->get();  
        $email_cc = \DB::table('admin_email')->whereRaw('class = "cc"')->whereRaw('type = "signup"')->get();  

        return $this->view('emails.registeredcount')
                    ->from('noreply@workshire', 'WORKSHIRE NOTIFICATION')
                    ->to($email_primary->toArray())
                    ->cc($email_cc->toArray())
                    ->subject('Number of Workshire Signup Weekly Between '.date('F jS , Y', strtotime($this->monday)).' & '.date('F jS , Y', strtotime($this->sunday)));
    }
}
