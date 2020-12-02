const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);
import axios from 'axios';

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            appointments: []
        };
    },
    mounted() {
        this.init();
    },
    methods: {
        init() {
            this.getServiceHistory();
        },
        getServiceHistory() {
            var vm = this;
            var config = {
                params: {
                    place: this.main.collection.place.id,
                    status: 'completed'
                }
            };
            axios.post(vm.$route('customer.ajax.appointments.services.history.list'), {
                _token: this.main.collection.csrf_token,
                order: [{ column: 0, dir: 'desc' }]
            }, config)
            .then(function(response) {
                vm.appointments = response.data.data;
            });
        }
    }
});
