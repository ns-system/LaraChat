<?php
//             $tweet = new App\Tweet();
//            $tweet->comment = 'ha';
//            $tweet->user_id = 1;
//            $tweet->thread_idt = 1;
//            $tweet->save();
?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="<?php echo csrf_token()?>">
        <title>chat</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">

$(function ()
{
    $token = $('meta[name="csrf-token"]').attr('content');
    alert($token);
    $('#post').click(function () //送信ボタンをクリック
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        if ($('#tweet').val() == '') //投稿欄空欄だったら
        {
            alert('何か入力してください！'); //アラート
        } else //空欄がない
        {
            $.ajax(
                    {
                        type: "POST", //POSTで渡す
                        url: "/tweetsend", //POST先
                        beforeSend: function (xhr) {
                            return xhr.setRequestHeader('X-CSRF-TOKEN', "{{csrf_token()}}");
                        },
                        data:
                                {
                                    "tweet": $('#tweet').val(), //投稿
                                    "userId": $('#userId').val(), //ユーザーID
                                    "threadId": $('#threadId').val() //板ID
                                },
                        success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
                        {
                            if (hoge == 0) //返り値が0→成功
                            {
                                alert('正常終了しました');
                            } else if (hoge == 1) //返り値が1→失敗
                            {
                                alert('失敗しました');
                            }
                            $('#test').val(hoge);
                        },
                        error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
                        {
                            alert('処理できませんでした');
                        }
                    });
            return false; //ページが更新されるのを防ぐ
        }
    });
});
        </script>
    </head>
    <body> 
       <?php
       $tags = get_meta_tags('./');
       var_dump($tags);
       
       ?>
        <input type="text" id="tweet">
        <?php
        $user = Auth::user();
        
        $thread = 1;
        echo ' <input type="hidden" id="userId" value=" ' . $user['user_id'] . '" >';
        echo ' <input type="hidden" id="threadId" value=" ' . $thread . '" >';
         
        ?>
        <input type="button" id="post" value="投稿">
         
        <input type="text" id="test">
    </body>
</html>
