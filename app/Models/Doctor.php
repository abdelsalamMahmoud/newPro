<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    protected $table='doctors';
    protected $fillable = [
        'name','title','hospital_id','created_at','updated_at','medical_id',
    ];

    protected $hidden=[
        'created_at','updated_at','laravel_through_key',
    ];

    public $timestamps = true;

    //this method to relate doctor to hospital and it is one-to-many relationship
    public function hospital(){
        return $this->belongsTo('App\Models\Hospital','hospital_id','id');
    }

    public function services(){
        return $this->belongsToMany('App\Models\Service','doctor_service','doctor_id','service_id','id','id');
    }

}
