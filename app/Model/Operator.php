<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Operator extends Model
{
    protected $table = 'operator_pool';
    protected $fillable = [
        'name', 
        'nric', 
        'phone', 
        'address',
        'poscode', 
        'state', 
        'position', 
        'working_status',
        'state', 
        'other_current_pos', 
        'work_exp',
        'availability_work',
        'education', 
        'status_job'
    ];
}
