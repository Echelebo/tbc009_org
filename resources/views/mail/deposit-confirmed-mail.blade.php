<x-mail::message>
    # Deposit Confirmed

    Hi {{ $deposit->user->name }},
    @if ($deposit->type == 1)
        Your top up deposit request of {{ formatAmount($deposit->amount) }} has been confirmed. Login into your
        account to confirm.
    @else
        Your swap plan deposit request of {{ formatAmount($deposit->amount) }} has been confirmed. Login into your
        account to confirm.
    @endif

    Thanks,<br>
    {{ site('name') }}
</x-mail::message>
