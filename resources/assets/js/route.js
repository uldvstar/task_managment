
let routes = window.Laravel.routes
module.exports = function () {
    let args = Array.prototype.slice.call(arguments),
        name = args.shift(),
        prefixSlash =  routes[name] !== '/' ? '/':'';

    if (routes[name] === undefined) {
        console.error('Route not found ', name);
        return;
    }

    return window.Laravel.baseUrl + prefixSlash  + routes[name]
        .split('/')
        .map(s => s[0] === '{' ? args.shift() : s)
        .join('/');
};