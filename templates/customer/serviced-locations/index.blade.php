@extends('layouts.customer.index')
@section('title', __('customer/titles.serviced_locations'))

@section('content')
<div class="container">
    <div class="cover location">
        <h1>{{ __('customer/titles.serviced_locations') }}</h1>
    </div>

    @foreach($cities as $city)
        <div class="subtitle">{{ $city->name }}</div>
        <div class="columns services-list">
            <div class="column is-12">
                <ul class="locations-list">
                    @foreach($city->districts as $district)
                    <li>
                        <a href="{{ lroute('customer.serviced_locations.show', [$district->id, localizedSlug($city->name), localizedSlug($district->name)]) }}">
                            {{ $district->name }} ({{ $district->serviced_public_listing_places->count() }})
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
    @endforeach
</div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/serviced-locations/index.js') }}" type="text/javascript"></script>
@endsection

