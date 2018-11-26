<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    protected $table = 'job_seeker_resume';
    protected $fillable = ['seeker_id', 'resume_loc'];

    public function seeker(){
        return $this->belongsTo('App\Model\job_seeker');
    } 
}
