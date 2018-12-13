<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class EmployerTokenPost extends Model
{
    protected $table = 'employer_token_jobposting';
    protected $fillable = ['employer_id', 'package_plan', 'balance', 'subscribe_date', 'expired_date'];
}
