@extends('layouts.customer.index')
@section('title', __('customer/titles.privacy_policy'))

@section('content')
    <div class="container page-about">
        <div class="cover about">
            <h1>{{ __('customer/titles.privacy_policy') }}</h1>
        </div>

        <div class="columns">
            <div class="column is-12">

                <p>
                    {!! $main['country']->privacy_policy !!}
                </p>

            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/privacy-policy/index.js') }}" type="text/javascript"></script>
@endsection
