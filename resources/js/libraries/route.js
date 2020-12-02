const route = require('ziggy');
module.exports = (Ziggy) => {
    return (name, params, absolute) => {
        const router = route(name, params, absolute, Ziggy);
        // custom method for getting parameters
        router.getParameters = function(name) {

            var url = window.location.href.replace(Ziggy.baseUrl, '');
            var template = Ziggy.namedRoutes[name].uri;
            return router.extractParams(decodeURIComponent(url), template, '/');
        };
        return router;
    };
};