const Vue = require('vue');

const permission = require('^resources/libraries/permission');
const helper = require('^resources/libraries/helper');
const toaster = require('^resources/libraries/toaster');
var { Ziggy } = require('^resources/customer/ziggy');
const route = require('^resources/libraries/route')(Ziggy);

Vue.prototype.$helper = helper;
Vue.prototype.$toaster = toaster;
Vue.prototype.$permission = permission;
Vue.prototype.$route = route;
Vue.prototype.$lroute = function(name, parameters, absolute) {
    var country = this.main.collection.country.code;
    var locale = this.main.collection.language.code;
    // call route function
    return this.$route(name, Object.assign({}, { country, locale }, parameters), absolute);
}
Vue.prototype.$flags = function(path) {
    return helper.isNotNull(path) ? require(`^assets/customer/flags/4x3/${path.toLowerCase()}.svg`) : '';
}
