@extends('layouts.customer.index')
@section('title', __('customer/titles.booking_book_our_services'))


@section('content')
    <div class="container">
        <div class="cover booking"><h1> {{ strtoupper( __('customer/titles.booking_book_our_services') ) }}</h1></div>

        <div class="notification is-danger" v-cloak v-if="errors">
            <ul>
                <li v-for="error in errors">
                    @{{ error }}
                </li>
            </ul>
        </div>

        <div class="notification is-success" v-cloak v-if="success">
            @{{ success }}
        </div>



        <div class="columns bookings-contact">
            <div class="column is-3">
                <button class="button-regular is-fullwidth">
                    <a href="https://line.me/R/ti/p/%40{{ $main['company']->line ?? '' }}" target="_blank">
                        <img src="{{ url('assets/public/img/network-white.svg') }}" alt="phone"/> {{ strtoupper(__('customer/buttons.booking_book_via_line')) }}
                    </a>
                </button>
            </div>
            <div class="column is-3">
                <button class="button-regular is-fullwidth">
                    <a href="https://wa.me/{{ isset($main['company']->whatsapp) ? getOnlyNumbers($main['company']->whatsapp) : '' }}" target="_blank">
                        <img src="{{ url('assets/public/img/whatsapp.svg') }}" alt="phone"/> {{ strtoupper(__('customer/buttons.booking_book_via_whatsapp')) }}
                    </a>
                </button>
            </div>
            <div class="column is-3">
                <button class="button-regular is-fullwidth">
                    <a href="https://m.me/{{ $main['company']->facebook_username ?? '' }}" target="_blank">
                        <img src="{{ url('assets/public/img/messenger.svg') }}" alt="phone"/> {{ strtoupper(__('customer/buttons.booking_book_via_messenger')) }}
                    </a>
                </button>
            </div>
            <div class="column is-3">
                <button class="button-regular is-fullwidth">
                    <a href="tel:{{ $main['company']->customer_service_phone ?? '' }}">
                        <img src="{{ url('assets/public/img/phone-white.svg') }}" alt="phone"/> {{ strtoupper(__('customer/buttons.booking_call')) }} {{ $main['company']->customer_service_phone ?? '' }}
                    </a>
                </button>
            </div>
        </div>

        <div class="has-text-centered columns">
            <h3 class="no-marg">{{ __('customer/titles.booking_or_fill_the_form_below') }}</h3>
        </div>

        @include('customer.bookings.partials.form')

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/bookings/index.js') }}" type="text/javascript"></script>
@endsection


