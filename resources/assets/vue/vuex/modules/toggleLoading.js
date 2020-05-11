export default {
    state: {
        loading: []
    },
    getters: {
        isLoading: (state) => (name) => {
            let loader = state.loading.find(loader => loader.name === name);
            return loader ? loader.active > 0 : false
        }
    },
    mutations: {
        SET_LOADING_STATUS(state, payload){
            let loader = state.loading.find(loader => loader.name === payload.name);
            if(payload.status){
                loader ? loader.active++ : state.loading.push({'name': payload.name, 'active': 1})
            } else {
                loader ? loader.active-- : null
            }
        }
    },
    actions: {
        toggleLoading(store, payload){
            store.commit('SET_LOADING_STATUS', {name: payload.name, status: payload.status});
        }
    }
}