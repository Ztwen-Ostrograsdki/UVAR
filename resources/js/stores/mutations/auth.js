const auth_mutations = {

    RESET_LOGIN_INVALIDS: (state, data) =>{
        state.invalidsLogin = data
    },
    RESET_USER: (state, data) =>{
        state.user = data.user
        state.active_member = data.active_member
        state.user_member = data.user_member
        state.connected = data.connected
    },
    RESET_USER_MEMBER: (state, data) =>{
        state.user_member = data.user_member
        state.active_member = data.active_member
    },
    GET_NOTIFICATIONS: (state, data) =>{
        state.notifications = data
    },
    LOGOUT: (state) => {
        state.user = {}
        state.connected = false
    },
}

export default auth_mutations