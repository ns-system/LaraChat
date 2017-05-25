@extends('layouts.master')
@section('title', 'ログイン')

<!--@section('head')
@parent
@endsection-->

@section('content')
<div class="content panel panel-primary">
    <div class="panel-heading"><h5><b class="glyphicon glyphicon-log-in"></b> Login</h5></div>
    <form class="form-horizontal panel-body" role="form" method="post" action="/auth/login">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="email">メールアドレス</label>
            <div class="col-md-7">
                <input type="text" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your e-mail.">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="password">パスワード</label>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}" placeholder="Enter your password.">
            </div>
        </div>

        <div class="col-md-offset-4 col-md-7">
            <button type="submit" class="btn btn-success btn-block btn-lg">ログイン</button>
            <a href="/auth/password/email"><b class="glyphicon glyphicon-question-sign"></b>パスワードを忘れましたか？</a>
        </div>
    </form>
</div>
@include('auth.partial.info')

@endsection

<!--@section('js')
    @parent
@endsection-->
