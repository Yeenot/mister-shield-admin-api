@extends('layouts.customer.index')
@section('title', __('customer/titles.pricing'))

@section('content')
    <div class="container">
        <div class="cover pricing"><h1>{{ strtoupper(__('customer/titles.pricing')) }}</h1></div>
        <table class="pricing-table table-responsive">
            <thead>
            <tr>
                <th>{{ strtoupper(__('customer/tables.pricing_services')) }}</th>
                <th>{{ strtoupper(__('customer/tables.pricing_property_type')) }}</th>
                <th>{{ strtoupper(__('customer/tables.pricing_price')) }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($services as $service)
            <tr>
                <td>{{ $service->name }}</td>
                <td>{{ __('customer/forms.pricing_type_of_property_' . $service->type) }}</td>
                <td>
                    @if(!$service->price)
                        <a href="{{ lroute('customer.contact') }}">{{ strtoupper(__('customer/tables.pricing_contact_us')) }}</a>
                    @elseif(!$service->discounted_price)
                        {{ optional($main['country']->currency)->symbol . ' '.  currencyFormatDecimal(decimal($service->price)) }}
                    @else
                        {{ optional($main['country']->currency)->symbol . ' '.  currencyFormatDecimal(decimal($service->discounted_price)) }}
                        <span style="text-decoration: line-through;">
                             {{ currencyFormatDecimal(decimal($service->price)) }}
                        </span>
                    @endif
                </td>
            </tr>
            @endforeach

            </tbody>
        </table>

        <div class="has-text-centered col-space-bottom"><button onclick="location.href = '{{ lroute('customer.booking') }}'" class="button-regular">{{ strtoupper( __('customer/titles.booking_book_our_services') ) }}</button></div>
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/pricing/index.js') }}" type="text/javascript"></script>
@endsection


