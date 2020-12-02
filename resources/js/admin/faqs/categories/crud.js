               
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
                $(".kt-selectpicker").selectpicker();
                $("#main-form").submit(vm.onFormSubmit);
            });
        },

        onFormSubmit(e) {
            this.$helper.addValueToForm("#main-form", 'country_id', this.main.country.value);
        }
    }
});