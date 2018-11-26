<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class job_seeker extends Model
{ 
    protected $table = 'job_seekers';   
    protected $fillable = [
        'user_id', 
        'seeker_name', 
        'seeker_survey_list', 
        'seeker_survey_others',
    ];

    public function users(){
        return $this->belongsTo('App\User'); 
    } 

    public function applicant()
 	{
	   return $this->belongsTo('App\Model\Job_Applicant');
 	}

 	public function education(){
        return $this->hasMany('App\Model\JobSeeker_Education', 'seeker_id');
    }  

    public function experience(){
        return $this->hasMany('App\Model\JobSeeker_Experience', 'seeker_id');
    } 

    public function savejob(){
        return $this->hasMany('App\Model\JobPost_Save', 'seeker_id');
    } 

    public function paid_seeker()
    {
        return $this->hasMany('App\Model\PaidCandidate');
    }

    public function resume(){
        return $this->hasOne('App\Model\Resume', 'seeker_id');
    } 
}
