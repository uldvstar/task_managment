import Vue from 'vue'
import Vuex from 'vuex'
import toggleSection from './modules/toggleSection'
import toggleLoading from './modules/toggleLoading'
import createNotification from './modules/createNotification'
import crudRequest from './modules/crudRequest'
import authentication from './modules/authentication'
import loadRequestQueue from './modules/loadRequestQueue'

Vue.use(Vuex);

export default new Vuex.Store({
    modules: {
        toggleSection,
        toggleLoading,
        loadRequestQueue,
        createNotification,
        crudRequest,
        authentication
    }
})