ようこそ、{{ $user['name'] }}さん！
ユーザーの仮登録が完了しました。

以下のリンクをクリックしてユーザーをアクティベートしてください。
{{ url('auth/register/confirm', [$token]) }}