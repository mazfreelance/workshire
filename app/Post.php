<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $table = 'job_postings';
	protected $fillable = ['jobpost_position','jobpost_desc'];
}
