@extends('layouts.master')
@section('title', 'Confirm')
@section('content')
    {{-- フラッシュメッセージの表示 --}}
    <div class="alert alert-success">
        <p>メールを送信しました。</p>
        <p>登録されているメールアドレスを確認してください。</p>
    </div>
    <a href="/" class="btn btn-success">Back</a>
@endsection
