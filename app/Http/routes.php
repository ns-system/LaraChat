<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    if(Auth::check()) {
        return view('user.welcome');
    } else {
        return view('auth.login');
    }
});
//Route::get('sample', function(){ return view('welcome'); });
Route::get('phpmyadmin', function(){ return Redirect::to('http://larachat.phpmyadmin'); });

//Route::controller('hello', 'PagesController');
//Route::get('hello', 'PagesController@index');

// login
Route::get( 'auth/login', function(){ return view('auth.login'); });
Route::post('auth/login', 'Auth\AuthController@postLogin');
//Route::post('login', function(){echo 'safdfsa';});
Route::get('logout', 'Auth\AuthController@getLogout');

// register
Route::get( 'auth/confirm',                 function(){ return view('auth.confirm'); });
Route::get( 'auth/register',                'Auth\AuthController@getRegister');
Route::post('auth/register',                'Auth\AuthController@postRegister');
Route::get('auth/register/confirm/{token}', 'Auth\AuthController@getConfirm');

// reset password
Route::get('auth/password/email',         'Auth\PasswordController@getEmail');
Route::post('auth/password/email',        'Auth\PasswordController@postEmail');
Route::get('auth/password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('auth/password/reset',        'Auth\PasswordController@postReset');
Route::get('/home', function(){ return view('user.welcome'); });
//Route::get('password/reset',         function(){ return view('auth.password'); });

//Route::get('email', function(){
//    echo 'email sending.';
//    Mail::send('emails', ['name'=>'name'], function($message){
//        $message->to('n.teshima@jf-nssinren.or.jp')->subject('e-mail sample');
//        return 'succesful';
//    });
//});
//Route::post('auth/register', function(){echo 'post';});
