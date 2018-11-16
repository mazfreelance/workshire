<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobSeeker_Experience extends Model
{
    protected $table = 'job_seeker_experiences';

   	public function seeker(){
        return $this->belongsTo('App\Model\job_seeker'); 
    } 
}
