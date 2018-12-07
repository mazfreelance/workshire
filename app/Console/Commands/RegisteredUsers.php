<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendMailableRegisteredUsers; 

class RegisteredUsers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'registered:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send an email of registered users';

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
        /*
        $date = new DateTime();
        $monday = $date->modify('Monday this week')->format('Y-m-d');
        $sunday = $date->modify('Sunday this week')->format('Y-m-d');

        // or

        echo $monday = \Carbon::now()->startOfWeek();
        echo '<br/>';
        echo $sunday = \Carbon::now()->endOfWeek();
        */
        $monday = \Carbon::now()->startOfWeek(); 
        $sunday = \Carbon::now()->endOfWeek();

        $date = date('Y-m-d');
        $totalUsersSeeker = \DB::table('users')
                               ->whereRaw('Date(created_at) BETWEEN Date("'.$monday.'") AND Date("'.$sunday.'")')
                               ->count();
        $totalUsersEmployer = \DB::table('users_employer')
                               ->whereRaw('Date(created_at) BETWEEN Date("'.$monday.'") AND Date("'.$sunday.'")')
                               ->count();

        if($totalUsersSeeker > 0 OR $totalUsersEmployer > 0)
        Mail::send(new SendMailableRegisteredUsers($totalUsersSeeker, $totalUsersEmployer, $monday, $sunday));
    }
}
