import axios from "axios";

const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            contact: {
                name: '',
                business_name: '',
                email: '',
                phone: '',
                message: '',
                status: 'new'
            },
            success: false,
            errors: false
        };
    },

    methods: {
        doSubmit() {
            var vm = this;
            vm.errors = false;
            this.success = false;
            this.contact._token = this.main.collection.csrf_token;
            this.contact.company_id = this.main.collection.company.id;
            this.contact.country_id = this.main.collection.country.id;

            axios.post(this.$route('customer.ajax.contact.store'), this.contact, {
                headers: {
                    'Content-type': 'application/json',
                    'Accept': 'application/json',
                }
            }).then((response) => {
                vm.requestedServices = response.data.data
                vm.success = true;
                vm.errors = false
                this.resetFields();

                window.scrollTo(0, 0)
            }).catch(function (error) {
                vm.success = false;
                if (error.response) {
                    vm.errors = Object.values(error.response.data.errors).flat()
                }
            });
        },
        resetFields() {
            this.contact = {
                business_name: '',
                email: '',
                phone: '',
                message: ''
            }
        },
        closeModal() {
            this.success = false
        }
    }
});
