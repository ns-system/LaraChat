<?php
$tweets = App\Tweet::orderBy('tweet_id', 'desc')->take(10)->get();
$user = Auth::user();
//    var_dump($tweets);
?>

<div class="message-area row container-fluid">
    @foreach($tweets as $tweet)
    @if($tweet->user_id === $user->id)
    <div class=" col-lg-10 col-lg-offset-2">
        <p class="text-right"><span class="label label-primary">{{$tweet->User->name or '名無し'}}さん</span></p>
        <div class="panel panel-default" style="margin-bottom: 5px; padding: 0;">
            <div class="panel-body text-right alert-success" style="padding: 5px 10px">
                <p>{{$tweet->comment}}</p>
                <small class="text-muted">{{date('Y/n/j H:i:s', strtotime($tweet->created_at))}}</small>

                <form action="/chat/edit" method="post" style="display:inline-block;" class="edit">
                    {{ csrf_field() }}
                    <input type="hidden" name="editComment" value="{{$tweet->comment}}">
                    <input type="hidden" name="editId"      value="{{$tweet->tweet_id}}" >
                    <button type="submit" value="{{$tweet->tweet_id}}" class="btn btn-xs btn-link"><span class="text-warning">編集</span></button>
                </form>

                <form action="/chat/erase" method="post" style="display:inline-block;">
                    {{ csrf_field() }}
                    <input type="hidden" name="eraseId" value="{{$tweet->tweet_id}}" >
                    <button type="submit" name="erase" class="btn btn-xs btn-link" onclick="return confirm('削除しますか？');"><span class="text-danger">削除</span></button>
                </form>

            </div>
        </div>
    </div>
    @else
    <div class=" col-lg-10">
        <p class="text-left"><span class="label label-default">{{$tweet->User->name or '名無し'}}さん</span></p>
        <div class="panel panel-default" style="margin-bottom: 5px; padding: 0;">
            <div class="panel-body text-left" style="padding: 5px 10px">
                <p>{{$tweet->comment}}</p>
                <small class="text-muted">{{date('Y/n/j H:i:s', strtotime($tweet->created_at))}}</small>
            </div>
        </div>
    </div>
    @endif
    @endforeach
</div>
<!--<div class="media">
    <a class="media-left" href="#">
        <img src="../img/sample-64x64.png">
    </a>
    <div class="media-body">
        <h4 class="media-heading">見出しＡ</h4>
        内容。これはサンプル。
    </div>
</div>-->