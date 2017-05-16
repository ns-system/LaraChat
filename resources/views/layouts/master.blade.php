<!DOCTYPE html>
<html lang="ja">
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        {{-- Header --}}
        @section('head')
        <link rel="stylesheet" href="https://nkmr6194.github.io/Umi/css/bootstrap.css">
        <link href="http://getbootstrap.com/examples/sticky-footer/sticky-footer.css" rel="stylesheet">
        @show
    </head>
    <body style="padding-top: 80px;">
        {{-- Navigation Bar --}}
        @if(Auth::check())
        @include('layouts.login.navbar')
        @else
        @include('layouts.notlogin.navbar')
        @endif
        {{-- Contents --}}
        <div class="container-fluid">
            <div class="row">
                @if(Auth::check())
                <div class="col-md-3">
                    {{-- Side Bar --}}
                    @include('layouts.sidebar')
                </div>
                <div class="col-md-9" style="padding-top: 20px;">
                    @else
                    <div class="col-md-6 col-md-offset-3" style="padding-top: 20px;">
                        @endif

                        {{-- Main Contents --}}
                        @yield('content')
                    </div>
                </div>
            </div>
            {{-- Footer --}}
            @include('layouts.footer')
            @section('js')
            <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
            <script src="https://nkmr6194.github.io/Umi/js/bootstrap.min.js"></script>
            @show
    </body>
</html>