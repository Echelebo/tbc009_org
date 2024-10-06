@extends('layouts.fronty')

@section('contents')
    <div class="container-fluid" id="pageContent">




        <div class="col-sm-12">

            <!--<input type="hidden" name="currency_code" id="currency_code" value="USDTTRC20">-->

            <div class="col-sm-12">
                <div class="card">
                    <h5 class="card-header bg-primary text-white">Withdraw</h5>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table">
                                <tbody>
                                    <tr>
                                        <td>Account Balance:</td>
                                        <td><b>{{ formatAmount(user()->exch_balance) }}</b></td>
                                    </tr>
                                    <tr>
                                        <td>Pending Withdrawals: </td>
                                        <td><b>{{ formatAmount($pending_withdrawals) }}</b></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <form action="{{ route('user.withdrawals.new') }}" method="post" id="tbctransferForm">
                @csrf
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <th></th>
                                            <th scope="col">Wallet</th>
                                            <th scope="col">Address</th>
                                        </tr>
                                        @foreach ($coins as $coin)
                                            <tr>

                                                <td><input type="radio" name="currency_code" id="currency_code"
                                                        value="{{ $coin->code }}" required></td>
                                                <td>{{ $coin->code }}</td>
                                                @if ($coin->id == 219)
                                                    @if (is_null(user()->usdtbsc_wallet))
                                                        <td><a class="badge badge-danger"
                                                                href="{{ route('user.profile.edit') }}"><i>set
                                                                    wallet</i></a></td>
                                                    @else
                                                        <td>{{ user()->usdtbsc_wallet }}</td>
                                                    @endif
                                                @elseif ($coin->id == 221)
                                                    @if (is_null(user()->usdterc_wallet))
                                                        <td><a class="badge badge-danger"
                                                                href="{{ route('user.profile.edit') }}"><i>set
                                                                    wallet</i></a></td>
                                                    @else
                                                        <td>{{ user()->usdterc_wallet }}</td>
                                                    @endif
                                                @elseif ($coin->id == 224)
                                                    @if (is_null(user()->usdt_wallet))
                                                        <td><a class="badge badge-danger"
                                                                href="{{ route('user.profile.edit') }}"><i>set
                                                                    wallet</i></a></td>
                                                    @else
                                                        <td>{{ user()->usdt_wallet }}</td>
                                                    @endif
                                                @endif

                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table">
                                    <tbody>
                                        <tr>
                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <tr>
                                            <td>Withdrawal amount($):</td>
                                            <td><input type="text" name="amount" id="amount" value=""
                                                    class="form-control" size="15" placeholder="Amount" required></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <textarea name="comment" class="form-control" cols="45" rows="4">Your comment</textarea>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td><input type="submit" value="Request"
                                                    class="btn bg-blue-500 btn-primary ml-auto"></td>
                                        </tr>
                                    </tbody>
                                </table>



                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    @endsection

    @section('scripts')
        <script>
            $(document).on('submit', '#tbctransferForm', function(e) {
                e.preventDefault();
                var amount = $('#amount').val() * 1;
                var currency_code = $('#currency_code').val();


                //check the currency code
                var error = null;
                //check min and max transfer

                if (error === null) {
                    var form = $(this);
                    var formData = new FormData(this);

                    var submitButton = $(this).find('input[type="submit"]');
                    submitButton.addClass('relative disabled');
                    submitButton.append('<span class="button-spinner"></span>');
                    submitButton.prop('disabled', true);

                    $.ajax({
                        url: form.attr('action'),
                        method: 'POST',
                        data: formData,
                        dataType: 'json',
                        contentType: false,
                        processData: false,
                        success: function(response) {

                            window.location.href = "/user/withdrawals";


                            loadPage(form.attr('action'), submitButton, '#pageContent');

                            $('html, body').animate({
                                scrollTop: 0 + 100
                            }, 800);
                            toastNotify('success', response.message);




                        },
                        error: function(xhr, status, error) {
                            var errors = xhr.responseJSON.errors;

                            if (errors) {
                                $.each(errors, function(field, messages) {
                                    var fieldErrors = '';
                                    $.each(messages, function(index, message) {
                                        fieldErrors += message + '<br>';
                                    });
                                    toastNotify('error', fieldErrors);
                                });
                            } else {
                                toastNotify('error', 'An Error occured, try again later');
                            }


                        },
                        complete: function() {
                            submitButton.removeClass('disabled');
                            submitButton.find('.button-spinner').remove();
                            submitButton.prop('disabled', false);

                        }
                    });
                } else {

                    toastNotify('error', error);

                }

            });
        </script>
    @endsection
