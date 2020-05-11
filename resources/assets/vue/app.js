
/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import Vue from 'vue'
import store from './vuex/store'
import Avatar from 'vue-avatar';
import Vuelidate from 'vuelidate'
import request from './mixins/requestMixin'
import crud from './mixins/crudMixin'

Vue.use(Vuelidate);
Vue.component('avatar', Avatar);


window.EventBus  = new Vue();
window.route = require('../js/route');

let handleOutsideClick;

Vue.directive('closable', {
    bind (el, binding, vnode) {
        handleOutsideClick = (e) => {
            e.stopPropagation();
            const { handler, exclude } = binding.value;

            let clickedOnExcludedEl = false;
            exclude.forEach(refName => {
                if (!clickedOnExcludedEl) {
                    const excludedEl = vnode.context.$refs[refName];
                    clickedOnExcludedEl = excludedEl.contains(e.target)
                }
            });

            if (!el.contains(e.target) && !clickedOnExcludedEl) {
                vnode.context[handler]()
            }
        };
        document.addEventListener('click', handleOutsideClick);
        document.addEventListener('touchstart', handleOutsideClick)
    },

    unbind () {
        document.removeEventListener('click', handleOutsideClick);
        document.removeEventListener('touchstart', handleOutsideClick)
    }
});

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const files = require.context('./', true, /\.vue$/i)
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));

Vue.mixin({
    methods: {
        route: route,
    },
    mixins: [request, crud]
});

const app = new Vue({
    el: '#app',
    store
});
