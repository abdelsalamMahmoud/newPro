<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patient extends Model
{
    protected $table='patients';

    protected $fillable = [
        'name','age',
    ];

    protected $hidden=[

    ];

    public $timestamps = false;

    // has one through relation
    public function doctor(){
        return $this->hasOneThrough('App\Models\Doctor','App\Models\Medical','patient_id','medical_id','id');
    }
}
