<?php
$thread = 1;
$user   = Auth::user();
$count  = \App\Tweet::where('thread_id', $thread)->count();
////var_dump($user);
?>
<form method="post" action="/chat/add" id="add">
    <div class="input-group">
        {!! csrf_field() !!}
        <input type="text" id="tweet"      name="tweet" class="form-control" placeholder="テキスト入力欄">
        <input type="hidden" id="userId"   name="userId"   value="{{$user->id}}">
        <input type="hidden" id="threadId" name="threadId" value="{{$thread}}">
        <span class="input-group-btn">
            <button type="submit" name="add" class="btn btn-success">ボタン</button>
        </span>
    </div>
</form>

<div style="display: hidden;">
    <form method="post" action="/chat/recieve" id="update" style="display: none;">
        {!! csrf_field() !!}
        <input type="hidden" id="updateUserId"   name="updateUserId"   value="{{$user->id}}">
        <input type="hidden" id="updateThreadId" name="updateThreadId" value="{{$thread}}">
        <input type="hidden" id="updateCount"    name="updateCount"    value="{{$count}}">
        <button type="submit" name="update" class="btn btn-success">Update</button>
    </form>
</div>