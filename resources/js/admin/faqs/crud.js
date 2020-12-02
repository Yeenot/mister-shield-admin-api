const Vue = require('^resources/admin/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/staff').default);

const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {
            category: {
                loading: false,
                value: '',
                options: [],
                error: null
            },
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
                vm.getCategories();
            });
        },

        getCategories() {
            var vm = this;
            vm.category.loading = true;
            $.ajax({
                url: vm.$route('admin.ajax.faqs_categories.fetch'),
                type: 'GET',
                data: {
                    country: vm.main.country.value
                },
                dataType: 'JSON',
                success: function (response) {
                    vm.category.loading = false;
                    if (response && response.data) {
                        vm.category.options = response.data.map(function(item) {
                            return {
                                id: item.id,
                                text: item.name
                            }
                        });
                    }
                }
            });
        },
    }
});