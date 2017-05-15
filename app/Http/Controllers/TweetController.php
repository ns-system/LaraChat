<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response; // return Response::make()を使用するために追加
use Input; // Input::get()を使用するために追加
use DB; //DB操作のため

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
            $tweet = new App\Tweet();
            $comment = Input::get('Tweet');
            $user_id = Input::get('userId');
            $thread_id = Input::get('thread_id');
            $tweet->comment = htmlspecialchars($comment);
            $tweet->user_id = htmlspecialchars($userId);
            $tweet->thread_idt = htmlspecialchars($threadId);
            $tweet->save();
            return Response::make('0');
        } catch (Exception $e) {
            return Response::make('1');
        }
    }

}
