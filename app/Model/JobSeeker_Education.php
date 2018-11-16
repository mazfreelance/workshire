<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobSeeker_Education extends Model
{
   	protected $table = 'job_seeker_education';

   	public function seeker(){
        return $this->belongsTo('App\Model\job_seeker'); 
    } 
}
