<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class jobPost extends Model
{
  	protected $guarded = [];
   	protected $table = 'job_postings';

	public function employerDetailBySeq()
 	{
	   return $this->belongsTo('App\Model\employer', 'jobpost_employer');
 	} 

 	public function applicant(){
    	return $this->hasMany('App\Model\Job_Applicant');
    } 

    public function savejob(){
        return $this->hasMany('App\Model\JobPost_Save', 'seeker_id');
    } 
}
