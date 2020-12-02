const mixin = {
    data: function() {
        return {
            main: {
                country: null,
                language: null,
            }
        }
    },
    mounted() {
        require('^assets/customer/js/script.js');
    },

    methods: {
        onCountryChange(country) {
            this.changeLocale(country, this.main.language);
        },

        onLanguageChange(language) {
            this.changeLocale(this.main.country, language);
        },

        changeLocale(country, language) {
            if (country && language) {
                var route = this.$route();
                var current = route.current();
                var params = route.getParameters(current);
                params = Object.assign({}, params, {
                    country: country.code.toLowerCase(),
                    locale: language.code
                });
                window.location.href = this.$route(current, params);
            }
        }
    }
};

module.exports = mixin;
