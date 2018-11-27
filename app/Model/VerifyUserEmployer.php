<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class VerifyUserEmployer extends Model
{	
	protected $table = 'verify_users_employer'; 
	protected $guarded = [];

    public function user()
    {
        return $this->belongsTo('App\User_Employer', 'user_id');
    }
}
