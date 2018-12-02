<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Admin_Email extends Model
{
    protected $table = 'admin_email'; 

    protected $fillable = [
        'email', 'class', 'type', 'name'
    ];
}
