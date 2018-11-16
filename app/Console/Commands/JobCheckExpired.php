<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

use App\Model\jobPost;

class JobCheckExpired extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'job_checkexpired:users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check job posting expired date';

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
        $jobs = \DB::table('job_postings')  
               ->whereRaw('jobpost_status = "A"')
               ->whereRaw('jobpost_endDate < CURDATE()')
               ->get();
 
        foreach ($jobs as $job) { 
            $jp = jobPost::find($job->id);
            $jp->jobpost_status = 'E';
            $jp->save();
        }
    }
}
