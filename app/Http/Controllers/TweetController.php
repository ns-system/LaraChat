<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response; // return Response::make()を使用するために追加
use Input; // Input::get()を使用するために追加
use DB; //DB操作のため
use App\Tweet; // モデル定義されてなくて引っかかった
use App\User;

class TweetController extends Controller
{

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
            $tweet = \Chat::addTweet()
                    ->getTweet()
            ;
            return redirect('/chat');
//            $buf   = $this->setValues($tweet);
//            return json_encode($buf);
        } catch (Exception $e) {
            return Response::make('-1');
        }
    }

    public function receiveTweet() {
        $bufs = [];
        try {
            $chat = \Chat::setTweetCount();
            sleep(3);

            if ($chat->getBeforeCount() === $chat->getAfterCount())
            {
                return 0;
            }
            $tweets = $chat->recieveTweet()
                    ->getTweet()
            ;
            foreach ($tweets as $tweet) {
                $bufs[] = $this->setValues($tweet);
            }
            $json = [
                'afterCount' => $chat->getAfterCount(),
                'val'        => $bufs
            ];
            return json_encode($json);
//            $jsbufs = json_encode($bufs);
//            return $jsbufs;
        } catch (Exception $ex) {
            return -1;
        }
    }

    private function setValues($tweet) {

        $name = is_null($tweet->user) ? 'ななし' : $tweet->user->name;
        $val  = [
            'name'    => e($name),
            'comment' => e($tweet->comment),
            'time'    => date('Y/n/j H:i:s', strtotime($tweet->created_at)),
        ];
        return $val;
    }

    public function tweetErase() {
        \Chat::eraseTweet();
        \Session::flash('flash_message', '発言を削除しました。');
        return redirect('/chat');
    }

    public function tweetEdit() {
        $tweetId     = Input::get('editId');
        $editComment = Input::get('editComment');
//        echo $tweetId . $editComment;

        try {
            $tweet          = Tweet::where('tweet_id', $tweetId)->first();
            $tweet->comment = $editComment;
            $tweet->save();
            \Session::flash('flash_message', '発言を編集しました。');
        } catch (Exception $ex) {
            \Session::flash('flash_message', '発言の編集ができませんでした。');
        }
        return redirect('/chat');
    }

}
