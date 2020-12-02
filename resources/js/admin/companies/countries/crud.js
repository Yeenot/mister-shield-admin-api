               
const Vue = require('^resources/admin/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/staff').default);

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            country: {
                loading: false,
                options: [],
                value: ''
            }
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
                vm.getCountries();
            });
        },

        getCountries() {
            var vm = this;
            var collection = vm.main.collection;
            var company = (collection.company ?? {}).id ?? null;
            var country = (collection.country ?? {}).id ?? null;
            vm.country.loading = true;

            var data = {};
            if (vm.$helper.isNotNull(country)) {
                data.except = country;
            }
            $.ajax({
                url: vm.$route('admin.ajax.companies.countries.fetch.reverse', company),
                type: 'GET',
                data,
                dataType: 'JSON',
                success: function (response) {
                    vm.country.loading = false;
                    if (response && response.data) {
                        vm.country.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        }
    }
});