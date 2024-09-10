@component('mail::message')
    Click the button below to log in:

    @component('mail::button', ['url' => $url])
        Login Now
    @endcomponent

    This link will expire in {{ config('laravel-extended-auth.magic_link_expiry') }} minutes.

    Thanks,<br>
    {{ config('app.name') }}
@endcomponent
