<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $table = "offers";

    protected $fillable = [
        'price','created_at','updated_at','name_ar','name_en','details_ar','details_en','photo','status',
    ];

    protected $hidden = [
        'created_at','updated_at',
    ];

   // public $timestamps = false; // if you don't want to save create and update time
}
