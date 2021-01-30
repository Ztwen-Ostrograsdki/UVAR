import Swal from 'sweetalert2'
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
				Swal.fire({
				  icon: 'success',
				  title: 'Connexion réussie',
				  showConfirmButton: false,
				  timer: 2000
				})
			}
		})
		.catch(err => {
			
		})     
	},  

}


export default auth_actions