const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);
import axios from 'axios'

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            categories: [],
            questions: [],
            firstCategory: null,
            btnSelected: 0
        };
    },

    mounted() {
        var vm = this;
        axios.get(vm.$route('customer.ajax.faqs.fetch', {status: 'enabled'})).then(function(response) {
                if (response && response.data) {
                    var result = response.data;
                    vm.categories = result.data;

                    if(vm.categories.length) {
                        vm.getQuestions(vm.categories[0], 0)
                    }
                }
            });
    },

    methods: {

        getQuestions(faq, index) {
            var vm = this;

            vm.btnSelected = index;
            vm.questions = [];

            axios.get(vm.$route('customer.ajax.faqs.questions.fetch', {faq_category_id: faq.id}), {
                _token: vm.main.collection.csrf_token,
            }).then(function(response) {
                if (response && response.data) {
                    vm.questions = response.data.data;
                }
            });
        }
    }
});
