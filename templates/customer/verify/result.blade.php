@extends('layouts.customer.index')
@section('title', __('customer/titles.verification_result').' '.$place->name . ', ' . ($place->district ? ($place->district->name .', ') : '') . ($place->city ? ($place->city->name .' ') : ''))

@section('content')
    <collection
        variables='<?php echo json_encode([
            "place" => $place
        ], JSON_HEX_APOS); ?>'>
    </collection>
    <div class="container">

            <div class="cover verify-result">
            <h1>{{ $place->name }}</h1>
        </div>

        <div class="columns results-txt-holder">
            <div class="column is-3">
                <div class="results-txt big">{{__('customer/labels.verify_result_code')}}:</div>
                <div class="results-txt small">{{ $place->code }}</div>
            </div>
            <div class="column is-3">
                <div class="results-txt big">{{__('customer/labels.verify_result_address')}}:</div>
                <div class="results-txt small no-marg">
                    {{ $place->address ? ($place->address->line_1 .' ') : '' }}
                    {{ $place->address && filled($place->address->line_2) ? ($place->address->line_2 .' ') : '' }}
                    {{ $place->district ? ($place->district->name .' ') : '' }}
                    {{ $place->city ? ($place->city->name .' ') : '' }}
                </div>
            </div>
            <div class="column is-3 ">
                <div class="results-txt big">{{__('customer/labels.verify_result_property_type')}}:</div>
                <div class="results-txt small no-marg">
                    {{ ucfirst($place->type) }} <br />
                    {{ ucfirst(optional($place->category)->name) }}
                </div>
            </div>
            <div class="column is-3 ">
                <div class="results-txt big">{{__('customer/labels.verify_result_last_service_date')}}:</div>
                <div class="results-txt small">{{ optional($place->last_serviced_at)->format('d/m/Y') }}</div>
            </div>

        </div>
        <div class="columns"><div class="subtitle no-marg">{{__('customer/labels.verify_result_service_history')}}</div></div>

        <table class="verification-table table-responsive">
            <thead>
            <tr>
                <th>{{ strtoupper(__('customer/tables.verify_place_datetime')) }}</th>
                <th>{{ strtoupper(__('customer/tables.verify_place_service')) }}</th>
            </tr>
            </thead>
            <tbody >
            <tr v-for="appointment in appointments" v-cloak>
                <td>@{{ $helper.formatDate(appointment.serviced_at, 'DD/MM/YYYY HH:mm') }}</td>
                <td>
                    <template v-for="(service, index) in appointment.services">
                        @{{ service.public_name }}
                        <template v-if="index < appointment.services.length - 1"><br/></template>
                    </template>
                </td>
            </tr>

            </tbody>
        </table>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/verify/results.js') }}" type="text/javascript"></script>
@endsection

