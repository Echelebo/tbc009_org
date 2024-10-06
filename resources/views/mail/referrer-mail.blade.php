<x-mail::message>
    # New Referral Notification

    Hi {{ $ref->name }}

    {{ $user->name ?? 'A new user' }} has signed up to {{ site('name') }} using your referral link.

    Thanks,<br>
    {{ site('name') }}
</x-mail::message>
