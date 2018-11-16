<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Job_Applicant extends Model
{
    protected $table = 'job_applications';

    public function jobpost()
 	{
	   return $this->belongsTo('App\Model\jobPost', 'appl_jobpostid');
 	}

 	public function employer()
 	{
	   return $this->belongsTo('App\Model\employer', 'appl_emp_id');
 	}
 
 	public function seeker(){
    	return $this->hasMany('App\Model\job_seeker');
    } 
}
