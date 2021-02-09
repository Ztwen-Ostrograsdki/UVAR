const auth_mutations = {

    RESET_LOGIN_INVALIDS: (state, data) =>{
        state.invalidsLogin = data
    },
    RESET_USER: (state, data) =>{
        state.user = data.user
        state.active_member = data.active_member
        state.connected = data.connected
        state.token = data.token
    },
    RESET_ACTIVE_MEMBER: (state, data) =>{
        state.active_member = data.active_member
        state.active_member_photo = data.active_member_photo
        state.token = data.token
    },
    GET_NOTIFICATIONS: (state, data) =>{
        state.notifications = data
    },
    GET_REQUESTS: (state, data) =>{
        state.requests = data 
    },
    LOGOUT: (state) => {
        state.user = {}
        state.connected = false,
        active_member_photo = []
    },
}

export default auth_mutations