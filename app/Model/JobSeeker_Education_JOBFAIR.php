<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class JobSeeker_Education_JOBFAIR extends Model
{
   	protected $table = 'job_seeker_education'; 
    protected $fillable = ['seeker_id', 'highest_education', 'qualification', 'grade_achievement', 'field_of_study', 'major_study', 'institute', 'level', 'status_study'];
}
