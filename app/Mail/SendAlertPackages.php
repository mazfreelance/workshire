<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendAlertPackages extends Mailable
{
    use Queueable, SerializesModels;
    public $total;
    public $status;
    public $name;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($total, $status, $name)
    {
        $this->total = $total;
        $this->status = $status;
        $this->name = $name;
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

        return $this->view('emails.alertpackages')
                    ->from('noreply@workshire', 'WORKSHIRE NOTIFICATION')
                    ->to($email_primary->toArray())
                    ->cc($email_cc->toArray())
                    ->subject('Packages notification');
    }
}
