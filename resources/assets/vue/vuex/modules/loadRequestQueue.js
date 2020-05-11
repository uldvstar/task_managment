export default {
    state: {
        queue: []
    },
    getters: {
        isInQueue: (state) => (name) => {
            let list = state.queue.find(list => list.name === name);
            return !!list
        },
        isInCompleteQueue: (state) => (name) => {
            let list = state.queue.find(list => list.name === name);
            return list ? !list.complete : false;
        },
        getListDetails: (state) => (name) => {
            return state.queue.find(list => list.name === name);
        },
        getListData: (state, getters) => (name) => {
            return (!getters.isInCompleteQueue()) ? state.queue.find(list => list.name === name).data : [];
        },
        getSelectableList: (state, getters) => (name) => {
            let list = state.queue.find(list => list.name === name);
            return list ? list.data : [];
        }

    },
    mutations: {
        SET_QUEUE_LIST(state, payload){
            let list = state.queue.find(list => list.name === payload.name);

            list ? Object.assign(list, {page: payload.page, filters: payload.filters, complete: false}) :
                state.queue.push({'name': payload.name, 'page': payload.page, 'filters': payload.filters, 'complete': false, 'data': []});

        },
        SET_LIST_INCOMPLETE(state, payload) {
            state.queue.find(list => list.name === payload.name).complete = false
        },
        SET_LIST_COMPLETE(state, payload) {
            let list = state.queue.find(list => list.name === payload.name);

            list.complete = true;
            list.data = payload.data;
        }
    },
    actions: {
        updateListQueue(store, payload){
            store.commit('SET_QUEUE_LIST', {name: payload.name, page: payload.page, filters: payload.filters});
        },
        fetchSelectable({ commit, getters, dispatch }, payload){
            if(!getters.isInQueue(payload.section)){
                dispatch('updateListQueue', {name: payload.section});
                dispatch('crudRequest', {endpoint: payload.endpoint, method: 'get'}).then(response => {
                    let success = response.ok;
                    response.json().then(response => {

                        if(!success){return;}

                        dispatch('completeList', {name: this.section, data: response.payload.data})

                    });
                })
            }

        },
        reloadList({ commit, getters }, payload){
            getters.isInQueue(payload.name) ? commit('SET_LIST_INCOMPLETE', {name: payload.name}) : commit('SET_QUEUE_LIST', {name: payload.name, page: 1, filters: {}});
        },
        completeList(store, payload){
            store.commit('SET_LIST_COMPLETE', {name: payload.name, data: payload.data});
        }
    }
}