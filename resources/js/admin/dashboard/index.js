const Vue = require('^resources/admin/vue');
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/staff').default)

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