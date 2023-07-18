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
    return 'dashboard';
});
