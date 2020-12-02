@extends('layouts.customer.index')
@section('title', __('customer/titles.completed_services'))

@section('content')
    <div class="container">
        <div class="cover completed-services"><h1>{{ __('customer/titles.completed_services') }}</h1></div>


        <table class="table-responsive">
            <thead>
                <tr>
                    <th>{{ strtoupper(__('customer/tables.completed_services_date_and_time')) }}</th>
                    <th>{{ strtoupper(__('customer/tables.completed_services_place_name')) }}</th>
                    <th>{{ strtoupper(__('customer/tables.completed_services_location')) }}</th>
                    <th>{{ strtoupper(__('customer/tables.completed_services_services')) }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($appointments as $appointment)
                    <tr>
                        <td data-label="{{ strtoupper(__('customer/tables.completed_services_date_and_time')) }}">{{ optional($appointment->serviced_at)->setTimezone(app('shared')->get('main')['timezone'])->format('d/m/Y H:i') }}</td>
                        <td data-label="{{ strtoupper(__('customer/tables.completed_services_place_name')) }}">
                            <a href="{{ lroute('customer.verify.results', [$appointment->place->code, localizedSlug($appointment->place->name. ' ' .$appointment->place->district->name . ' ' . $appointment->place->city->name)]) }}">
                                {{ $appointment->place->name ?? '' }}
                            </a>
                        </td>
                        <td data-label="{{ strtoupper(__('customer/tables.completed_services_location')) }}">
                            {{ implodeNotNull(', ', [
                                ($appointment->place->district->name ?? null),
                                ($appointment->place->city->name ?? null)
                            ]) }}
                        </td>
                        <td data-label="{{ strtoupper(__('customer/tables.completed_services_services')) }}">{{ implode(', ', optional($appointment->services)->pluck('public_name')->all()) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

    </div>
@endsection


@section('page_script')
    <script src="{{ url('js/customer/completed-services/index.js') }}" type="text/javascript"></script>
@endsection
