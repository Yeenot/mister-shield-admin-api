import Vue from 'vue'
import VueI18n from 'vue-i18n'

Vue.use(VueI18n)
export default (messages) => {
    return new VueI18n({
        locale: window.default_locale, // set locale
        fallbackLocale: window.fallback_locale,
        messages
    });
};