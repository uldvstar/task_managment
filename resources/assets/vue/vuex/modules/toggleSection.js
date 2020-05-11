export default {
    state: {
        toggleSections: []
    },
    getters: {
        isShowing: (state) => (name) => {
            return state.toggleSections.indexOf(name) !== -1
        }
    },
    mutations: {
        SET_TOGGLE_SECTION(state, payload){
            let index = state.toggleSections.indexOf(payload.name);
            if(payload.status){
                if(index === -1){
                    state.toggleSections.push(payload.name)
                }
            } else {
                if(index !== -1){
                    state.toggleSections.splice(state.toggleSections.indexOf(payload.name), 1)
                }
            }
        }
    },
    actions: {
        toggleSection(store, payload){
            store.commit('SET_TOGGLE_SECTION', {name: payload.name, status: payload.status});
        }
    }
}