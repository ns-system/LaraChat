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
    return view('welcome');
});
//Route::get('sample', function(){ return view('welcome'); });
Route::get('phpmyadmin', function(){ return Redirect::to('http://larachat.phpmyadmin'); });

//Route::controller('hello', 'PagesController');
//Route::get('hello', 'PagesController@index');

// login
Route::get( 'login', function(){ return view('auth.login'); });
Route::post('login', 'Auth\AuthController@postLogin');
Route::get('logout', 'Auth\AuthController@getLogout');

// register
Route::get( 'confirm',                 function(){ return view('auth.confirm'); });
Route::get( 'register',                'Auth\AuthController@getRegister');
Route::post('register',                'Auth\AuthController@postRegister');
Route::get('register/confirm/{token}', 'Auth\AuthController@getConfirm');

// reset password
Route::get('password/email',         'Auth\PasswordController@getEmail');
Route::post('password/email',        'Auth\PasswordController@postEmail');
Route::get('password/reset/{token}', 'Auth\PasswordController@getReset');
Route::post('password/reset',        'Auth\PasswordController@postReset');
//Route::get('password/reset',         function(){ return view('auth.password'); });

//Route::get('email', function(){
//    echo 'email sending.';
//    Mail::send('emails', ['name'=>'name'], function($message){
//        $message->to('n.teshima@jf-nssinren.or.jp')->subject('e-mail sample');
//        return 'succesful';
//    });
//});
//Route::post('auth/register', function(){echo 'post';});