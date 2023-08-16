<?php

namespace App\Http\Controllers\Relations;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Doctor;
use App\Models\Hospital;
use App\Models\Patient;
use App\Models\Phone;
use App\Models\Service;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Routing\Route;

class RelationsController extends Controller
{
    public function hasOne()
    {
        $user = User::with( ['phone'=>function($q){
            $q->select('code','phone','user_id');//when you use select never forget the foreign key
        }])->find(3);
        return $user->phone->code;
       // return response()->json($user);
    }

    public function hasOneReverse(){
        // $phone = Phone::with('user')->find(1); // you can use this way if you wanna select all data
        $phone = Phone::with(['user'=>function($q){
            $q->select('id','name');
        }])->find(1);

        // make hidden attribute visible in this method
        $phone->makeVisible(['user_id']);
        //$phone->makeHidden(['code']); // use this method if you wanna hide visible attribute
        // return $phone->user; // return the user who has this phone number
        return $phone;
    }

    public function getUserHasPhone(){
       return User::whereHas('phone')->get();
    }
    public function getUserNotHasPhone(){
        return User::whereDoesntHave('phone')->get();
    }

    public function getUserHasPhoneAndSpecificCode(){
        return User::whereHas('phone',function ($q){
            $q->where('code','20');
        })->get();
    }

    #************** begin one to many methods **************#
    public function getDoctorsOfHospital(){
        //$hospital = Hospital::find(1); // Hospital::where('id',1)->first(); // Hospital::first();
        // return $hospital ->doctors; // to return all doctors in this hospital
        $hospital = Hospital::with('doctors')->find(1);

        $doctors = $hospital->doctors;
        foreach ($doctors as $doctor){
            echo $doctor->name .'<br>';
        }

        $doctor = Doctor::find(3);
        return $doctor->hospital;
    }

    public function getAllHospitals(){
        $hospitals = Hospital::whereHas('doctors')->get();
        return view('doctors.hospitals',compact('hospitals'));
    }

    public function getAllDoctors($hospital_id){
        $hospital = Hospital::with('doctors')->find($hospital_id);
        $doctors = $hospital->doctors;
        return view('doctors.doctors',compact('doctors'));
    }

    public function deleteHospital($hospital_id){
        $hospital = Hospital::find($hospital_id);
        if(!$hospital){
            return abort('404');
        }
        // firstly delete all doctors in this hospital
        $hospital->doctors()->delete();

        //then delete te hospital
        $hospital->delete();

        return redirect()->back();
    }
    #************** end one to many methods **************#


    #************** begin many to many methods **************#
    public function getDoctorsServices(){
        $doctor = Doctor::find(3);
        return $doctor->services;
    }

    public function getDoctorServicesByID($doctor_id){
        $doctor = Doctor::find($doctor_id);
        $services = $doctor->services;
        $doctors =Doctor::select('id','name')->get();
        $allServices=Service::select('id','name')->get();
        return view('doctors.services',compact('services','doctors','allServices','doctor'));
    }

    public function saveServicesToDoctor(Request $request){
        $doctor = Doctor::find($request->doctor_id);
        //$doctor->services()->attach($request->service_id); // insert into many to many but accept the duplication of data
        //$doctor->services()->sync($request->service_id); // insert into many to many and don't accept the duplication of data but delete th old values
        $doctor->services()->syncWithoutDetaching($request->service_id); // insert into many to many and don't accept the duplication of data and don't delete th old values
        return 'success';
    }
    #************** end many to many methods **************#

    #************** begin has one through methods **************#
    public function getPatientDoctor(){
        $patient = Patient::find(2);
        return $patient->doctor;
    }
    #************** end has one through methods **************#

    #************** begin has many through methods **************#
    public function getCounrtyDoctors(){
        $country = Country::find(1);
        return $country->doctors;
    }
    #************** end has many through methods **************#

    public function getAllHopitals(){
        $country = Country::find(1);
        return $country->hospitals;
    }
}
