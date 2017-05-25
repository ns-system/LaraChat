<?php
$tweets = \App\Tweet::orderBy('tweet_id', 'desc')->take(10)->get();
$user   = Auth::user();
//    var_dump($tweets);
?>

<div class="message-area row container-fluid">
    @foreach($tweets as $tweet)
    <?php $me     = ($tweet->user_id === $user->id) ? true : false; ?>
    <div class=" col-lg-10 @if($me) col-lg-offset-2 @endif">
        <p class="@if($me) text-right @else text-left @endif"><span class="label @if($me) label-primary @else label-default @endif">{{$tweet->user->name or '名無し'}}さん</span></p>
        <div class="panel panel-default" style="margin-bottom: 5px; padding: 0;">
            <div class="panel-body @if($me) alert-success text-right @else text-left @endif" style="padding: 5px 10px">
                <p>{{$tweet->comment}}</p>
                <small class="text-muted">{{date('Y/n/j H:i:s', strtotime($tweet->created_at))}}</small>

                @if($me)
                <!--編集・削除フォーム-->
                <!--                <form action="/chat/edit" method="post" style="display:inline-block;" class="edit">
                                    {{ csrf_field() }}
                                    <input type="hidden" name="editComment" value="{{$tweet->comment}}">
                                    <input type="hidden" name="editId"      value="{{$tweet->tweet_id}}" >
                                    <button type="submit" class="btn btn-xs btn-link"><span class="text-warning">編集</span></button>
                                </form>-->
                <div class="edit-content" style="display: inline-block;">
                    <input type="hidden" name="editComment" value="{{$tweet->comment}}">
                    <input type="hidden" name="editId"      value="{{$tweet->tweet_id}}">
                    <button class="btn btn-xs btn-link">
                        <span class="text-warning edit" data-toggle="modal" data-target="#myModal">編集</span>
                    </button>
                </div>
                
                <form action="/chat/erase" method="post" style="display:inline-block;">
                    {{ csrf_field() }}
                    <input type="hidden" name="eraseId" value="{{$tweet->tweet_id}}" >
                    <button type="submit" name="erase" class="btn btn-xs btn-link" onclick="return confirm('削除しますか？');"><span class="text-danger">削除</span></button>
                </form>
                @endif
            </div>
        </div>
    </div>
    @endforeach
</div>

<div class="modal fade" id="myModal">
    <form action="/chat/edit" method="post">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Modal タイトル</h4>
                </div>
                <div class="modal-body">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <textarea            name="editComment" class="form-control editComment"></textarea>
                        <input type="hidden" name="editId"      class="editId">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-warning">編集</button>
                </div>
            </div>
        </div>
    </form>
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