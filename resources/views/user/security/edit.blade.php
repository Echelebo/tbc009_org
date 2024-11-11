@extends('layouts.user')

@section('contents')
    <div class="container-fluid">

        <!-- start page title -->

        <!-- end page title -->
        <div class="col-sm-12">

            <div class="card">
                <h5 class="card-header bg-primary text-white">Security</h5>
                <div class="card-body" id="pageContent">

                    <div class="w-full lg:w-2/3">


                        <div class="w-full p-5 mb-5 ts-gray-2-x rounded-lg rescron-card transition-all" id="security">
                            <h3 class="capitalize  font-extrabold "><span class="border-b-2" style="color: ##555965;">Update
                                    Password</span>
                            </h3>
                            <form action="{{ route('user.profile.password') }}" class="mt-5 gen-form" id="tbctransferForm">
                                @csrf

                                <div class="w-full grid grid-cols-1  gap-5 mb-3">
                                    <div class="grid grid-cols-1 mb-2">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                lock
                                            </span>
                                            <input type="password" name="current_password" placeholder="Current Password"
                                                id="current_password" class="theme1-text-input" required>
                                            <label for="current_password"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Current Password
                                                <span class="text-red-500">*</span></label>
                                            <span class="text-xs text-red-500">
                                                @error('current_password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 mb-2">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                lock
                                            </span>
                                            <input type="password" name="password" placeholder="New Password" id="password"
                                                class="theme1-text-input" required>
                                            <label for="password" class="placeholder-label text-gray-300 ts-gray-2 px-2">New
                                                Password <span class="text-red-500">*</span></label>
                                            <span class="text-xs text-red-500">
                                                @error('password')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>

                                    <div class="grid grid-cols-1 mb-2">
                                        <div class="relative">

                                            <span class="theme1-input-icon material-icons">
                                                lock
                                            </span>
                                            <input type="password" name="password_confirmation"
                                                placeholder="Confirm Password" id="password_confirmation"
                                                class="theme1-text-input" required>
                                            <label for="password_confirmation"
                                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Confirm Password
                                                <span class="text-red-500">*</span></label>
                                            <span class="text-xs text-red-500">
                                                @error('password_confirmation')
                                                    {{ $message }}
                                                @enderror
                                            </span>
                                        </div>
                                    </div>


                                </div>


                                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                                    <button type="submit"
                                        class="bg-blue-500 px-2 py-1 text-white hover:scale-110 transition-all">Save
                                        Changes </button>
                                </div>

                            </form>





                        </div>



                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('scripts')
    @if (user()->g2fa == 0)
        <script>
            $(document).ready(function() {
                // create qrcode
                var qrCodeElement = document.getElementById('wallet_qrcode');
                var text = "{{ $qr_code_url }}";
                var qrCode = new QRCode(qrCodeElement, {
                    text: text,
                    width: 128,
                    height: 128
                });

                var walletQrCodeDiv = document.getElementById('wallet_qrcode');
                walletQrCodeDiv.classList.add('disabled');
                var imageElement = walletQrCodeDiv.querySelector('img');
                imageElement.classList.add('rounded-lg', 'border', 'border-slate-800',
                    'hover:border-slate-600', 'cursor-pointer', 'p-1');
            });
        </script>
    @endif

    <script>
        $(document).on('submit', '#tbctransferForm', function(e) {
            e.preventDefault();
            var current_password = $('#amount').val() * 1;
            var passwords = $('#currency_code').val() * 1;
            var password_confirmation = "{{ site('currency') }}" * 1;

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

                        window.location.href = "/user/security/edit";


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
