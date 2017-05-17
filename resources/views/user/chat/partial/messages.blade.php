<?php
$tweets = App\Tweet::orderBy('updated_at', 'desc')->take(10)->get();
$user = Auth::user();
//    var_dump($tweets);
?>

<div class="message-area row container-fluid">
@foreach($tweets as $tweet)
@if($tweet->user_id === $user->id)
<p class="text-right"><span class="label label-primary">{{$tweet->User->name}}さん</span></p>
<div class="panel panel-default col-lg-8 col-lg-offset-4" style="margin-bottom: 5px; padding: 0;">
    <div class="panel-body text-right alert-success" style="padding: 5px 10px">
        <p>{{$tweet->comment}}</p>
        <small class="text-muted">{{date('Y/n/j H:i:s', strtotime($tweet->created_at))}}</small>
    </div>
</div>
@else
<p class="text-left"><span class="label label-default">{{$tweet->User->name}}さん</span></p>
<div class="panel panel-default col-lg-8" style="margin-bottom: 5px; padding: 0;">
    <div class="panel-body text-left" style="padding: 5px 10px">
        <p>{{$tweet->comment}}</p>
        <small class="text-muted">{{date('Y/n/j H:i:s', strtotime($tweet->created_at))}}</small>
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