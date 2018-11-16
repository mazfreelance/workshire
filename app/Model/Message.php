<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{ 
    protected $table = 'messages';
 
    public function users(){
        return $this->belongsTo('App\User'); 
    }  
}
