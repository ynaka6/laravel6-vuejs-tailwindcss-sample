@component('mail::message')
# {{ __('emails.auth.reset_password.title') }}

いつも{{ config('app.name') }}をご利用頂きありがとうございます。
パスワードを変更するには以下の「{{ __('emails.auth.reset_password.accept_button') }}」ボタンをクリックして下さい。

@component('mail::button', ['url' => route('password.reset', [
    'email' => $email,
    'token' => $token
])])
{{ __('emails.auth.reset_password.accept_button') }}
@endcomponent

@endcomponent
