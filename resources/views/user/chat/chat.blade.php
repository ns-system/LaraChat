@extends('layouts.master')
@section('title', 'Top')

@section('head')
@parent
        <meta name="csrf-token" content="<?php echo csrf_token() ?>">
@endsection

@section('content')
@include('user.chat.partial.window')
@include('user.chat.partial.messages')
@endsection

@section('js')
    @parent
        <script type="text/javascript" src="{{asset('assets/js/chat/chat.js')}}"></script>
    @endsection