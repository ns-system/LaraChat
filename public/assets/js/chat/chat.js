$(function ()
{
    var token = $('meta[name="csrf-token"]').attr('content');
    console.log(token);
    $.ajaxSetup({headers: {'X-CSRF-TOKEN': token}});
    checkupdate();


    $('.edit').click(function () {
        var s = $(this).parents().find('.edit-content');
        var id = s.children('input[name=editId]').val();
        var comment = s.children('input[name=editComment]').val();
        $('.editId').val(id);
        $('.editComment').html(comment);
        console.log(id + comment);
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
//            var align = 'text-left';
//            var size = '';
//            var labelColor = 'label-primary';
            if (hoge * 1 === -1) {
                alert('他のユーザーのコメント取得時にエラーが起きました。ページを更新してください。');
                return;
            }
            if (hoge * 1 === 0) {
                console.log('hoge >= 0');
                checkupdate();
            }
            if (isJson(hoge)) {
                console.log('hoge === json');
                $('#updateCount').val(JSON.parse(hoge).afterCount);
                var tweets = JSON.parse(hoge).val;
                for (i = 0; i < tweets.length; i++) {
                    var name = tweets[i].name;
                    var time = tweets[i].time;
                    var comment = tweets[i].comment;
                    var message = "<div class=\" col-lg-10\">" +
                            "    <p class=\"text-left\"><span class=\"label label-default\">" + name + "さん</span></p>" +
                            "    <div class=\"panel panel-default\" style=\"margin-bottom: 5px; padding: 0;\">" +
                            "        <div class=\"panel-body text-left\" style=\"padding: 5px 10px\">" +
                            "            <p>" + comment + "</p>" +
                            "            <small class=\"text-muted\">" + time + "</small>" +
                            "        </div>" +
                            "    </div>" +
                            "</div>";
                    setPost(message);
                }
                tweets = [];
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