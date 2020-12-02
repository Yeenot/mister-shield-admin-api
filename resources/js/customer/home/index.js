const Vue = require('^resources/customer/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/customer').default);
const app = new Vue({
    el: '#app',
    i18n,

    data: function() {
        return {};
    },

    mounted() {
    },

    methods: {
    }
});