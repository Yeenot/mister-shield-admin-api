@extends('layouts.customer.index')
@section('title', __('customer/titles.about'))

@section('content')
    <div class="container page-about">
        <div class="cover about">
            <h1>{{ __('customer/titles.about') }}</h1>
        </div>

        <div class="columns">
            <div class="column is-12">

                <div class="subtitle has-text-left description-title">{{ __('customer/titles.about_sanitization_service') }}</div>

                <p>
                    {!! nl2br(__('customer/labels.about')) !!}
                </p>

            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/about/index.js') }}" type="text/javascript"></script>
@endsection
