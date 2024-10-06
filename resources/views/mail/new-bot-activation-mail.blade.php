<x-mail::message>
    # Swap Plan Activation Successful

    Hi {{ $activation->user->name }},

    You have successfully activated the {{ $activation->bot->name }}.

    Thanks,<br>
    {{ site('name') }}
</x-mail::message>
