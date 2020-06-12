@component('mail::message')
# メールアドレス変更リクエスト

メールアドレスの変更を完了するには、以下のボタンを押下してください。

@component('mail::button', ['url' => $url])
メールアドレス変更を承認する
@endcomponent

※ こちらのメールは自動で送信しております。
  返信は出来ませんのでご注意ください。

@endcomponent
