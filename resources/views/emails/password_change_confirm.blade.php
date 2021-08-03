@component('mail::message')
# Hellp!

You are receiving this email because we found a password have been changed for your account.

If you did not change your password, then you can reset your password agian below.


@component('mail::button', ['url' => route('password.request')])
Reset Password
@endcomponent

This password reset link will expire in 60 minutes. 

Thanks,<br>
{{ config('app.name') }}
@endcomponent