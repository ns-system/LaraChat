@extends('layouts.master')
@section('title', 'Top')

<!--@section('head')
@parent
@endsection-->

@section('content')
@include('user.partial.news')
@endsection

@section('footer-add')
<nav>
    <ul class="pagination pagination-sm" style="margin: 5px 0;">
        <li>
            <a href="#" aria-label="前のページへ">
                <span aria-hidden="true">«</span>
            </a>
        </li>
        <li class="active"><a href="#">1</a></li>
        <li><a href="#">2</a></li>
        <li><a href="#">3</a></li>
        <li><a href="#">4</a></li>
        <li><a href="#">5</a></li>
        <li>
            <a href="#" aria-label="次のページへ">
                <span aria-hidden="true">»</span>
            </a>
        </li>
    </ul>
</nav>
@endsection
<!--@section('js')
    @parent
@endsection-->