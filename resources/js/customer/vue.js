const Vue = require('vue');

const mixin = require('./mixin');
require('./prototype');
Vue.mixin(mixin);

Vue.component('collection', require('^resources/components/customer/collection').default);
Vue.component('country-selector', require('^resources/components/customer/country-selector').default);
Vue.component('locale-selector', require('^resources/components/customer/locale-selector').default);

module.exports = Vue;
