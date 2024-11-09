@php
    use App\Models\Bot;

    $page_title = 'Privacy Policy';
    $short_description =
        'Prior to availing any tbcoo9 wallet services, we kindly request that you review and acknowledge our Privacy Policy. ';

@endphp

{{-- layout --}}
@extends('layouts.frontly')





@section('contents')
    <div class="container">
        <div class="row">
            <div class="col" style="margin-bottom: 50px;">
                <h1>Privacy Policy</h1>


                <p>'The Official tbc009.org Web Site' is committed to protecting the privacy of its visitors. The policy
                    statement provides our visitors with an overview of the measures we have taken to show our commitment to
                    this policy.</p>

                <p>
                    <b>Personal Information</b>
                </p>

                <p>We collect the personal data that you volunteer on forms which you submit to us for on-line competitions
                    and in emails that you send to us. In addition we automatically gather details of browser types and IP
                    addresses of the users who visit our site. We do not release this information to any outside party,
                    except in suspected fraud cases.</p>

                <p>When fraudulent activity is suspected, we may release the users details to the party that the user has
                    been trading with. This is done only if there is strong evidence that actual trade has happened.</p>

                <p>
                    <b>Opting Out</b>
                </p>

                <p>Users who join the forum will automatically receive Newsletters. Should users later decide to opt-out
                    from receiving this information please contact us and you will be removed from our database and no
                    longer receive future communication.</p>

                <p>
                    <b>Correct/Update</b>
                </p>

                <p>You may request that we amend any personal data that we are holding about you which is factually
                    inaccurate. You can email us stating your wishes.</p>

                <p>
                    <b>Public Forums/Chat Room</b>
                </p>

                <p>This web site has a message board and chat room available to its users. Please remember that any
                    information that is disclosed in these areas become public information and you should exercise caution
                    when deciding to disclose your personal information.</p>

                <p>
                    <b>Links</b>
                </p>

                <p>This web site contains links to other sites. {{ site('name') }} is not responsible for the privacy
                    practices of
                    such other sites. This privacy statement applies solely to information collected by this web site.</p>

                <p>
                    <b>Competitions</b>
                </p>

                <p>{{ site('name') }} may occasionally run competitions with other web sites and we will ask visitors for
                    their
                    contact information. Any information that you supply will be held in the strictest confidence and will
                    only be used in conjunction with the competition. In order for visitors to take part in the competitions
                    you must be a member of the Thebillioncoin Forum.</p>

                <p>
                    <b>Data retention policy</b>
                </p>

                <p>{{ site('name') }} user data is stored three months after deleting the user account. </p>

                <p>Messages and file attachments related to the trade are stored 90 days after closing the trade. </p>

                <p>
                    <b>Contacting The Web Site</b>
                </p>

                <p>If you have any questions about this Privacy statement, the practices, or your dealing with this web
                    site, please contact us and your enquiry will be dealt with as soon as possible.</p>

                <p>----------- </p>

                <p>
                    <b>Trading</b>
                </p>

                <p>
                    <b>Buying TBC</b>
                </p>

                <p>When a user buying TBC with traditional electronic payment methods using the escrow service, the buyer is
                    required to provide correct reference message when paying. Bitcoin sellers are not required to release
                    TBC paid with an incorrect reference. This is to prevent fraud.</p>

                <p>tbcians should be ready to prove his/her identity, when Recovering TBC online and the payment method is
                    reversible.</p>

                <p>
                    <b>Accounts</b>
                </p>

                <p>A user can only act on his own behalf. No {{ site('name') }} account can be used to act as an
                    intermediary or
                    broker. A user can only use his own trading accounts to trade at {{ site('name') }}. A user account
                    must not
                    contain misleading information about the user, including, but not limited to having non-personal phone
                    number or faking the country of origin. A user is not allowed to share his or hers account access with
                    any other person or entity without prior approval from {{ site('name') }} administrator. Sharing
                    account
                    access with any 3rd party might result your Thebillioncoin account(s) to be terminated.</p>

                <p>
                    <b>Communication</b>
                </p>

                <p>Hate-speech and abusive language is strictly forbidden on {{ site('name') }}. Any user account that
                    engages in
                    abusive language or hate-speech can be banned.</p>





            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
