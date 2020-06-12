@component('mail::message')
# Thank you for the provisional registration.

Thank you for using "{{ config('app.name') }}"
Provisional registration has been completed.
To complete your registration, please click the "Proceed to Registration" button below.

@component('mail::button', ['url' => $url])
Proceed to Registration
@endcomponent

@endcomponent
