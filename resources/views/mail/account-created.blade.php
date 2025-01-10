<x-mail::message>
# Account Created Successfully

Hi {{ $name }}!
Your account has been created successfully. Please use the link below to sign in. Here are your credentials:

**Username:** {{ $username }}  
**Password:** {{ $password }}

<x-mail::button :url="$signInLink">
Sign In
</x-mail::button>

Thank you,  
{{ config('app.name') }}
</x-mail::message>
