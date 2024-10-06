<div class="w-full p-5 mb-5 ts-gray-2 rounded-lg transition-all rescron-card hidden" id="deposit">
    <h3 class="capitalize  font-extrabold "><span class="border-b-2">Deposit Setting</span>
    </h3>




    <div class="w-full">
        <div class="grid grid-cols-1 gap-3 mt-5">


            <form action="{{ route('admin.settings.deposit') }}" method="POST" class="mt-5 gen-form" data-action="none"
                enctype="multipart/form-data">
                @csrf

                <div class="grid grid-cols-1 gap-5">
                    <p class="text-orange-500 text-xs">*NP = Now Payment</p>
                    <div class="relative">
                        <input type="text" name="np_api_key" placeholder="NP API KEY" id="np_api_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_API_KEY')) }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP API KEY</label>
                        <span class="text-xs text-red-500">
                            @error('np_api_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="text" name="np_secret_key" placeholder="NP SECRET KEY" id="np_secret_key"
                            class="theme1-text-input pl-3" required value="{{ demoMask(env('NP_SECRET_KEY')) }}">
                        <label for="name" class="placeholder-label text-gray-300 ts-gray-2 px-2">NP SECRET
                            KEY</label>
                        <span class="text-xs text-red-500">
                            @error('np_secret_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <p class="text-orange-500 text-xs">*CP = Coinpayment</p>
                    <div class="relative">
                        <input type="text" name="cp_public_key" placeholder="CP Public Key" id="cp_public_key"
                            class="theme1-text-input pl-3" required
                            value="{{ demoMask(env('COINPAYMENT_PUBLIC_KEY')) }}">
                        <label for="cp_public_key" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Public
                            Key</label>
                        <span class="text-xs text-red-500">
                            @error('cp_public_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="relative">
                        <input type="text" name="cp_private_key" placeholder="CP Private Key" id="cp_private_key"
                            class="theme1-text-input pl-3" required
                            value="{{ demoMask(env('COINPAYMENT_PRIVATE_KEY')) }}">
                        <label for="cp_private_key" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Private
                            Key</label>
                        <span class="text-xs text-red-500">
                            @error('cp_private_key')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>


                    <div class="relative">
                        <input type="text" name="cp_merchant_id" placeholder="CP Merchant ID" id="cp_merchant_id"
                            class="theme1-text-input pl-3" required
                            value="{{ demoMask(env('COINPAYMENT_MARCHANT_ID')) }}">
                        <label for="cp_merchant_id" class="placeholder-label text-gray-300 ts-gray-2 px-2">CP Merchant
                            ID</label>
                        <span class="text-xs text-red-500">
                            @error('cp_merchant_id')
                                {{ $message }}
                            @enderror
                        </span>
                    </div>

                    <div class="w-full md:w-1/2">
                        <div class="relative">


                            <select name="payment_processor" id="payment_processor" class="theme1-text-input pl-3"
                                required>
                                <option value="coinpayment" @if (site('payment_processor') == 'coinpayment') selected @endif>
                                    Coinpayment </option>
                                <option value="nowpayment" @if (site('payment_processor') == 'nowpayment') selected @endif> NowPayment
                                </option>
                                <option disabled> More Coming Soon...</option>
                            </select>
                            <label for="payment_processor"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">Payment Processor</label>
                        </div>
                    </div>


                    <div class="relative grid grid-cols-1 lg:grid-cols-3 gap-5">

                        <div class="relative">
                            <input type="number" step="any" name="min_deposit" placeholder="Min Deposit"
                                id="min_deposit" class="theme1-text-input pl-3" required
                                value="{{ site('min_deposit') }}">
                            <label for="min_deposit" class="placeholder-label text-gray-300 ts-gray-2 px-2">Min Deposit
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('min_deposit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="max_deposit" placeholder="Max Deposit"
                                id="max_deposit" class="theme1-text-input pl-3" required
                                value="{{ site('max_deposit') }}">
                            <label for="max_deposit" class="placeholder-label text-gray-300 ts-gray-2 px-2">Max Deposit
                                ({{ site('currency') }})</label>
                            <span class="text-xs text-red-500">
                                @error('max_deposit')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                        <div class="relative">
                            <input type="number" step="any" name="deposit_fee" placeholder="Deposit Fee"
                                id="deposit_fee" class="theme1-text-input pl-3" required
                                value="{{ site('deposit_fee') }}">
                            <label for="deposit_fee" class="placeholder-label text-gray-300 ts-gray-2 px-2">Deposit
                                Fee
                                (%)</label>
                            <span class="text-xs text-red-500">
                                @error('deposit_fee')
                                    {{ $message }}
                                @enderror
                            </span>
                        </div>

                    </div>
                    <div class="mt-5">
                        <div class="relative">
                            <input type="text" name="wallet_ada" placeholder="ADA Wallet" id="wallet_ada"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_ADA')) }}">
                            <label for="wallet_ada" class="placeholder-label text-gray-300 ts-gray-2 px-2">ADA
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_bch" placeholder="BCH Wallet" id="wallet_bch"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_BCH')) }}">
                            <label for="wallet_bch" class="placeholder-label text-gray-300 ts-gray-2 px-2">BCH
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_bnbbsc" placeholder="BNBBSC Wallet"
                                id="wallet_bnbbsc" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_BNBBSC')) }}">
                            <label for="wallet_bnbbsc" class="placeholder-label text-gray-300 ts-gray-2 px-2">BNBBSC
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_bnbmainnet" placeholder="BNBMAINNET Wallet"
                                id="wallet_bnbmainnet" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_BNBMAINNET')) }}">
                            <label for="wallet_bnbmainnet"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">BNBMAINNET Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_btc" placeholder="BTC Wallet" id="wallet_btc"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_BTC')) }}">
                            <label for="wallet_btc" class="placeholder-label text-gray-300 ts-gray-2 px-2">BTC
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_busd" placeholder="BUSD Wallet" id="wallet_busd"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_BUSD')) }}">
                            <label for="wallet_busd" class="placeholder-label text-gray-300 ts-gray-2 px-2">BUSD
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_busdbsc" placeholder="BUSDBSC Wallet"
                                id="wallet_busdbsc" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_BUSDBSC')) }}">
                            <label for="wallet_busdbsc" class="placeholder-label text-gray-300 ts-gray-2 px-2">BUSDBSC
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_doge" placeholder="DOGE Wallet" id="wallet_doge"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_DOGE')) }}">
                            <label for="wallet_doge" class="placeholder-label text-gray-300 ts-gray-2 px-2">DOGE
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_dot" placeholder="DOT Wallet" id="wallet_dot"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_DOT')) }}">
                            <label for="wallet_dot" class="placeholder-label text-gray-300 ts-gray-2 px-2">DOT
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_eth" placeholder="ETH Wallet" id="wallet_eth"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_ETH')) }}">
                            <label for="wallet_eth" class="placeholder-label text-gray-300 ts-gray-2 px-2">ETH
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_ltc" placeholder="LTC Wallet" id="wallet_ltc"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_LTC')) }}">
                            <label for="wallet_ltc" class="placeholder-label text-gray-300 ts-gray-2 px-2">LTC
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_luna" placeholder="LUNA Wallet" id="wallet_luna"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_LUNA')) }}">
                            <label for="wallet_luna" class="placeholder-label text-gray-300 ts-gray-2 px-2">LUNA
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_shib" placeholder="SHIB Wallet" id="wallet_shib"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_SHIB')) }}">
                            <label for="wallet_shib" class="placeholder-label text-gray-300 ts-gray-2 px-2">SHIB
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_sol" placeholder="SOL Wallet" id="wallet_sol"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_SOL')) }}">
                            <label for="wallet_sol" class="placeholder-label text-gray-300 ts-gray-2 px-2">SOL
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_usdttrc20" placeholder="USDTTRC20 Wallet"
                                id="wallet_usdttrc20" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_USDTTRC20')) }}">
                            <label for="wallet_usdttrc20"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">USDTTRC20 Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_usdtbsc" placeholder="USDTBSC Wallet"
                                id="wallet_usdtbsc" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_USDTBSC')) }}">
                            <label for="wallet_usdtbsc" class="placeholder-label text-gray-300 ts-gray-2 px-2">USDTBSC
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_usdterc20" placeholder="USDTERC20 Wallet"
                                id="wallet_usdterc20" class="theme1-text-input pl-3" required
                                value="{{ demoMask(env('WALLET_USDTERC20')) }}">
                            <label for="wallet_usdterc20"
                                class="placeholder-label text-gray-300 ts-gray-2 px-2">USDTERC20 Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_xlm" placeholder="XLM Wallet" id="wallet_xlm"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_XLM')) }}">
                            <label for="wallet_xlm" class="placeholder-label text-gray-300 ts-gray-2 px-2">XLM
                                Wallet</label>

                        </div>
                        <div class="relative mt-5">
                            <input type="text" name="wallet_xrp" placeholder="XRP Wallet" id="wallet_xrp"
                                class="theme1-text-input pl-3" required value="{{ demoMask(env('WALLET_XRP')) }}">
                            <label for="wallet_xrp" class="placeholder-label text-gray-300 ts-gray-2 px-2">XRP
                                Wallet</label>

                        </div>
                    </div>
                    <div class="mt-5">

                        <div class="flex justify-end mb-5">
                            <div class="grid grid-cols-1 mb-2 mt-5 w-60">
                                <div class="relative">

                                    <span class="theme1-input-icon material-icons">
                                        search
                                    </span>
                                    <input type="text" placeholder="Search Coins" id="deposit-coin-search-input"
                                        class="theme1-text-input">
                                    <label for="deposit-coin-search-input"
                                        class="placeholder-label text-gray-300 ts-gray-2 px-2">Search Coins
                                    </label>

                                </div>
                            </div>
                        </div>

                        <div class="w-full grid grid-cols-1 md:grid-cols-2 gap-3 mb-5 h-72 overflow-y-scroll overflow-x-hidden px-3 py-10"
                            id="deposit-coins">

                            @foreach ($deposit_coins as $coin)
                                <div data-target="{{ 'deposit_' . $coin->code }}"
                                    class="ts-gray-3  rounded-lg border border-slate-800 hover:border-slate-600 cursor-pointer deposit-coin"
                                    data-label="{{ 'deposit_coin_label' . $coin->id }}">
                                    <div class="relative deposit_coin_select @if ($coin->status == 0) hidden @endif"
                                        id="{{ 'deposit_' . $coin->code }}">
                                        <div
                                            class="absolute flex justify-center items-center -top-1 -right-1 h-6 w-6 rounded-full bg-purple-500 text-white">
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-4 h-4"
                                                fill="currentColor" class="bi bi-check2-circle" viewBox="0 0 16 16">
                                                <path
                                                    d="M2.5 8a5.5 5.5 0 0 1 8.25-4.764.5.5 0 0 0 .5-.866A6.5 6.5 0 1 0 14.5 8a.5.5 0 0 0-1 0 5.5 5.5 0 1 1-11 0z" />
                                                <path
                                                    d="M15.354 3.354a.5.5 0 0 0-.708-.708L8 9.293 5.354 6.646a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l7-7z" />
                                            </svg>
                                        </div>
                                    </div>
                                    <div class="p-5">
                                        <div class="text-gray-500 font-mono font-semibold text-center">
                                            {{ $coin->name }}
                                        </div>
                                        <div class="px-2 flex item-center justify-between">
                                            <div class="font-extrabold flex items-center space-x-1">
                                                <img class="w-5 h-5"
                                                    src="{{ 'https://nowpayments.io' . $coin->logo_url }}"
                                                    alt="">
                                                <span>{{ $coin->code }}</span>
                                            </div>
                                            @if ($coin->network)
                                                <div>
                                                    <div
                                                        class="px-2 py-1 rounded-lg ts-gray-1 text-xs border border-slate-800 hover:border-slate-600">
                                                        {{ $coin->network }}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>

                                    </div>

                                </div>
                            @endforeach




                        </div>





                    </div>



                </div>

                <div class="text-blue-500 hidden">
                    @foreach ($deposit_coins as $coin)
                        <div>
                            <input type="checkbox" value="{{ $coin->id }}" name="deposit_coins[]"
                                id="{{ 'deposit_check_' . $coin->code }}"
                                @if ($coin->status == 1) checked @endif>
                            <label for="{{ 'deposit_check_' . $coin->code }}"
                                id="{{ 'deposit_coin_label' . $coin->id }}">{{ $coin->code }}</label>
                        </div>
                    @endforeach
                </div>








                <div class="w-full grid grid-cols-1 gap-5 mt-10 mb-10">
                    <button type="submit" class="bg-purple-500 px-2 py-1 rounded-full transition-all">Save
                        Changes </button>
                </div>

            </form>

        </div>


    </div>

</div>


@push('scripts')
    <script>
        // select the deposit coin
        $(document).on('click', ".deposit-coin", function(e) {
            var target = '#' + $(this).data('target');
            $(target).toggleClass('hidden');
            var label = '#' + $(this).data('label');
            $(label).click();

        });


        // filter the coins
        $(document).on('input keyup', '#deposit-coin-search-input', function() {
            var searchText = $(this).val().toLowerCase();

            $('.deposit-coin').hide().filter(function() {
                return $(this).text().toLowerCase().includes(searchText);
            }).show();
        });
    </script>
@endpush