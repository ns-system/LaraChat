@extends('layouts.master')
@section('title', 'パスワードリセット')
@section('content')
    <div class="container">
    {{-- フラッシュメッセージの表示 --}}
        @if (Session::has('flash_message'))
        <div class="alert alert-success">
            {{ Session::get('flash_message') }}
        </div>
        @endif
        <div class="content panel panel-default">
            <div class="panel-heading"><h3>Login</h3></div>
            <form method="post" action="login" class="panel-body">
                {!! csrf_field() !!}
                @if ($errors->has('email')) <div class="form-group has-error"> @else <div class="form-group"> @endif
                    <label class="control-label" for="email">メールアドレス</label>
                    <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                    @if ($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
                </div>

                @if ($errors->has('password'))
                <div class="form-group has-error"> @else <div class="form-group"> @endif
                    <label class="control-label" for="password">パスワード</label>
                    <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                    @if ($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
                </div>

                <div>
                    <button type="submit" class="btn btn-primary btn-block">Login</button>
                </div>
                <div><a href="password/email">Forgot your password?</a></div>
            </form>
        </div>
            <a href="/" class="btn btn-success">Back</a>
    </div>
@endsection