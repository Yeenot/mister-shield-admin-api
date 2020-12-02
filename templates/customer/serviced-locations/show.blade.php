@extends('layouts.customer.index')
@section('title', __('customer/titles.serviced_locations_browser_title')." {$district->name}, {$district->city->name}")

@section('content')
    <collection
        variables='<?php echo json_encode([
            "district" => $district
        ], JSON_HEX_APOS); ?>'>
    </collection>
    <div class="container">
        <div class="cover serviced-location">
            <h1>{{ __('customer/titles.serviced_locations_heading')." {$district->name}, {$district->city->name}" }}
            </h1>
        </div>
        <table class="table-responsive">
            <thead>
            <tr>
                <th>{{ strtoupper(__('customer/tables.serviced_locations_place_name')) }}</th>
                <th>{{ strtoupper(__('customer/tables.serviced_locations_type')) }}</th>
                <th>{{ strtoupper(__('customer/tables.serviced_locations_last_service_datetime')) }}</th>
            </tr>
            </thead>
            <tbody>
                @foreach($places as $place)
                <tr>
                    <td>
                    <img class="table-mobile-ico" src="{{ url('assets/public/img/location-pin.svg') }}" alt="location"/>
                        <a href="{{ lroute('customer.verify.results', [$place->code, localizedSlug( "{$place->name} {$district->city->name} {$district->name}" )]) }}">
                            {{ $place->name }}
                        </a>
                    </td>
                    <td><img class="table-mobile-ico" src="{{ url('assets/public/img/corp.svg') }}" alt="company"/>{{ $place->category->name ?? '' }}</td>
                    <td><img class="table-mobile-ico" src="{{ url('assets/public/img/calendar.svg') }}" alt="calendar"/>{{ $place->last_serviced_at ? $place->last_serviced_at->setTimezone(app('shared')->get('main')['timezone'])->format('d/m/y H:i') : '' }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection


@section('page_script')
    <script src="{{ url('js/customer/serviced-locations/view.js') }}" type="text/javascript"></script>
@endsection
