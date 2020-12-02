               
const Vue = require('^resources/admin/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/staff').default);

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
        };
    },

    mounted() {
        this.init();
    },

    methods: {
        init() {
            var vm = this;
            $(document).ready(function() {
                vm.$toaster.init();
                vm.initDOM();
            });
        },

        initDOM() {
            var vm = this;
            $(".kt-selectpicker").selectpicker();
            $("#main-form").submit(vm.onFormSubmit);
        },

        onFormSubmit(e) {
            var vm = this;
            vm.$helper.addValueToForm("#main-form", 'active_company_id', vm.main.company.value);
            vm.$helper.addValueToForm("#main-form", 'active_country_id', vm.main.country.value);
        },
    }
});