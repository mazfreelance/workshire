<?php

namespace App; 

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmployerResetPasswordNotification;

class User_Employer extends Authenticatable
{  
 	use Notifiable;
    protected $table = 'users_employer';
    protected $guard = 'employer';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ]; 
 
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new EmployerResetPasswordNotification($token));
    }

    public function role(){
        return $this->belongsTo('App\Role');
    } 

    public function employer(){
        return $this->hasMany('App\Model\employer', 'users_id');
    } 

    public function verifyUser()
    {
        return $this->hasOne('App\Model\VerifyUserEmployer', 'user_id');
    }
}
