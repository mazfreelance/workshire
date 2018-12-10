<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobSeeker_Experience extends Model
{
    protected $table = 'job_seeker_experiences';
    protected $fillable = ['seeker_id', 'exp_fromDt', 'exp_toDt', 'exp_position', 'exp_jobd', 'exp_company', 'exp_salary'];

   	public function seeker(){
        return $this->belongsTo('App\Model\job_seeker'); 
    } 
}
