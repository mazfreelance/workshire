<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PaidCandidate extends Model
{
    protected $table = 'employer_paidforcandidate';  


    public function employer(){
    	return $this->belongsTo('App\Model\employer');
    }

    public function seekerDtl()
    {
    	return $this->belongsTo('App\Model\job_seeker', 'seeker_id');
    }
}
