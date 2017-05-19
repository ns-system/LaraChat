$(function ()
{
    $token = $('meta[name="csrf-token"]').attr('content');
    console.log($token);
    $.ajaxSetup({ headers:{'X-CSRF-TOKEN': $token} });

    $('#post').click(function ()
    {
        if ($('#tweet').val() === '') //投稿欄空欄だったら
        {
            alert('何か入力してください！');
            return false;
        }
        $.ajax({
            type: "POST", //POSTで渡す
            url: "/tweetsend", //POST先
            // beforeSend: function (xhr) {
            //     return xhr.setRequestHeader('X-CSRF-TOKEN', "{{csrf_token()}}");
            // },
            data:{
                "tweet":    $('#tweet').val(), //投稿
                "userId":  $('#userId').val() , //ユーザーID
                "userName": $('#userName').val(), //ユーザーID
                "threadId": $('#threadId').val(), //板ID
            },
            success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
            {
                if (hoge === 0) //返り値が0→成功
                {
                    alert('正常終了しました');
                } else if (hoge === 1){ //返り値が1→失敗
                    alert('失敗しました');
                }
                console.log("END:SUCCESS");
                $('#tweet').val('');
                setPost(hoge);
            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                console.log(
                        XMLHttpRequest,
                        textStatus,
                        errorThrown
                );
                alert('処理できませんでした');
            }
        });
        return false; //ページが更新されるのを防ぐ
    });
//    $(window).load(function(){
      checkupdate();
//    });
});

function setPost(message){
    $('.message-area').prepend(message);
}

function checkupdate(){
    $.ajax({
        type: "POST", //POSTで渡す
        url: "/tweetupdate", //POST先
        data:{
            "userId":  $('#userId').val() , //ユーザーID
        },
        success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
        {
//                if (hoge === 0) //返り値が0→生存確認
//                {
//                    checkupdate();
//                } else if (hoge === 1){ //返り値が1→失敗
//                    alert('他のユーザーのコメント取得時にエラーが起きました');
//                }
            console.log("END:SUCCESS");
             // todo 複数回回そう 
            //setPost(hoge);
//                console.log(hoge);
//                checkupdate();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
        {
//                console.log(
//                        XMLHttpRequest,
//                        textStatus,
//                        errorThrown
//                );
            alert('処理できませんでした、ページを更新して下さい');
        }
    });
}