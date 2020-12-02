@extends('layouts.customer.index')
@section('title', __('customer/titles.verify'))

@section('content')
    <div class="container">

    <div class="cover verify">
            <h1>{{ __('customer/titles.verify') }}</h1>
        </div>


        <div class="columns services-list">
            <div class="column is-5 has-text-centered"><img src="{{ url('assets/public/img/sticker-big.png') }}" alt="Mr Shield sticker" /></div>
            <div class="column is-6">
                <form class="ferification-form" method="GET" @submit.prevent="search" action="">
                    <div class="results-txt big">
                        {{ __('customer/labels.verify_please_enter_the_verification') }}
                    </div>
                    <input type="text" v-model="code" placeholder="{{ __('customer/labels.verify_enter_the_code') }}" />
                    <button type="button" @click="search" class="button-regular">{{ __('customer/labels.verify_button_verify') }}</button>
                    <div v-if="error" v-cloak class="notification is-danger verify-error-notification">
                        {{ strtoupper(__('customer/notifications.verify_place_code_not_found')) }} <br>
                        <small>{{ __('customer/notifications.verify_if_you_believe_this_is_an_error') }}</small>

                    </div>
                    <div class="results-txt big mt-10 mb-10">
                        {{ __('customer/labels.verify_certifies_that_the_place') }}
                    </div>
                    
                </form>
            </div>
        </div>

    </div>
@endsection


@section('page_script')
    <script src="{{ url('js/customer/verify/index.js') }}" type="text/javascript"></script>
@endsection
