const user_s = {
	users: [],
    admin: false,
    newUser: {
    	name: '',
    	email: '',
    	password: '',
    	confirm_password: '',
    },
    newUserSucess: {
    	step: null,
    	status: false
    },
    invalidsUserRegister: {},
    userRequests: [],
    isLoadedUsers: false,
    isLoadedUser: false,
}

export default user_s