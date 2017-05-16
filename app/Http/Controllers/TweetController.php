<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response; // return Response::make()を使用するために追加
use Input; // Input::get()を使用するために追加
use DB; //DB操作のため

use App\Tweet; // モデル定義されてなくて引っかかった
//use User;
class TweetController extends Controller {

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        //
    }

    public function addTweet() {
        try {
            $tweet = new Tweet;
            $comment           = Input::get('tweet');
            $userId            = Input::get('userId');
//            $threadId          = Input::get('threadId');
            $tweet->comment    = e($comment);
            $tweet->user_id    = e($userId);
//            $tweet->thread_id  = e($threadId);
//            $tweet->user_id = 10;
//            $tweet->comment = "Your Nice!!";
            $tweet->save();
//            $amarg = $comment . "user" . $userId . "すれ" . $threadId;

//            if($userId === Auth::user()->id){
                $buf = '<div class="text-right">'.
                       '<p class="text-right">me:'.$comment.'</p>'.
                       '</div>';
                
//            }else{
//                $buf = '<div class="text-left">'.
//                       '<p class="text-left">other:'.$comment.'</p>'.
//                       '</div>';
//            }
//            $amarg = "success:{$userId}-{$comment}";
            return $buf;
        } catch (Exception $e) {
            return Response::make('1');
        }
    }

}
