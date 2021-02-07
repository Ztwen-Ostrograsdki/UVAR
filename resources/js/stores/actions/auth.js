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
				state.commit('LOGOUT')
			})      
	},
	login: (state, user) => {
        axios.post('/login/uvar&user&get&auth', user)
		.then(response => {
			console.log(response.data)
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
				state.commit('RESET_USER', {connected: true, active_member: response.data.success.active_member, user: response.data.success.user, user_member: response.data.success.user})
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
	},
	getUserMember: (state) =>{
		axios.post('/uvar/systeme/auth&get&auth&member')
		.then(response => {
			if (response.data.user_member !== undefined) {
				state.commit('RESET_USER_MEMBER', {user_member: response.data.user_member, active_member: response.data.active_member})
			}
		})
		.catch(err => {
			Swal.fire({
			  icon: 'warning',
			  title: 'Echec de connexion au serveur' + err,
			  showConfirmButton: false,
			})
		})   
	},
	getNotifications: (state) =>{
		axios.post('/Uvar/systeme/notify&system')
		.then(response => {
			if (response.data.notifications !== undefined) {
				state.commit('GET_NOTIFICATIONS', response.data.notifications)
			}
		})
		.catch(err => {
			Swal.fire({
			  icon: 'warning',
			  title: 'Echec de connexion au serveur' + err,
			  showConfirmButton: false,
			})
		})   
	},
	manageAffiliation: (state, data) =>{
		axios.post('/Uvar/administration/affiliations/manage', {
			status: data.status,
			referee: data.referee
		})
		.then(response => {
			if (response.data.notifications !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: 'Opération réussie avec succès',
				  showConfirmButton: false,
				  timer: 2000
				})
				state.commit('GET_NOTIFICATIONS', response.data.notifications)
				state.dispatch('getMembers')
			}
		})
		.catch(err => {
			Swal.fire({
			  icon: 'warning',
			  title: 'Une erreure est survenue' + err,
			  showConfirmButton: false,
			})
		})   
	},



}


export default auth_actions