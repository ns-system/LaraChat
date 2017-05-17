<?php
$thread = 1;
$user = Auth::user();
//var_dump($user);
?>
<div class="input-group">
    <input type="text" id="tweet" class="form-control" placeholder="テキスト入力欄">
    <input type="hidden" id="userId" value="{{$user->id}}">
    <input type="hidden" id="threadId" value="{{$thread}}">
    <input type="hidden" id="userName" value="{{$user->name}}">
    <span class="input-group-btn">
        <button type="button" id="post" class="btn btn-success">ボタン</button>
    </span>
</div>
<p id="test"></p>