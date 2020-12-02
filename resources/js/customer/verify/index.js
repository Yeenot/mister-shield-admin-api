const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);
import axios from 'axios'

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            place: {},
            code: '',
            error: false
        };
    },

    mounted() {
    },

    methods: {
        search() {
            var vm = this;
            vm.error = false;
            axios.get(vm.$route('customer.ajax.places.search', {code: vm.code}))
                .then(function(response) {
                    vm.place = response.data.data;
                    window.location.href = vm.$lroute('customer.verify.results', {
                        code: vm.place.code,
                         slug: [
                             vm.$helper.slugify(vm.place.name),
                             vm.$helper.slugify(vm.place.district.name.toLowerCase()),
                             vm.$helper.slugify(vm.place.city.name.toLowerCase())
                         ].join('-')
                    });
                }).catch(function(err) {
                    if(err.response && err.response.status === 404) {
                        vm.error = true;
                        vm.code = '';
                    }
            });
        }
    }
});
