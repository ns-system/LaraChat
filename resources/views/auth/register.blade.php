@extends('layouts.master')
@section('title', 'ユーザー登録')

<!--@section('head')
@parent
@endsection-->

@section('content')

<div class="content panel panel-primary">
    <div class="panel-heading"><h5><b class="glyphicon glyphicon-user"></b> Register</h5></div>
    <form class="form-horizontal panel-body" role="form" method="post" action="/auth/register">
        {!! csrf_field() !!}
        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="name">ユーザー名</label>
            <div class="col-md-7">
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="email">メールアドレス</label>
            <div class="col-md-7">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="password">パスワード</label>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
            </div>
        </div>

        <div class="form-group">
            <label class="control-label col-md-3 col-md-offset-1" for="password_confirmation">パスワード確認</label>
            <div class="col-md-7">
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
            </div>
        </div>

        <div class="col-md-offset-4 col-md-7">
            <button type="submit" class="btn btn-warning btn-block btn-lg">登録</button>
        </div>
    </form>
</div>
@include('auth.partial.info')
@endsection

<!--@section('js')
    @parent
@endsection-->
