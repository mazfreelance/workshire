<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PostingDuration extends Model
{
     protected $table = 'admin_jobposting_duration';  
     protected $fillable = [
        'post_type', 
        'duration', 
        'token_value'
    ];
}
