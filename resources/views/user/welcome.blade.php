<?php
//$a = 123;
//$b = 234;
//$c = $a + $b;
//echo $c;
//$sam  = App\User::find(1);
//$sam  = App\User::where('id', 1)->tweets->All();
//foreach ($sam->tweets as $tweet){
//    echo $tweet->comment;
//}
//$test = $sam->tweets()->All();
//var_dump($test);
//var_dump($sam);
//var_dump($tes);
//echo $sam->email;
//echo $sam->comment;
//$test = $sam->commnent;
//var_dump($test);
//echo $test->email;
//var_dump($sam->tweet());
//$user = Auth::user();
if(Auth::check()){ echo Auth::user()->name; }
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="https://nkmr6194.github.io/Umi/css/bootstrap.css">
    </head>
    <body>
        <div class="container">
            <div class="content">
                <div class="title">Laravel 5</div>
                <p><a href="login" class="btn btn-success">Login</a></p>
                <p><a href="register" class="btn btn-primary">Register</a></p>
                <p><a href="logout" class="btn btn-danger">Logout</a></p>
            </div>
        </div>
    </body>
</html>
