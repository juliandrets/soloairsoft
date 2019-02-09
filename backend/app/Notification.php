<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $keyType = 'string';
    protected $fillable	 = ['user_id', 'product_id', 'message'];
}
