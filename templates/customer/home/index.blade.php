@extends('layouts.customer.index')
@section('title', 'Dashboard')

@section('content')
<div class="cover home">
        </div>
    <div class="container">





        <div class="columns no-marg">

            <div class="column is-6 has-text-centered">

                <div class="home-subtitle">{{ __('customer/labels.home_watch_out_shield') }}</div>

                <img class="home-shield" src="{{ url('assets/public/img/sticker-big.png') }}" alt="Sanitized" />

            </div>

            <div class="column is-6">

                <div class="home-subtitle text-center">{{ __('customer/labels.home_last_places_sanitized') }}</div>


                <table class="sanitazed-places-table">

                    @foreach($appointments as $appointment)
                    <tr>

                        <td>
                            <a href="{{ lroute('customer.verify.results', [
                                $appointment->place->code,  localizedSlug($appointment->place->name . ' ' . $appointment->place->district->name . ' ' . $appointment->place->city->name) ]) }}">
                            {{ $appointment->place->name ?? '' }}
                            </a>
                        </td>

                        <td>{{ optional($appointment->serviced_at)->setTimezone(app('shared')->get('main')['timezone'])->format('d/m/Y H:i') }}</td>

                    </tr>
                    @endforeach
                </table>

               <div class="has-text-centered"> <a class="view-all-btn" href="{{ lroute('customer.completed_services') }}">
                    {{ __('customer/buttons.home_view_all') }}</a> </div>

            </div>


        </div>

        <div class="columns no-marg">
        <div class="column is-12 has-text-centered">
            <button class="button-big" onclick="location.href = '{{ lroute('customer.verify') }}'">
                {{ __('customer/navigations.verify_place') }}
            </button>
        </div>
        </div>


        <div class=" gray-line"></div>


        <div class="columns no-marg">

            <div class="column is-12 has-text-centered">


                <div class="home-big-txt">

                    {!! __('customer/labels.home_get_the_mister_shield_sticker') !!}

                </div>

                <button class="button-big" onclick="location.href = '{{ lroute('customer.booking') }}'" >{{ __('customer/buttons.home_book_our_services') }}</button>

                <div class="home-small-txt">

                    {{ __('customer/labels.home_prices_start_from') }}


                </div>
                <a class="pricelist" href="{{ lroute('customer.pricing') }}">{{ __('customer/labels.home_check_our_services_pricelist') }}</a>


            </div>

        </div>

        <div class=" gray-line"></div>

        <div class="home-lab-txt">{{ __('customer/labels.certification_and_labs') }}</div>

        <div class="columns no-marg">
            <div class="home-logos">

                <div class="home-logo-holder"><a target="_blank" href="{{ url('assets/public/img/pdf/als.pdf') }}"><img src="{{ url('assets/public/img/als-logo.svg') }}" alt="ALS"/></a></div>
                <div class="home-logo-holder"><a target="_blank" href="{{ url('assets/public/img/pdf/betagro.pdf') }}"><img src="{{ url('assets/public/img/betagro.svg') }}" alt="Betagro"/></a></div>
                <div class="home-logo-holder"><a target="_blank" href="{{ url('assets/public/img/pdf/ats_labs.pdf') }}"><img src="{{ url('assets/public/img/ats_labs.svg') }}" alt="ATS Labs"/></a></div>
                <div class="home-logo-holder"><a target="_blank" href="{{ url('assets/public/img/pdf/kitasato.pdf') }}"><img src="{{ url('assets/public/img/krces.svg') }}" alt="Krces"/></a></div>

            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/home/index.js') }}" type="text/javascript"></script>
@endsection


