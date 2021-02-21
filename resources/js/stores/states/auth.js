const auth_states = {
    invalidsLogin: {},
    token: '',
    user: {},
    visitors: [],
    active_member: {id: null},
    user_member: {id: ''},
    connected: false,
    login: false,
    member: {},
    user: {},
    affiliationsNotifications: [],
    notifications: [],
    isLoadedVisitors: false,
    isLoadedNotifications: false,
    isLoadedRequests: false,
    actionsRequests: [],
    productsRequests: [],
    admin_auth: {status: false, key: ''},

}

export default auth_states