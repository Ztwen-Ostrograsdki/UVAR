import Swal from 'sweetalert2'
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
				state.commit('RESET_REGISTER_USERS_INVALIDS', response.data.invalids)
			}
			else{
				if (response.data.success !== undefined) {

					Swal.fire({
					  icon: 'success',
					  title: response.data.success,
					  showConfirmButton: false,
					})
					$('#login #Registration input').val('')
					$('#login #Registration input').removeClass('is-invalid')
					$('#login #Registration i').text('')
					$('#login').modal('hide')
					$('body').removeClass('modal-open')
					$('.modal-backdrop').remove()
					// $('#confirmationRegistration').modal();


				}
			}
		})
		.catch(err => {
			Swal.fire({
			  icon: 'error',
			  title: "Une erreure inconnue s'est produite ",
			  showConfirmButton: false,
			  timer: 2000
			})
		})  
	},

}


export default users_a