<?php

namespace App\Services\Chat;

//use Illuminate\Http\Request;
//use App\Http\Requests;
//use App\Http\Controllers\Controller;
//use Response; // return Response::make()を使用するために追加
use Input; // Input::get()を使用するために追加
//use DB; //DB操作のため
use App\Tweet; // モデル定義されてなくて引っかかった

//use App\User;

class Chat
{

    protected $tweet;
    protected $beforeCount;
    protected $afterCount;

//    public function getInput() {
//        return $this->input;
//    }

    public function getTweet() {
        return $this->tweet;
    }

    public function addTweet() {
        try {
            $tweet            = new Tweet;
            $tweet->comment   = Input::get('tweet');
            $tweet->thread_id = Input::get('threadId');
            $tweet->user_id   = Input::get('userId');
            $tweet->save();
            $this->tweet      = $tweet;
        } catch (\Exception $ex) {
            throw new \Exception('Error:' . $ex->getMessage());
        }
        return $this;
    }

    public function recieveTweet() {
        try {
//            echo "{$this->afterCount} - {$this->beforeCount} = ".($this->afterCount - $this->beforeCount);
            $this->tweet = Tweet::where('user_id', '!=', Input::get('updateUserId'))
                    ->orderBy('tweet_id', 'desc')
                    ->take($this->afterCount - $this->beforeCount)
                    ->get()
            ;
            $this->tweet = $this->tweet->sortBy('tweet_id');
            return $this;
        } catch (\Exception $ex) {
            throw new \Exception('Error:' . $ex);
        }
    }

    public function setTweetCount() {
        try {
//            echo 'sample';
            if(is_null(Input::get('updateThreadId')) || is_null(Input::get('updateCount'))){
                throw new \Exception('err');
            }
            $this->afterCount  = Tweet::where('thread_id', '=', Input::get('updateThreadId'))
                    ->count()
            ;
            $this->beforeCount = Input::get('updateCount');
            return $this;
        } catch (\Exception $ex) {
            throw new \Exception($ex);
        }
    }
    
    public function eraseTweet(){
//        $tweetId = Input::get('tweetId');
        try {
            $id = Input::get('eraseId');
            $tweet = Tweet::find($id);
            if(count($tweet) === 0){
                throw new \Exception('削除したい発言が見つかりません。');
//                throw new \Expectation('のっとふぁうんど');
            }
            $tweet->delete();
//            echo $tweet->comment;
//            DB::table('tweets')->where('tweet_id', '=', $tweetId)->delete();
//            return view('user.chat.chat');
        } catch (\Exception $ex) {
//            echo $ex->getMessage();
            throw new \Exception($ex);
//            return 1;
        }        
    }

    public function getBeforeCount() {
        return $this->beforeCount;
    }
    public function getAfterCount() {
        return $this->afterCount;
    }

//    protected $file;
//
//    public function __construct($file) {
//        $this->file = $file;
//    }
//    public function output(){
//        return $this->file->put('report.txt', 'report');
//    }
}
