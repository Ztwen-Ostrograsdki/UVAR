const users_a = {
	getUsers: (state) => {
		axios.get('/Uvar/administration/users&get&data/now')
			.then(response => {
				state.commit('GET_USERS', {users: response.data.users})
			})    
	},

	createUser: (state, data) => {
		axios.post('/Uvar/administration/tag/utilisateur', {
			name: data.name,
			email: data.email,
			password: data.password,
			password_confirmation: data.confirm_password
		})
		.then(response => {
			if (response.data.invalids !== undefined) {
				console.log(response.data)
				state.commit('RESET_INVALIDS', response.data.invalids)
			}
			else{
				if (response.data.success !== undefined) {
					$('#login #Registration input').val('')
					$('#login #Registration input').removeClass('is-invalid')
					$('#login #Registration i').text('')
					$('#login').modal('hide')
					// $('body').removeClass('modal-open')
					$('.modal-backdrop').remove()
					$('#confirmationRegistration').modal();


				}
			}
		})    
	},

}


export default users_a