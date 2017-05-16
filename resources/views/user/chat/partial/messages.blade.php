<?php
$tweets = App\Tweet::All();
$user = Auth::user();
//    var_dump($tweets);
?>

<div class="message-area">
@foreach($tweets as $tweet)
<!--<div class="row row-flex">-->
@if($tweet->user_id === $user->id)
<div class="text-right">
    <p class="text-right">{{$tweet->comment}}:me</p>
</div>
@else
<div class="text-left">
    <p class="text-left">other:{{$tweet->comment}}</p>
</div>
@endif
<!--</div>-->
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