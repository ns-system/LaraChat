@extends('layouts.master')
@section('title', 'ユーザー登録')
@section('content')

<div class="container">
    <div class="content panel panel-default">
        <div class="panel-heading"><h3>register</h3></div>
        <form method="post" action="register" class="panel-body">
            {!! csrf_field() !!}
            @if ($errors->has('name')) <div class="form-group has-error"> @else <div class="form-group"> @endif
                <label class="control-label" for="name">ユーザー名</label>
                <input type="text" class="form-control" name="name" value="{{ old('name') }}">
                @if ($errors->has('name')) <span class="help-block">{{ $errors->first('name') }}</span> @endif
            </div>
            @if ($errors->has('email')) <div class="form-group has-error"> @else <div class="form-group"> @endif
                <label class="control-label" for="email">メールアドレス</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
                @if ($errors->has('email')) <span class="help-block">{{ $errors->first('email') }}</span> @endif
            </div>

            @if ($errors->has('password')) <div class="form-group has-error"> @else <div class="form-group"> @endif
                <label class="control-label" for="password">パスワード</label>
                <input type="password" class="form-control" name="password" value="{{ old('password') }}">
                @if ($errors->has('password')) <span class="help-block">{{ $errors->first('password') }}</span> @endif
            </div>

            @if ($errors->has('password_confirmation')) <div class="form-group has-error"> @else <div class="form-group"> @endif
                <label class="control-label" for="password_confirmation">パスワード再入力</label>
                <input type="password" class="form-control" name="password_confirmation" value="{{ old('password_confirmation') }}">
                @if ($errors->has('password_confirmation')) <span class="help-block">{{ $errors->first('password_confirmation') }}</span> @endif
            </div>
            <div>
                <button type="submit" class="btn btn-primary btn-block">登録</button>
            </div>
        </form>
    </div>
        <a href="/" class="btn btn-success">Back</a>
</div>
@endsection