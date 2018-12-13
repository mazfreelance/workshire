<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PackagePlan extends Model
{
    protected $table = 'packageplan';
    protected $fillable = [
        'type', 
        'description', 
        'token_amount', 
        'token_count',
        'status'
    ];
}
