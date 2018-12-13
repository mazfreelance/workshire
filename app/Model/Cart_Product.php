<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Cart_Product extends Model
{
    protected $table = 'cart_product'; 
    protected $fillable = ['name', 'post_id', 'resume_id', 'price', 'disc_price', 'duration', 'description'];
}
