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
        state.connected = data.connected
    },
    GET_TOKEN: (state, data) =>{
        state.token = data.token
    },
    GET_VISITORS: (state, data) =>{
        state.visitors = data.visitors
    },
    GET_NOTIFICATIONS: (state, data) =>{
        state.notifications = data
    },
    GET_REQUESTS: (state, data) =>{
        state.actionsRequests = data.actionsRequests
        state.productsRequests = data.productsRequests 
    },
    LOGOUT: (state) => {
        state.user = {}
        state.connected = false,
        active_member_photo = []
    },
    RESET_NOTIFICATIONS_LOADING : (state, status) => {
        state.isLoadedNotifications = status
    },
    RESET_REQUESTS_LOADING : (state, status) => {
        state.isLoadedRequests = status
    },
    RESET_VISITORS_LOADING : (state, status) => {
        state.isLoadedVisitors = status
    },

    RESET_ADMIN_AUTH: (state, data) => {
        state.admin_auth = data
    }
}

export default auth_mutations