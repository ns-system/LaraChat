@extends('layouts.master')
@section('title', 'ユーザー登録')

<!--@section('head')
@parent
@endsection-->

@section('content')

<div class="content panel panel-primary">
    <div class="panel-heading"><h5><b class="glyphicon glyphicon-log-in"></b> Password Reset</h5></div>
    <form class="form-horizontal panel-body" role="form" method="post" action="/auth/password/email">
        {!! csrf_field() !!}

        <div class="form-group">
            <label class="col-md-3 col-md-offset-1 control-label">メールアドレス</label>
            <div class="col-md-7">
                <input type="email" class="form-control" name="email" value="{{ old('email') }}" placeholder="Enter your email.">
            </div>
        </div>

        <div class="form-group">
            <div class="col-md-7 col-md-offset-4">
                <button type="submit" class="btn btn-success btn-lg btn-block"><b class="glyphicon glyphicon-envelope"></b> メールを送る</button>
            </div>
        </div>
    </form>
</div>

@include('auth.partial.info')

@endsection

<!--@section('js')
    @parent
@endsection-->
