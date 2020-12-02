<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>
        @if(request()->segment(3) == '')
            Mister Shield - {{ __('customer/titles.home') }}
        @else
            @yield('title') - Mister Shield {{$main['country']->name}}
        @endif
    </title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- favicons --}}
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/32×32px.png') }}" sizes="32x32" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/128×128px.png') }}" sizes="128x128" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/152×152px.png') }}" sizes="128x128" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/167×167px.png') }}" sizes="128x128" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/180×180px.png') }}" sizes="128x128" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/192×192px.png') }}" sizes="128x128" />
    <link rel="icon" type="image/x-icon" href="{{ url('assets/public/img/favicons/196×196px.png') }}" sizes="128x128" />

    <link rel="stylesheet" href="{{ url('assets/public/css/app.min.css') }}"/>

    @if(config('app.env') === 'production')
    <!-- Global site tag (gtag.js) - Google Analytics -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-173964049-1"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-173964049-1');
    </script>

        <!-- Facebook Pixel Code -->
        <script>
            !function(f,b,e,v,n,t,s)
            {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                n.queue=[];t=b.createElement(e);t.async=!0;
                t.src=v;s=b.getElementsByTagName(e)[0];
                s.parentNode.insertBefore(t,s)}(window,document,'script',
                'https://connect.facebook.net/en_US/fbevents.js');
            fbq('init', '338365247184560');
            fbq('track', 'PageView');
        </script>
        <noscript>
            <img height="1" width="1"
                 src="https://www.facebook.com/tr?id=338365247184560&ev=PageView
&noscript=1"/>
        </noscript>
        <!-- End Facebook Pixel Code -->
    @endif

    @yield('page_css')
    @yield('page_css_plugin')
</head>
<body>
    <div id="app">
        <collection
            variables='<?php echo json_encode([
                "csrf_token" => csrf_token(),
                "language" => $main["language"],
                "company" => $main["company"],
                "country" => $main["country"],
                "timezone" => $main['company']->timezone
            ], JSON_HEX_APOS); ?>'>
        </collection>
        <header>
        <div class="container">
            <div class="header-top">
                <div class="top-left">
                    {{-- countries--}}
                    <country-selector
                        class="control has-icons-left"
                        :items="{{ $main['countries'] }}"
                        :initial="{{ $main['country'] }}"
                        v-model="main.country"
                        @change="onCountryChange"
                    >
                    </country-selector>

                    {{-- languages --}}
                    <locale-selector
                        :items="{{ $main['languages'] }}"
                        :initial="{{ $main['language'] }}"
                        v-model="main.language"
                        @change="onLanguageChange"
                    >
                    </locale-selector>

                    <div class="is-flex social-left">
                        <a href="{{ $main['company']->facebook ?? '' }}" target="_blank">
                            <img src="{{ url('assets/public/img/fb.svg') }}" alt="facebook"  />
                        </a>
                        <a href="{{ $main['company']->instagram ?? '' }}" target="_blank">
                            <img src="{{ url('assets/public/img/insta.svg') }}" alt="instagram" />
                        </a>
                        <a href="{{ $main['company']->linkedin ?? '' }}" target="_blank">
                            <img src="{{ url('assets/public/img/linkedin.svg') }}" alt="linked in" />
                        </a>
                        <a href="{{ $main['company']->youtube ?? '' }}" target="_blank">
                            <img src="{{ url('assets/public/img/yt.svg') }}" alt="youtube" />
                        </a>
                    </div>

                </div>
                <div class="top-right">
                    <ul>
                        <li>
                            <img src="{{ url('assets/public/img/phone.svg') }}" alt="phone" />
                            <a href="tel:{{ $main['company']->customer_service_phone ?? '' }}" target="_blank">
                                {{ $main['company']->customer_service_phone ?? '' }}
                            </a>
                        </li>
                        <li>
                            <img src="{{ url('assets/public/img/network.svg') }}" alt="phone" />
                            <a href="https://line.me/R/ti/p/%40{{ $main['company']->line ?? '' }}" target="_blank">
                                {{ $main['company']->line ?? '' }}
                            </a>
                        </li>
                    </ul>
                </div>

            </div>

        </div>
        <nav class="navbar" role="navigation" aria-label="main navigation">
            <div class="container">
                <div class="navbar-brand">
                    <a role="button" class="navbar-burger burger" aria-label="menu" aria-expanded="false"
                       data-target="navbarBasicExample">
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                        <span aria-hidden="true"></span>
                    </a>
                    <a class="navbar-item logo" href="{{ lroute('customer.home') }}">
                        <img href="index.html" src="{{ url('assets/public/img/logo.svg') }}" alt="Mister Shield">
                    </a>

                </div>

                <div id="navbarBasicExample" class="navbar-menu">
                    <div class="navbar-end">
                        <a href='{{ lroute('customer.about') }}' class="navbar-item">
                            {{ __('customer/navigations.about') }}
                        </a>
                        <a href="{{ lroute('customer.services') }}" class="navbar-item">
                            {{ __('customer/navigations.services') }}
                        </a>
                        <a href="{{ lroute('customer.pricing') }}" class="navbar-item">
                            {{ __('customer/navigations.pricing') }}
                        </a>
                        <a href='{{ lroute('customer.serviced_locations') }}' class="navbar-item">
                            {{ __('customer/navigations.serviced_locations') }}
                        </a>
                        <a href='{{ lroute('customer.faq') }}' class="navbar-item">
                            {{ __('customer/navigations.faq') }}
                        </a>
                        <a href='{{ lroute('customer.verify') }}' class="navbar-item is-hidden-tablet">
                            {{ __('customer/navigations.verify_place') }}
                        </a>
                        <a href='{{ lroute('customer.contact') }}' class="navbar-item">
                            {{ __('customer/navigations.contact') }}
                        </a>
                        <div class="is-flex place-lang">
                            {{-- countries--}}
                            <country-selector
                                :items="{{ $main['countries'] }}"
                                :initial="{{ $main['country'] }}"
                                v-model="main.country"
                                @change="onCountryChange"
                            >
                            </country-selector>
                            {{-- languages --}}
                            <locale-selector
                                :items="{{ $main['languages'] }}"
                                :initial="{{ $main['language'] }}"
                                v-model="main.language"
                                @change="onLanguageChange"
                            >
                            </locale-selector>
                        </div>
                    </div>
                </div>
                <button class="button-header is-hidden-mobile" onclick="location.href = '{{ lroute('customer.verify') }}'">
                {{ __('customer/buttons.verify_place') }}
                </button>
                <button class="button-header" onclick="location.href = '{{ lroute('customer.booking') }}'">
                    {{ __('customer/buttons.book_now') }}
                </button>
            </div>
        </nav>
        </header>

        @yield('content')

        <footer>

            <div class="container">
                <div class="columns">
                    <div class="column is-two-fifths">
                        <div class="footer-left">
                            <ul>
                                <li>
                                    <div>
                                        <img src="{{ url('assets/public/img/company.svg') }}" alt="location" />
                                    </div>
                                    {{ $main['company']->name ?? '' }}<br />
                                </li>
                                <li>
                                    <div>
                                        <img src="{{ url('assets/public/img/location.svg') }}" alt="location" />
                                    </div>
                                    {!!
                                        implodeNotNull("<br>", [
                                            ($main['company']->address->line_1 ?? null),
                                            ($main['company']->address->line_2 ?? null),
                                            (
                                                implodeNotNull(" ", [
                                                    (implodeNotNull(', ', [
                                                        ($main['company']->address->city ?? null),
                                                        ($main['company']->address->state ?? null) . ' ' . ($main['company']->address->zip ?? null),
                                                        ($main['company']->address->country->name ?? null)
                                                    ]))
                                                ])
                                            )
                                        ])
                                    !!}
                                </li>
                                <li>
                                    <a href="{{ isset($main['company']->customer_service_phone) ? ('tel: ' . $main['company']->customer_service_phone) : '' }}">
                                        <img src="{{ url('assets/public/img/phone-white.svg') }}" alt="phone" />
                                        {{ $main['company']->customer_service_phone ?? '' }}
                                    </a>

                                </li>
                                <!--li>
                                    <img src="{{ url('assets/public/img/send.svg') }}" alt="papper plane" />
                                    <a href="mailto:{{ $main['company']->customer_service_email ?? '' }}">
                                        {{ $main['company']->customer_service_email ?? '' }}
                                    </a>
                                </li-->
                                <li>
                                    <img src="{{ url('assets/public/img/globe-white.svg') }}" alt="network" />
                                    <a href="{{ lroute('customer.home') }}">{{ $main['company']->website ?? '' }}</a>
                                </li>
                            </ul>

                        </div>
                    </div>
                    <div class="column is-one-fifths">
                        <ul>
                            <li><a href="{{ lroute('customer.about') }}">{{ __('customer/navigations.about') }}</a></li>
                            <li><a href="{{ lroute('customer.services') }}">{{ __('customer/navigations.services') }}</a></li>
                            <li><a href="{{ lroute('customer.pricing') }}">{{ __('customer/navigations.pricing') }}</a></li>
                            <li><a href="{{ lroute('customer.faq') }}">{{ __('customer/navigations.faq') }}</a></li>
                        </ul>
                    </div>
                    <div class="column is-one-fifths">
                        <ul>
                            <li><a href="{{ lroute('customer.serviced_locations') }}">{{ __('customer/navigations.serviced_locations') }}</a></li>
                            <li><a href="{{ lroute('customer.completed_services') }}">{{ __('customer/navigations.completed_services') }}</a></li>
                            <li><a href="{{ lroute('customer.verify') }}">{{ __('customer/navigations.verify_place') }}</a></li>
                            <li><a href="{{ lroute('customer.booking') }}">{{ __('customer/navigations.booking') }}</a></li>
                        </ul>
                    </div>
                    <div class="column is-one-fifths">
                        <ul>
                            <li><a href="{{ lroute('customer.privacy_policy') }}">{{ __('customer/navigations.privacy_policy') }}</a></li>
                        </ul>
                        <div class="footer-social">
                            <a href="{{ $main['company']->facebook ?? '' }}" target="_blank">
                                <img src="{{ url('assets/public/img/fb-white.svg') }}" alt="facebook" />
                            </a>
                            <a href="{{ $main['company']->instagram ?? '' }}" target="_blank">
                                <img src="{{ url('assets/public/img/insta-white.svg') }}" alt="instagram" />
                            </a>
                            <a href="{{ $main['company']->linkedin ?? '' }}" target="_blank">
                                <img src="{{ url('assets/public/img/linkedin-white.svg') }}" alt="linked in" />
                            </a>
                            <a href="{{ $main['company']->youtube ?? '' }}" target="_blank">
                                <img src="{{ url('assets/public/img/yt-white.svg') }}" alt="youtube" />
                            </a>
                        </div>
                    </div>
                </div>

            </div>
            <div class="copyright">{{ __('customer/messages.footer', [ 'attribute' => now()->year . ' ' . $main['company']->name ?? '' ]) }}</div>

        </footer>
    </div>
    <script>
        // locale
        window.default_locale = "{{ config('app.locale') }}";
        window.fallback_locale = "{{ config('app.fallback_locale') }}";

        // domain
        window.app_name = "{{ config('app.name') }}";
        window.app_url= "<?php echo config('app.url'); ?>";
        window.app_domain= <?php echo json_encode(parse_url(config("app.url"))); ?>;
    </script>
    <script src="{{ url('assets/public/js/script.js') }}"></script>
    @yield('page_plugin')
    @yield('page_script')
    @stack('scripts')
</body>
</html>
