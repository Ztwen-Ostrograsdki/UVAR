const auth_mutations = {

    RESET_LOGIN_INVALIDS: (state, data) =>{
        state.invalidsLogin = data
    },
    RESET_USER: (state, data) =>{
        state.user = data.user
        state.connected = data.connected
    },
    LOGOUT: (state, msg) => {
        state.user = {}
        state.connected = false
    },
}

export default auth_mutations