@extends('layouts.customer.index')
@section('title', __('customer/titles.faq'))

@section('content')
    <div class="container">
        <div class="cover faq">
            <h1>{{ __('customer/titles.faq') }}</h1>
        </div>


        <div class="columns no-margin-bottom faq-buttons">
            <div class="column is-3" v-cloak v-for="(category, index) in categories">
                <button type="button" :class="{'active': index === btnSelected}" @click="getQuestions(category, index)" class="button-regular is-fullwidth faq-cat">@{{ category.name }}</button>
            </div>
        </div>

        <div class="faq-holder" v-cloak v-for="question in questions">
            <div class="question">
                <div class="great-letter">Q.</div>
                @{{ question.question }}
            </div>
            <div class="answer">
                <div class="great-letter">A.</div>
                <div v-cloak v-html="question.answer"></div>
            </div>
        </div>
    </div>
@endsection

@section('page_script')
    <script src="{{ url('js/customer/faq/index.js') }}" type="text/javascript"></script>
@endsection


