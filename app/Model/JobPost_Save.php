<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobPost_Save extends Model
{ 
   	protected $table = 'savedjob_job_postings';
   	
   	public function jobpost()
 	{
	   return $this->belongsTo('App\Model\jobPost', 'job_id');
 	}

 	public function seeker()
 	{
	   return $this->belongsTo('App\Model\job_seeker', 'seeker_id');
 	}
}
