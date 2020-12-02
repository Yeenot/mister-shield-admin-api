@extends('layouts.customer.index')
@section('title', 'Services')

@section('content')
    <div class="container page-services">
        <div class="cover services-new">
            <h1>{{ __('customer/titles.services') }}</h1>
        </div>

        <div class="columns">
            <div class="column is-12">

                <div class="subtitle has-text-left description-title">{{ __('customer/labels.services_weekly_monthly_sanitization') }}</div>

                <p>
                    {!! nl2br(__('customer/labels.services_weekly_monthly_sanitization_description')) !!}
                </p>

                <div class="subtitle has-text-left description-title">{{ __('customer/labels.services_full_marketing_support') }}</div>

                <p>
                    {!! nl2br(__('customer/labels.services_full_marketing_support_description')) !!}
                </p>
            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/services/index.js') }}" type="text/javascript"></script>
@endsection
