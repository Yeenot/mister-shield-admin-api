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
            },
        };
    },

    mounted() {
        this.init();
    },

    methods: {
        init() {
            var vm = this;
            $(document).ready(function(){
                vm.$toaster.init();
                vm.prepareData();
                vm.initDOM();
            });
        },

        prepareData() {
        },

        initDOM() {
        }
    }
});