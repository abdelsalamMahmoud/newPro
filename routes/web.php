<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
define('PAGINATION_COUNT',1);
Route::get('/', function () {
    return view('welcome');
});

//Route::get('/test1', function () {
//    return "welcome";
//});

// route parameters
//Route::get('/show-number/{id}', function ($id) {
//    return $id;
//}) ->name('a'); //the id is a required parameter

//Route::get('/show-string/{id?}', function () {
//    return "welcome";
//})->name('b');//the id is a optional parameter

//name spacing

//Route::namespace('Front')->group(function (){
//    //all route only access controllers or methods in front folder
//    Route::get('user','UserController@getIndex');
//});

// prefix
//Route::group(['prefix'=>'users','middleware'=>'auth'],function (){
//    Route::get('/',function (){
//        return "from middleware";
//    });
//});


//Route::resource('news','NewsController');

Auth::routes(['verify'=>true]);

Route::get('/home', 'HomeController@index')->name('home')->middleware('verified');

Route::get('/dashboard', function () {
    return 'not authenticated';
})->name('dash');

Route::get('/fillable','CrudController@getOffers');

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
], function() {
    Route::group(['prefix'=>'offers'], function (){
        Route::post('store','CrudController@store')->name('offers.store');
        Route::get('create', 'CrudController@create');
        Route::get('all', 'CrudController@getAllOffers')->name('offers.all');
        Route::post('update/{offer_id}','CrudController@updateOffer')->name('offers.update');
        Route::get('delete/{offer_id}','CrudController@delete')->name('offers.delete');
        Route::get('edit/{offer_id}', 'CrudController@editOffer');
    });

    Route::get('/youtube','CrudController@getVideo');
});

########## begin AJAX routes##########
Route::group(['prefix'=>'ajax-offers'], function (){
    Route::get('create', 'OfferController@create');
    Route::post('store','OfferController@store')->name('ajax.offers.store');
    Route::get('all', 'OfferController@all')->name('ajax.offers.all');
    Route::post('delete','OfferController@delete')->name('ajax.offers.delete');
    Route::get('edit/{id}', 'OfferController@edit')->name('ajax.offer.edit');
    Route::post('update','OfferController@update')->name('ajax.offers.update');
});
########## end AJAX routes##########

########## begin authentication and guards  ##########
Route::group(['middleware'=>'CheckAge','namespace'=>'Auth'],function (){
    Route::get('adult','CustomAuthController@adult')->name('adult');
});

Route::get('site','Auth\CustomAuthController@site')->middleware('auth:web')->name('site');
Route::get('admin','Auth\CustomAuthController@admin')->middleware('auth:admin')->name('admin');
Route::get('admin/login','Auth\CustomAuthController@adminLogin')->name('admin.login');
Route::post('admin/login','Auth\CustomAuthController@checkAdminLogin')->name('save.admin.login');

########## end authentication and guards  ##########


############### begin relations routes ###############

#************** begin one to one **************#
Route::get('has-one','Relations\RelationsController@hasOne');
Route::get('has-one-reverse','Relations\RelationsController@hasOneReverse');
Route::get('get-user-has-phone','Relations\RelationsController@getUserHasPhone');
Route::get('get-user-not-has-phone','Relations\RelationsController@getUserNotHasPhone');
Route::get('get-user-has-phone-and-specific-code','Relations\RelationsController@getUserHasPhoneAndSpecificCode');
#************** end one to one **************#

#************** begin one to many **************#
Route::get('hospital-has-many','Relations\RelationsController@getDoctorsOfHospital');
Route::get('get-all-hospitals', 'Relations\RelationsController@getAllHospitals');
Route::get('delete-hospital\{hospital_id}', 'Relations\RelationsController@deleteHospital')->name('delete.hospital');
Route::get('get-all-doctors\{hospital_id}', 'Relations\RelationsController@getAllDoctors')->name('doctors.all');

#************** end one to many **************#

#************** begin many to many **************#
Route::get('doctors-services','Relations\RelationsController@getDoctorsServices');
Route::get('doctor-services\{doctor_id}', 'Relations\RelationsController@getDoctorServicesByID')->name('doctors.services');
Route::post('saveServices-to-doctor', 'Relations\RelationsController@saveServicesToDoctor')->name('save.doctors.services');
#************** end many to many **************#

#************** begin has one through **************#
Route::get('has-one-through', 'Relations\RelationsController@getPatientDoctor');
#************** end has one through **************#

#************** begin has many through **************#
Route::get('has-many-through', 'Relations\RelationsController@getCounrtyDoctors');
#************** end has many through **************#

############### end relations routes ###############

##############task###########################
Route::get('get-all-hospitals', 'Relations\RelationsController@getAllHopitals');
#############end task#######################





