@extends('layouts.customer.index')
@section('title', __('customer/titles.contact'))

@section('content')
    <div class="container">
        <div class="cover contact"><h1>{{strtoupper(__('customer/titles.contact'))}}</h1></div>

        <div class="columns">
            <div class="column is-6">
                <ul class="contact-info">
                    <li>
                            <img src="{{ url('assets/public/img/company-purple.svg') }}" alt="location" />
                        {{ $main['company']->name ?? '' }}<br />
                    </li>
                    <li>
                            <img src="{{ url('assets/public/img/maps-and-flags.svg') }}" alt="location" />
                        {!!
                            implodeNotNull("<br>", [
                                ($main['company']->address->line_1 ?? null),
                                ($main['company']->address->line_2 ?? null),
                                (
                                    implodeNotNull(" ", [
                                        (implodeNotNull(', ', [
                                            ($main['company']->address->city ?? null),
                                            ($main['company']->address->state ? ($main['company']->address->state . ' ' .($main['company']->address->zip ?? null)) : null),
                                            ($main['company']->address->country->name ?? null)
                                        ]))
                                    ])
                                )
                            ])
                        !!}
                    </li>
                </ul>
            </div>
            <div class="column is-4 is-offset-2">
                <ul class="contact-info">
                    <li>
                        <img src="{{ url('assets/public/img/phone.svg') }}" alt="phone" />
                        <a href="tel:{{ $main['company']->customer_service_phone ?? '' }}">{{ $main['company']->customer_service_phone ?? '' }}</a>
                    </li>
                    <!--li>
                        <img src="{{ url('assets/public/img/paper-plane.svg') }}" alt="papper plane" />
                        <a href="mailto:{{ $main['company']->customer_service_email ?? '' }}">{{ $main['company']->customer_service_email ?? '' }}</a>
                    </li-->
                    <li>
                    <img src="{{ url('assets/public/img/globe.svg') }}" alt="network" />
                        <a href="https://www.mistershield.com">
                            {{ $main['company']->website ?? '' }}
                        </a>

                    </li>
                </ul>
            </div>


        </div>

        <div class="has-text-centered columns">
            <h3 class="no-marg">{{__('customer/titles.contact_leave_a_message')}}</h3>
        </div>


        <div class="notification is-danger" v-cloak v-if="errors">
            <ul>
                <li v-for="error in errors">
                    @{{ error }}
                </li>
            </ul>
        </div>

        <form class="contact-form" action="#" method="POST">
            {{ csrf_field() }}
            <div class="columns no-marg">
                <div class="column is-6">
                    <input type="text" name="name" v-model="contact.name" placeholder="{{ strtoupper(__('customer/forms.contact_name')) }} *" required="" />
                </div>
                <div class="column is-6">
                    <input type="text" name="business_name" v-model="contact.business_name" placeholder="{{ strtoupper(__('customer/forms.contact_business_name')) }}" />
                </div>
            </div>
            <div class="columns no-marg">
                <div class="column is-6">
                    <input type="email" name="email" v-model="contact.email" placeholder="{{ strtoupper(__('customer/forms.contact_email')) }} *" />
                </div>
                <div class="column is-6">
                    <input type="text" name="phone" v-model="contact.phone" placeholder="{{ strtoupper(__('customer/forms.contact_phone')) }} *" required="" />
                </div>
            </div>

            <div class="columns no-marg">
                <div class="column is-12">
                    <textarea name="message" required="" v-model="contact.message" placeholder="{{ strtoupper(__('customer/forms.contact_message')) }} *" class="notes no-marg"></textarea>
                </div>
            </div>

            <div class="has-text-centered">
                <button class="button-regular" type="button" @click="doSubmit">{{ __('customer/buttons.submit') }}</button>
            </div>

        </form>
    </div>

    <div id="contactModal" v-cloak :class="success ? 'is-active modal' : 'modal'">
        <div class="modal-background"></div>
        <div class="modal-content" style="background-color: white;">
            <button class="modal-close" onclick="location.href = '{{ lroute('customer.home') }}'">
                <img src="{{ url('assets/public/img/close.svg') }}"/>
            </button>
            <!-- Any other Bulma elements you want -->
            <img class="modal-logo" src="{{ url('assets/public/img/logo.svg') }}" alt="logo"/>
            <div class="modal-title">{{ __('customer/messages.contact_thank_you') }}</div>
            <div class="modal-txt">
                {{ __('customer/messages.contact_your_message_has_been_sent') }}
            </div>
        </div>

    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/contact/index.js') }}" type="text/javascript"></script>
@endsection
