const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);
import axios from 'axios'
import Multiselect from 'vue-multiselect'
import { Datetime } from 'vue-datetime';

const app = new Vue({
    el: '#app',
    i18n,
    components: {Multiselect, Datetime},
    data: function() {
        return {
            booking: {
                name: null,
                business_name: null,
                email: null,
                phone: null,
                property_type: '',
                category_id: '',
                company_id: '',
                country_id: '',
                service_id: '',
                area: null,
                date: null,
                time: null,
                address: null,
                notes: null
            },
            categories: [],
            requestedServices: [],
            errors: false,
            success: false,
            btnSubmitDisabled: false
        };
    },
    methods: {
        doChangePropertyType() {
            this.populateCategory()
            this.populateServices()
        },
        populateCategory() {
            var vm = this;
            axios.get(this.$route('customer.ajax.places.categories.fetch', {
                type: this.booking.property_type
            })).then((response) => {
                vm.categories = response.data.data
            });
        },

        populateServices() {
            var vm = this;
            var config = {
                params: {
                    type: this.booking.property_type,
                    order: vm.$helper.formatSortParams([
                        { column: 'order', dir: 'asc' },
                    ])
                }
            };
            axios.get(this.$route('customer.ajax.services.categories.fetch'), config)
            .then((response) => {
                vm.requestedServices = response.data.data
            });
        },
        prepare() {
            var data = Object.assign({}, this.booking)

            if(this.$helper.isNotNull(data.date)) {
                data.date = data.date.substring(0, 10);
            }

            if(this.$helper.isNotNull(data.time)) {
                data.time = data.time.substring(11, 19);
            }

            if(this.$helper.isNotNull(data.time) && this.$helper.isNotNull(data.date)) {
                data.booked_at = moment.tz([data.date, data.time].join(' '), 'YYYY-MM-DD HH:mm', this.main.collection.timezone).utc().format('MM/DD/YYYY HH:mm');
            }

            data.status = 'new';
            data.company_id = this.main.collection.company.id;
            data.country_id = this.main.collection.country.id;
            data._token = this.main.collection.csrf_token;

            return data;

        },
        doSubmit() {

            var vm = this;
            vm.errors = false;
            vm.success = false;
            vm.btnSubmitDisabled = true;
            axios.post(this.$route('customer.ajax.bookings.store'),
                this.prepare()
            ).then((response) => {
                vm.requestedServices = response.data.data
                vm.success = this.$t('customer/notifications.booking_successful');
                vm.errors = false
                vm.btnSubmitDisabled = false;
                this.resetFields();
                window.scrollTo(0, 0)
            }).catch(function(error) {
                vm.btnSubmitDisabled = false;
                if(error.response) {
                    window.scrollTo(0, 0)
                    vm.errors = Object.values(error.response.data.errors).flat()
                }
            });
        },
        resetFields() {
            this.booking = {
                name: null,
                business_name: null,
                email: null,
                phone: null,
                property_type: '',
                category_id: '',
                service_id: '',
                area: null,
                date: null,
                time: null,
                address: null,
                notes: null
            };

            this.categories = [];
            this.requestedServices = []
        }
    }
});
