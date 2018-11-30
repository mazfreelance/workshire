<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewJobAlert extends Mailable
{
    use Queueable, SerializesModels;

    public $email;
    public $name; 
    public $companyname;
    public $jobposition;
    public $jobdate;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($email, $name, $companyname, $jobposition, $jobdate)
    { 
        $this->email = $email; 
        $this->name = $name;  
        $this->companyname = $companyname;   
        $this->jobposition = $jobposition;   
        $this->jobdate = $jobdate;  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {   
        $email_cc = \DB::table('admin_email')->whereRaw('class = "cc"')->whereRaw('type = "job"')->get(); 

        foreach ($email_cc AS $cc) {
            $arr_cc[$cc->email] = $cc->name;  
        } 
        
        return $this->view('emails.messages')   
                    ->to($this->email, $this->name)
                    ->cc($email_cc->toArray())
                    ->subject('1 new job post need to approve'); 
    }
}
