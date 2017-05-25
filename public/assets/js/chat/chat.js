$(function ()
{
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(token);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
    checkupdate();

    $('.edit').submit(function(e){
        e.preventDefault();
        $prevComment = $(this).children('input[name=editComment]').val();
        $comment = window.prompt("変更しない時はキャンセルを押してください");
    });
    $('#add').submit(function (e)
    {
        e.preventDefault();
        if ($('#tweet').val() === '') //投稿欄空欄だったら
        {
            alert('何か入力してください！');
            return false;
        }
        $.ajax({
            type: "POST", //POSTで渡す
            url: "/chat/add", //POST先
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
                console.log("END:SUCCESS");
                $('#tweet').val('');
                var tweets = JSON.parse(hoge);
                console.log(tweets);
                var name = tweets.name;
                var time = tweets.time;
                var comment = tweets.comment;
                var message = "<div class=\" col-lg-10 \">" +
                        "    <p class=\"\"><span class=\"label \">" + name + "さん</span></p>" +
                        "    <div class=\"panel panel-default\" style=\"margin-bottom: 5px; padding: 0;\">" +
                        "        <div class=\"panel-body  \" style=\"padding: 5px 10px\">" +
                        "            <p>" + comment + "</p>" +
                        "            <small class=\"text-muted\">" + time + "</small>" +
                        "        </div>" +
                        "    </div>" +
                        "</div>";
                setPost(message);
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
    $.ajax({
        type: "POST", //POSTで渡す
        url: "/chat/recieve", //POST先
        data: {
            "updateUserId": $('#updateUserId').val(), //ユーザーID
            "updateThreadId": $('#updateThreadId').val(), //板ID
            "updateCount": $('#updateCount').val() //板ID
        },
        success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
        {
            console.log('hoge=' + hoge);
            var align = 'text-left';
            var size = '';
            var labelColor = 'label-primary';
            if (hoge * 1 === -1) {
                alert('他のユーザーのコメント取得時にエラーが起きました。ページを更新してください。');
                return;
            }
//            if (hoge * 1 >= 0) {
//                console.log('hoge >= 0');
//                checkupdate();
//            }
            if (isJson(hoge)) {
                console.log('hoge === json');
                $('#updateCount').val(JSON.parse(hoge).afterCount);
                var tweets = JSON.parse(hoge).val;
                for (i = 0; i < tweets.count; i++) {
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
//                    checkupdate();
                }
            }
            checkupdate();
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
    }
    );
}
//function jsonStrDecode(str = ''){
//    var arrs = str.match(/\\u.{4}/g);
//    var t    = "";
//    for(i = 0; i < arrs.length; i++){
//        t += String.fromCharCode(arrs[i].replace("\\u","0x"));
//    }
//    return(t);
//}
//function eraseTweet() {
//
//    if (window.confirm("この発言を削除しますか？")) {
//        return true;
//    } else {
//        return false;
//    }
//}
function tweetEdit(tweetId, comment) {
    var editComment = window.prompt("変更しない時はキャンセルを押してください", comment);
    if (!editComment) {
        $.ajax({
            type: "POST", //POSTで渡す
            url: "/tweetEdit", //POST先
            data: {
                "tweetId": tweetId, //ユーザーID
                "editComment": editComment, //編集されたコメント
            },
            success: function (hoge) //通信成功、dataaddcon.phpからの返り値を受け取る
            {
                if (hoge * 1 === 0) {
                    location.reload(true)
                } else {

                    alert('更新に失敗しました');
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
//            alert('処理できませんでした、ページを更新して下さい');
            }
        });
    }
}

function isJson(arg) {
    arg = (typeof arg === "function") ? arg() : arg;
    if (typeof arg !== "string") {
        return false;
    }
    try {
        arg = (!JSON) ? eval("(" + arg + ")") : JSON.parse(arg);
        return true;
    } catch (e) {
        return false;
    }
}
;