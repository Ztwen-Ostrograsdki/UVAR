const auth_actions = {
	logout: (state) => {
        axios.post('/admin/director/master/logout&user')
			.then(response => {
				state.commit('LOGOUT', response.data)
			})      
	},
	login: (state, user) => {
        axios.post('login/uvar&user&get&auth', user)
		.then(response => {
			console.log(response.data)
			if(response.data.invalids !== undefined){
				state.commit('RESET_INVALIDS', response.data.invalids)
				
			}
			else if (response.data.success !== undefined) {
				
			}
		})
		.catch(err => {
			
		})     
	},  

}


export default auth_actions