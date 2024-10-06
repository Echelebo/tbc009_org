@extends('layouts.fronty')

@section('contents')
    <div class="container-fluid">
        <!-- start page title -->

        <!-- end page title -->
        <div class="col-sm-12">
            <div class="card" id="pageContent">
                <h5 class="card-header bg-primary text-white">Your Referrals
                </h5>
                <div class="card-body">
                    <div class="row">
                        <p>First <a href="{{ route('user.profile.edit') }}">
                                <font color="blue">setup username</font>
                            </a> before using referral link</p>
                        <br />

                        <div class="col-md-12 mt-4"
                            data-copy="{{ route('user.register', ['ref' => user()->username ?? 'notset']) }}">
                            {{ route('user.register', ['ref' => user()->username ?? 'notset']) }}
                        </div>
                    </div>
                    <br>
                    <br>
                    <table width="300" cellspacing="1" cellpadding="1">
                        <tbody>
                            <tr>
                                <td class="item">Referral:</td>
                                <td class="item">{{ user()->referredUsers->count() }}</td>
                            </tr>
                            <tr>
                                <td class="item">Active referrals:</td>
                                <td class="item">{{ user()->referredUsers->count() }}</td>
                            </tr>
                            <tr>
                                <td class="item">Total referral commission:</td>
                                <td class="item">${{ number_format($referralsx, 2) }}</td>
                            </tr>
                        </tbody>
                    </table>

                    <div class="w-full lg:w-2/3 mt-4">
                        <div class="w-full p-5 mb-5 ts-gray-2-x rounded-lg transition-all rescron-card overflow-x-scroll"
                            style="color: #333333;">
                            <h3 class="capitalize  font-extrabold "><span class="border-b-2" style="color: #333333;">My
                                    Referral Tree</span>
                            </h3>

                            <div class="w-full mt-10">


                                @php
                                    function displayReferralTree($user, $level = 1, $maxLevels = 10)
                                    {
                                        if ($level >= $maxLevels) {
                                            return;
                                        }

                                        $referredUsers = $user->referredUsers;

                                        if ($referredUsers->count() > 0) {
                                            echo '<div class="w-full">';
                                            foreach ($referredUsers as $referredUser) {
                                                echo '<div class="border-l-4 border-l-blue-500 mt-3" style="margin-left:' .
                                                    40 * $level .
                                                    'px"> <span class="ts-gray-3-x p-3 w-44 text-dark">' .
                                                    $referredUser->name .
                                                    '</span></div>';
                                                displayReferralTree($referredUser, $level + 1, $maxLevels);
                                            }
                                            echo '</div>';
                                        }
                                    }
                                @endphp

                                <div class="w-full" style="color: #333333; background-color: #ffffff,">
                                    <div class="flex justify-start items-center">
                                        <span class="border-l-4 border-l-blue-500 ts-gray-3-x p-3">
                                            {{ user()->name }}
                                        </span>

                                    </div>

                                    @php
                                        displayReferralTree(user());
                                    @endphp
                                </div>






                            </div>

                        </div>





                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
