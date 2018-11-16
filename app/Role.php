<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{ 
    protected $table = 'roles';

    public function users(){
    	return $this->hasMany('App\User');
    }

    public function users_employer(){
    	return $this->hasMany('App\User_Employer');
    }

    public function users_admin(){
    	return $this->hasMany('App\User_Admin');
    }
}
