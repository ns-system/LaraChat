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
                "userId":   $('#userId').val(), //ユーザーID
                "userName": $('#userName').val(), //ユーザーID
                "threadId": $('#threadId').val(), //板ID
            },
            success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
            {
                if (hoge === 0) //返り値が0→成功
                {
                    alert('正常終了しました');
                } else if (hoge === 1){ //返り値が1→失敗
//                } else {
                    alert('失敗しました');
                }
//                $('#test').html(hoge);
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
});

function setPost(message){
//    var content = '<div class="text-left">'+
//                  '    <p class="text-left">'+message+'</p>'+
//                  '</div>';
    $('.message-area').prepend(message);
}