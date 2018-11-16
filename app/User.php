<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    protected $table = 'users';

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'username', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function role(){
        return $this->belongsTo('App\Role');
    } 

    public function seeker(){
        return $this->hasOne('App\Model\job_seeker');
    } 
 
    public function message(){
        return $this->hasMany('App\Model\Message', 'users_id');
    }    

    public function emailNotification(){
        return $this->hasOne('App\Model\Notification_Seeker');
    } 

    public function verifyUser()
    {
        return $this->hasOne('App\Model\VerifyUser');
    }


    /*
    public static function createNewUser(array $data){

        $auth_user = User::create([
            'username' => $data['username'],
            'email' => $data['email'], 
            'password' => Hash::make($data['password']),
            'role_id' => 1,
        ]);

        $user_detail =  $auth_user->seeker()->create(['seeker_name' => $data['email'], 
                                                      'survey' => $data['seeker_survey_list'], 
                                                      'other_survey' => $data['seeker_survey_others'], 
                                                      'created_at' => date('Y-m-d H:i:s')
                                                    ]);
    }*/
}
