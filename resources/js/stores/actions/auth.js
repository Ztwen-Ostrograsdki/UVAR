import Swal from 'sweetalert2'
const auth_actions = {
	logout: (state) => {
		Swal.fire({
		  icon: 'warning',
		  title: 'Vous serez déconnecté dans quelques secondes',
		  showConfirmButton: false,
		  timer: 2000
		})
        axios.post('/uvar/systeme/disconnect&user/now')
			.then(response => {
				state.commit('LOGOUT', response.data)
			})      
	},
	login: (state, user) => {
        axios.post('/login/uvar&user&get&auth', user)
		.then(response => {
			if(response.data.invalids !== undefined){
				state.commit('RESET_LOGIN_INVALIDS', response.data.invalids)
				
			}
			else if (response.data.success !== undefined) {

				Swal.fire({
				  icon: 'success',
				  title: 'Connexion réussie',
				  showConfirmButton: false,
				  timer: 2000
				})
				$('#login #Registration input').val('')
				$('#login #Registration input').removeClass('is-invalid')
				$('#login #Registration i').text('')
				$('#login').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				state.commit('RESET_USER', {connected: true, user: response.data.success})
			}
		})
		.catch(err => {
			
		})     
	},  
	getConnected: (state) =>{
		axios.post('/uvar/systeme/get&auth&user')
		.then(response => {
			if (response.data.success !== undefined) {
				state.commit('RESET_USER', {connected: true, user: response.data.success})
			}
			else if (response.data.disconnected !== undefined) {
				state.commit('RESET_USER', {connected: false, user: {}})
			}
		})
		.catch(err => {
			
		})   
	}

}


export default auth_actions