@extends('layouts.customer.index')
@section('title', __('customer/titles.sitemap'))

@section('content')
    <div class="container page-services">
        <div class="cover services-new">
            <h1>{{ __('customer/titles.sitemap') }}</h1>
        </div>

        <div class="columns">
            <div class="column is-12">

                <div class="subtitle has-text-left">{{ __('customer/titles.sitemap') }}</div>

                <ul>
                    <li>
                        <a href="{{ lroute('customer.about') }}">{{ __('customer/titles.about') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.booking') }}">{{ __('customer/titles.booking_book_our_services') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.home') }}">{{ __('customer/titles.home') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.services') }}">{{ __('customer/titles.services') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.pricing') }}">{{ __('customer/titles.pricing') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.serviced_locations') }}">{{ __('customer/titles.serviced_locations') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.verify') }}">{{ __('customer/titles.verify') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.completed_services') }}">{{ __('customer/titles.completed_services') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.faq') }}">{{ __('customer/titles.faq') }}</a>
                    </li>
                    <li>
                        <a href="{{ lroute('customer.contact') }}">{{ __('customer/titles.contact') }}</a>
                    </li>

                </ul>


            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/sitemap/index.js') }}" type="text/javascript"></script>
@endsection
