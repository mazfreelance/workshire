<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class job_seeker_JOBFAIR extends Model
{ 
    protected $table = 'job_seekers';   
    protected $fillable = [
        'user_id', 
        'seeker_name', 
        'seeker_nric', 
        'seeker_ctc_tel1', 
        'seeker_noYrsExp',
        'seeker_survey_list', 
        'seeker_survey_others',
    ]; 
}
