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
				if (response.data.success) {
					state.commit('LOGOUT')
					window.location = '/'
				}
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
				state.commit('RESET_USER', {token: response.data.success.token, connected: true, active_member_photo: response.data.success.active_member_photo, active_member: response.data.success.active_member, user: response.data.success.user, user_member: response.data.success.user})
			}
		})
		.catch(err => {
			
		})     
	},  
	getConnected: (state) =>{
		axios.post('/uvar/systeme/get&auth&user')
		.then(response => {
			if (response.data.success !== undefined) {
				state.commit('RESET_USER', {connected: true, user: response.data.success, token: response.data.success.token})
			}
			else if (response.data.disconnected !== undefined) {
				state.commit('RESET_USER', {connected: false, user: {}})
			}
		})
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
		})     
	},
	getActiveMember: (state) =>{
		axios.post('/uvar/systeme/auth&get&auth&member')
		.then(response => {
			if (response.data.user_member !== undefined) {
				state.commit('RESET_ACTIVE_MEMBER', 
					{
						active_member: response.data.active_member, 
						active_member_photo: response.data.active_member_photo,
						token: response.data.token,
					}
				)
				// state.dispatch('getMember', response.data.user_member.id)
			}
		})
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
		})   
	},
	getNotifications: (state) =>{
		axios.post('/Uvar/systeme/notify&system')
		.then(response => {
			if (response.data.notifications !== undefined) {
				state.commit('GET_NOTIFICATIONS', response.data.notifications)
			}
		})
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
		})    
	},
	getRequests: (state) =>{
		axios.post('/Uvar/systeme/requests/fecth&them')
		.then(response => {
			if (response.data.requests !== undefined) {
				state.commit('GET_REQUESTS', response.data.requests)
			}
		})
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
		})    
	},
	manageRequest: (state, data) =>{
		axios.post('/Uvar/administration/requests/manage', {
			status: data.status,
			target: data.target,
			demander: data.demander,
			type: data.type,
		})
		.then(response => {
			if (response.data.requests !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: 'Opération réussie avec succès',
				  showConfirmButton: false,
				  timer: 2000
				})
				state.commit('GET_REQUESTS', response.data.requests)
				state.dispatch('getMembers')
			}
		})
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
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
		.catch(err =>{
			if (err.response.status == 401) {
				Swal.fire({
				  icon: 'warning',
				  title: "Erreure connexion: Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				window.location = '/'
			}
		})    
	},



}


export default auth_actions