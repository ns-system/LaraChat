<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>chat</title>
        <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
        <script type="text/javascript">
             $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });  
  console.error('19');
            $(function () {
                 alert("test");
                // 「#post」をクリックしたとき
                $('#post').click(function () {
                   alert("test");
                    // Ajax通信を開始する
                    $.ajax(
                           
                            {
                                   
                                type: "POST", //POSTで渡す
                                url: "tweetsend", //POST先
                                data:
                                        {
                                            tweet: $('#tweet').val(),
                                            userId: $('#userID'),
                                            threadId: $('#threadId')
                                        },
                                success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
                                {
                                    if (hoge === 0) //返り値が0→成功
                                    {
                                        alert('正常終了しました');
                                    } else if (hoge === 1) //返り値が1→失敗
                                    {
                                        alert('失敗しました');
                                    }
                                },
                                error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
                                {
                                    alert('処理できませんでした');
                                }
                            });
                            alert("test");
                    return false; //ページが更新されるのを防ぐ
                }
                );
            }
            );
    console.error('59');
        </script>
    </head>
    <body>
        <header>
            <a href="auth/logout">logout</a>
        </header>
        <input type="text" id="tweet">
        <?php
        $user = Auth::user();
        $thread = 1;
        echo ' <input type="hidden" id="userId" value=" ' . $user['user_id'] . '" >';
        echo ' <input type="hidden" id="threadId" value=" ' . $thread . '" >';
        ?>
        <input type="button" id="post" value="投稿">
    </body>
</html>
