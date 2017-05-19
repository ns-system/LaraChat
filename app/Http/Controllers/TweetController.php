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
            $comment = Input::get('tweet');
            $userId = Input::get('userId');
            $name = Input::get('userName');
            $tweet->comment = e($comment);
            $tweet->user_id = e($userId);

            $tweet->save();

            $val = [
                'name'=>    $name,
                'comment'=> $comment,
                'time'=>    date('Y/n/j H:i:s'),
            ];
            $cls = [
                'align' => 'text-right',
                'offset' => 'col-lg-offset-2',
                'panelColor' => 'alert-success',
                'labelColor' => 'label-primary',
            ];

//            $align = 'text-right';
//            $size = 'col-lg-offset-2';
//            $panelColor = 'alert-success';
//            $labelColor = 'label-primary';
//            }
            $buf = $this->returnHtmlTag($val, $cls);
            $jsbufs = json_encode($buf);
            return $jsbufs;
//            $buf = "<div class=\" col-lg-10 {$size}\">" .
//                    "    <p class=\"{$align}\"><span class=\"label {$labelColor}\">{$name}さん</span></p>" .
//                    "    <div class=\"panel panel-default\" style=\"margin-bottom: 5px; padding: 0;\">" .
//                    "        <div class=\"panel-body {$align} {$panelColor}\" style=\"padding: 5px 10px\">" .
//                    "            <p>" . e($comment) . "</p>" .
//                    "            <small class=\"text-muted\">" . date('Y/n/j H:i:s') . "</small>" .
//                    "        </div>" .
//                    "    </div>" .
//                    "</div>";
//            }else{
//                $buf = '<div class="text-left">'.
//                       '<p class="text-left">other:'.$comment.'</p>'.
//                       '</div>';
//            }
//            $amarg = "success:{$userId}-{$comment}";
//            return $buf;
        } catch (Exception $e) {
            return Response::make('1');
        }
    }

    public function receiveTweet() {
        $bufs = [];
        try {
            $userId = Input::get('userId');
            $count = DB::table('tweets')->where('user_id', '!=', $userId)->count();
            $tmp = $count;
            $i = 0;
            while ($tmp === $count) {
                if ($i == 15) {
                    return 0;
                }
                $count = DB::table('tweets')->where('user_id', '!=', $userId)->count();
                sleep(1);
                $i++;
            }
            $tweetCountDifference = $count - $tmp;
            $tweets = Tweet::where('user_id', '!=', $userId)
                    ->orderBy('created_at', 'desc')
                    ->take($tweetCountDifference)
                    ->get()
            ;
            $cls = [
                'align' => 'text-right',
                'offset' => '',
                'panelColor' => 'alert-success',
                'labelColor' => 'label-primary',
            ];

            foreach ($tweets as $tweet) {
                $val = [
                    'name'=>    e($this->returnName($tweet)),
                    'comment'=> e($tweet->comment),
                    'time'=>    date('Y/n/j H:i:s', strtotime($tweet->create_at)),
                ];
                $bufs[] = $this->returnHtmlTag($val, $cls);
            }
            $jsbufs = json_encode($bufs);
            return $jsbufs;
        } catch (Exception $ex) {
            return 1;
        }
    }

    private function returnName($tweet) {
        try {
            $name = $tweet->user->name;
        } catch (Exception $ex) {
            $name = '名無し';
        }
        return $name;
    }

    private function returnHtmlTag($val, $cls) {
        $buf = "<div class=\" col-lg-10 {$cls['offset']}\">" .
                "    <p class=\"{$cls['align']}\"><span class=\"label {$cls['labelColor']}\">{$val['name']}さん</span></p>" .
                "    <div class=\"panel panel-default\" style=\"margin-bottom: 5px; padding: 0;\">" .
                "        <div class=\"panel-body {$cls['align']} {$cls['panelColor']}\" style=\"padding: 5px 10px\">" .
                "            <p>{$val['comment']}</p>" .
                "            <small class=\"text-muted\">{$val['time']}</small>" .
                "        </div>" .
                "    </div>" .
                "</div>"
        ;
        return $buf;
    }

}
