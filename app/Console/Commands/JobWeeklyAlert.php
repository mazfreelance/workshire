<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
 
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailJobAlert; 

class JobWeeklyAlert extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jobalertweekly:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of new job reminder by daily';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

        $monday = \Carbon::now()->startOfWeek(); 
        $sunday = \Carbon::now()->endOfWeek(); 

        $users = \DB::table('users') 
                      ->select('*', 'users.id', 'job_seekers.id as seeker_id', 'notification_seeker.id as noti_id')
                      ->join('job_seekers', 'users.id', '=', 'job_seekers.user_id')
                      ->join('notification_seeker', 'users.id', '=', 'notification_seeker.user_id')
                      ->whereRaw('notification_seeker.job_alert = "Y|Weekly"')
                      ->get(); 

        $jobs = \DB::table('job_postings')  
               ->whereRaw('jobpost_status = "A"')
               ->whereRaw('Date(jobpost_startDate) BETWEEN Date("'.$monday.'") AND Date("'.$sunday.'")')
               ->get();

        if($jobs->count() > 0){
            foreach($users as $user)
            {   
                $user_id = $user->id;
                $email = $user->email;
                $name = $user->seeker_name;
                if($jobs->count() > 0) Mail::send(new SendMailJobAlert($email, $jobs, $user_id, $name));
            }
        }
    }
}
