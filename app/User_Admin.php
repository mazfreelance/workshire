<?php

namespace App;
 
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\EmployerResetPasswordNotification;

class User_Admin extends Authenticatable
{
    
	protected $table = 'users_admin';
    
 	use Notifiable;
    protected $guard = 'admin';

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
}
