// Application js for admin
import Vue from 'vue'
const i18n = (require('^resources/i18n').default)(require('^public/js/lang/staff').default)

// Prototypes
const permission = require('^resources/libraries/permission');
const helper = require('^resources/libraries/helper');
const toaster = require('^resources/libraries/toaster');
var { Ziggy } = require('^resources/admin/ziggy');
const route = require('^resources/libraries/route')(Ziggy);

Vue.prototype.$helper = helper;
Vue.prototype.$toaster = toaster;
Vue.prototype.$route = route;
Vue.prototype.$permission = permission;

// Mixin
const mixin = require('./mixin');
Vue.mixin(mixin);

// Common components
Vue.component('collection', require('^resources/components/admin/collection').default);
Vue.component('datatable', require('^resources/components/admin/datatable').default);
Vue.component('select2', require('^resources/components/admin/select2').default);
Vue.component('mobile', require('^resources/components/admin/mobile').default);
Vue.component('v-switch', require('^resources/components/admin/v-switch').default);
Vue.component('v-input', require('^resources/components/admin/v-input').default);
Vue.component('datetimepicker', require('^resources/components/admin/datetimepicker').default);
Vue.component('datepicker', require('^resources/components/admin/datepicker').default);

// Per page data
const root = document.getElementById('app')
var page = root.dataset.vuePage;
var data = root.dataset.vueProps;
var config = require(`^resources/admin/${page}.js`)(data);

// Vue instance
const app = new Vue(Object.assign({}, {el: '#app', i18n}, config));