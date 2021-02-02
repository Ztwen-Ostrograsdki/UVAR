const users_m = {

    GET_USERS: (state, data) => {
        state.users = data.users
    },
    LOGOUT: (state, msg) => {
        
    },
    RESET_NEW_USER: (state) =>{
    	state.newUser = {
    		name: '',
	    	email: '',
	    	password: '',
	    	confirm_password: '',
    	}
    },
    RESET_REGISTER_USERS_INVALIDS: (state, data) =>{
        state.invalidsUserRegister = data
    },

    RESET_NEW_USER_SUCCESS: (state, data) =>{
        state.newUserSucess = {
            status: data.status,
            step: data.step
        }
    },
    
    
}

export default users_m