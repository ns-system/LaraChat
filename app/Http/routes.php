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

Route::get('/', function () { return Auth::check() ? view('user.welcome') : view('auth.login'); });
//Route::get('sample', function(){ return view('welcome'); });
Route::get('phpmyadmin', function(){ return Redirect::to('http://larachat.phpmyadmin'); });

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
/**
 * ログイン後のユーザー用ルート：未ログインユーザーはログイン画面へ
 * tosite
 * 2017/05/16
 */
Route::group(['middleware' => ['auth']], function(){
    Route::get('/home', function(){ return view('user.welcome'); });
});
//Route::get('password/reset',         function(){ return view('auth.password'); });

//Route::get('email', function(){
//    echo 'email sending.';
//    Mail::send('emails', ['name'=>'name'], function($message){
//        $message->to('n.teshima@jf-nssinren.or.jp')->subject('e-mail sample');
//        return 'succesful';
//    });
//});
//Route::post('auth/register', function(){echo 'post';});
//chat
Route::get('chat', function() {
    return view('user.chat.chat');
});
Route::any('tweetsend', 'TweetController@addTweet');
//Route::any('tweetsend', function(){echo 'aaa';});