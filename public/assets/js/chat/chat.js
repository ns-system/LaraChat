$(function ()
{
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(token);
    $.ajaxSetup({ headers:{'X-CSRF-TOKEN': token} });
    checkupdate();

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
                console.log("END:SUCCESS"+hoge);
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
//    console.log(jsonStrDecode(message));
    $('.message-area').prepend(message);
}

function checkupdate(){
//    var token = $('meta[name="csrf-token"]').attr('content');
//    console.log(token);
//    $.ajaxSetup({ headers:{'X-CSRF-TOKEN': token} });
//    checkupdate(token);
    $.ajax({
        type: "POST", //POSTで渡す
        url: "/tweetupdate", //POST先
        data:{
            "userId":  $('#userId').val() , //ユーザーID
        },
        success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
        {
            if (hoge === 0) //返り値が0→生存確認
            {
                checkupdate();
            } else if (hoge === 1){ //返り値が1→失敗
                alert('他のユーザーのコメント取得時にエラーが起きました');
            } else {
                setPost(hoge);
            }
            console.log("END:SUCCESS");
//              todo 複数回回そう 
            console.log(hoge);
            checkupdate();
        },
        error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
        {
            var time = new Date();
            console.log("ERROR = "+time.getHours()+":"+time.getMinutes()+":"+time.getSeconds());
//                console.log(
//                        XMLHttpRequest,
//                        textStatus,
//                        errorThrown
//                );
//            alert('処理できませんでした、ページを更新して下さい');
        }
    });
}
//function jsonStrDecode(str = ''){
//    var arrs = str.match(/\\u.{4}/g);
//    var t    = "";
//    for(i = 0; i < arrs.length; i++){
//        t += String.fromCharCode(arrs[i].replace("\\u","0x"));
//    }
//    return(t);
//}