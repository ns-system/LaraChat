<nav class="navbar navbar-default navbar-fixed-top title">
    <div class="container-fluid">
        <div class="navbar-header">
            <a class="navbar-brand" href="/home"> JF<small>Marine Bank</small></a>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <ul class="nav navbar-nav">
                <li><a href="chat">メニューＡ</a></li>
                <li><a href="#">メニューＢ</a></li>
                <li><a href="#">メニューＣ</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">

                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><b class="glyphicon glyphicon-th-list"></b> {{Auth::user()->name}}<small> さん</small></a>
                    <ul class="dropdown-menu" role="menu">
                        <li><a href="/logout"><b class="glyphicon glyphicon-log-out"></b> ユーザー情報変更</a></li>
                        <li class="divider"></li>
                        <li><a href="/logout"><b class="glyphicon glyphicon-log-out"></b> ログアウト</a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>