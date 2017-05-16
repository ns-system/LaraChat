@extends('layouts.master')
@section('title', 'ログイン')

<!--@section('head')
@parent
@endsection-->

@section('content')
<div class="content panel panel-primary">
    <div class="panel-heading"><h5><b class="glyphicon glyphicon-log-in"></b> Password Reset</h5></div>
    <form class="form-horizontal panel-body" role="form" method="post" action="/auth/password/reset">

        <input type="hidden" name="_token" value="{{ csrf_token() }}">
        <input type="hidden" name="token" value="{{ $token }}">

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="email">メールアドレス</label>
            <div class="col-md-7">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="email">パスワード</label>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="email">パスワード確認</label>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password_confirmation">
            </div>
        </div>

        <div class="col-md-offset-4 col-md-7">
            <button type="submit" class="btn btn-lg btn-block btn-danger">
                <b></b>
                パスワードリセット</button>
        </div>

    </form>
</div>
@include('auth.partial.info')
@endsection

<!--@section('js')
    @parent
@endsection-->