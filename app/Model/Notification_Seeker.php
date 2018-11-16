<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Notification_Seeker extends Model
{
     protected $table = 'notification_seeker';
     protected $fillable = [
        'user_id', 
        'job_alert', 
        'profile_remind', 
        'promo_alert',
    ];

    public function users(){
        return $this->belongsTo('App\User'); 
    } 
}
