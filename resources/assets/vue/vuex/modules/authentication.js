export default {
    state: {
        resetPasswordEmail: '',
        authentication: {
            access_token: localStorage.getItem('user-token') || ''
        }
    },
    getters: {
        isAuthenticated: state => !!state.authentication.access_token,
        getAccessToken: state => state.authentication.access_token,
        getResetPasswordEmail: state => state.resetPasswordEmail
    },
    mutations: {
        SET_AUTHENTICATION(state, {access_token}){
            state.authentication.access_token = access_token;
        },
        SET_PASSWORD_RESET_EMAIL(state, {email}){
            state.resetPasswordEmail = email;
        }
    },
    actions: {
        userAuthentication(store, {access_token}){
            store.commit('SET_AUTHENTICATION', {access_token});
        },
        passwordResetEmail(store, {email}){
            store.commit('SET_PASSWORD_RESET_EMAIL', {email});
        }
    }
}