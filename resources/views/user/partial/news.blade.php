<?php
$array = [];
for ($i = 0; $i < 5; $i++) {
    $array[] = array(
        'num' => $i,
        'buf' => 'sample',
        'dat' => '2017/05/0' . ($i + 1),
    );
}
//var_dump($array);
?>
<div class="col-md-8 col-md-offset-2">
    <div class="panel panel-primary">
        <div class="panel-heading"><span class="title">What's New</span></div>
        <!--    <div class="panel-body">
                パネルの内容
            </div>-->
        <ul class="list-group">
            @foreach($array as $date)
            <li class="list-group-item title">
                <span class="label label-info">{{date('n/j', strtotime($date['dat']))}}</span>
                <span>{{$date['num']}}:{{$date['buf']}}です。明日はなんとかです。</span>
            </li>
            @endforeach

        </ul>
        <!--    <div class="panel-footer">
                パネルのフッター
            </div>-->
    </div>
</div>