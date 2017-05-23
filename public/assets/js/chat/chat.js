$(function ()
{
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(token);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
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
            data: {
                "tweet": $('#tweet').val(), //投稿
                "userId": $('#userId').val(), //ユーザーID
                "userName": $('#userName').val(), //ユーザーID
                "threadId": $('#threadId').val(), //板ID
            },
            success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
            {
                if (hoge === 0) //返り値が0→成功
                {
                    alert('正常終了しました');
                } else if (hoge === 1) { //返り値が1→失敗
                    alert('失敗しました');
                }
                console.log("END:SUCCESS" + hoge);
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

function setPost(message) {
//    console.log(jsonStrDecode(message));
    $('.message-area').prepend(message);
}

function checkupdate() {
//    var token = $('meta[name="csrf-token"]').attr('content');
//    console.log(token);
//    $.ajaxSetup({ headers:{'X-CSRF-TOKEN': token} });
////    checkupdate(token);
    $.ajax({
        type: "POST", //POSTで渡す
        url: "/tweetupdate", //POST先
        data: {
            "userId": $('#userId').val(), //ユーザーID
            "threadId": $('#threadId').val(), //板ID
        },
        success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
        {
            var align = 'text-left';
            var size = '';
            var labelColor = 'label-primary';
            if (hoge * 1 === 0) //返り値が0→生存確認
            {
                checkupdate();
            } else if (hoge * 1 === 1) { //返り値が1→失敗
                alert('他のユーザーのコメント取得時にエラーが起きましたページを更新してください');
            } else {
                var tweets = JSON.parse(hoge);


                for (i = tweets.length - 1; i >= 0; i--) {
                    var name = tweets[i].name;
                    var time = tweets[i].time;
                    var comment = tweets[i].comment;
                    var message = "<div class=\" col-lg-10 " + size + "\">" +
                            "    <p class=\"" + align + "}\"><span class=\"label " + labelColor + "\">" + name + "さん</span></p>" +
                            "    <div class=\"panel panel-default\" style=\"margin-bottom: 5px; padding: 0;\">" +
                            "        <div class=\"panel-body " + align + " \" style=\"padding: 5px 10px\">" +
                            "            <p>" + comment + "</p>" +
                            "            <small class=\"text-muted\">" + time + "</small>" +
                            "        </div>" +
                            "    </div>" +
                            "</div>";
                    setPost(message);
                }

                checkupdate();
            }//todo 成功時だけ表示する

        },
        error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
        {
            var time = new Date();
            console.log("ERROR = " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds());
            console.log(
                    XMLHttpRequest,
                    textStatus,
                    errorThrown
                    );
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
function eraseTweet(tweetId = 0) {
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(token);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
    if (window.confirm("この発言を削除しますか？"))
    {
        $.ajax({

            type: "POST", //POSTで渡す
            url: "/tweetErase", //POST先
            data: {
                "tweetId": tweetId //投稿ID
            },
            success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
            {
                if (hoge*1 === 0) {
                    location.reload(true);
                } else {
                    alert('削除に失敗しました');
                }

            },
            error: function (XMLHttpRequest, textStatus, errorThrown) //通信失敗
            {
                var time = new Date();
                console.log("ERROR = " + time.getHours() + ":" + time.getMinutes() + ":" + time.getSeconds());
                console.log(
                        XMLHttpRequest,
                        textStatus,
                        errorThrown
                        );
                alert('通信に失敗しました');
            }
        }
        );
}
}

