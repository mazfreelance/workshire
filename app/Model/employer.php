<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model; 

class employer extends Model
{
  	protected $guarded = [];
    protected $table = 'employers';  

    
    public function users(){
        return $this->belongsTo('App\User_Employer'); 
    } 
    
    public function applicant(){
    	return $this->hasMany(Job_Applicant::class);
    }

    public function paid_seeker(){
    	return $this->hasMany(PaidCandidate::class);
    }

     public function orders(){
        return $this->hasMany(Cart_Order::class);
    }
}
