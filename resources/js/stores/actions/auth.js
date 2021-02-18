import Swal from 'sweetalert2'
const Toast = Swal.mixin({
	toast: true,
	position: 'top-start',
	showConfirmButton: false,
	background: 'black',
	timer: 3000,
	timerProgressBar: true,
	didOpen: (toast) => {
		toast.addEventListener('mouseenter', Swal.stopTimer)
		toast.addEventListener('mouseleave', Swal.resumeTimer)
	}
})
const auth_actions = {
	logout: (state) => {
		Toast.fire({
		  icon: 'success',
		  title: 'Vous serez déconnecté dans quelques secondes...',
		})
        axios.post('/uvar/systeme/disconnect&user/now', 
        		{
	        		headers: {
	        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			        }
			    }
        	)
			.then(response => {
				if (response.data.success) {
					state.commit('LOGOUT')
					window.location = '/'
				}
			})      
	},
	login: (state, user) => {
        axios.post('/login/uvar&user&get&auth', user, 
        	{
        		headers: {
        			'X-CSRF-TOKEN': user.token,
		        }
		    }
		)
		.then(response => {
			if(response.data.invalids !== undefined){
				state.commit('RESET_LOGIN_INVALIDS', response.data.invalids)
				
			}
			else if (response.data.success !== undefined) {

				Toast.fire({
				  icon: 'success',
				  title: 'Connexion réussie',
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
		axios.post('/uvar/systeme/get&auth&user', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
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
	getToken: (state) =>{
		axios.post('/uvar/systeme/token/auth', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
		.then(response => {
			if (response.data.token !== undefined) {
				state.commit('GET_TOKEN', {token: response.data.token})
			}
		})
	},
	getActiveMember: (state) =>{
		axios.post('/uvar/systeme/auth&get&auth&member', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
		.then(response => {
			if (response.data.user_member !== undefined) {
				state.commit('RESET_ACTIVE_MEMBER', 
					{
						active_member: response.data.active_member, 
						active_member_photo: response.data.active_member_photo,
						token: response.data.token,
						connected: true,
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
		axios.post('/Uvar/systeme/notify&system', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
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
		.finally(() => state.commit('RESET_NOTIFICATIONS_LOADING', true))  
	},
	getRequests: (state) =>{
		axios.post('/Uvar/systeme/requests/fecth&them', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
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
		.finally(() => state.commit('RESET_REQUESTS_LOADING', true))
	},
	manageRequest: (state, data) =>{
		axios.post('/Uvar/administration/demande/manage/type=' + data.type +'/request=' + data.request_id + '/response=' + data.response, 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    }
		)
		.then(response => {
			if (response.data.requests !== undefined || response.data.message !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: 'Opération réussie: ' + response.data.message,
				  showConfirmButton: false,
				  timer: 2000
				})
				if (response.data.requests !== undefined) {
					state.commit('GET_REQUESTS', response.data.requests)
				}
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
			referee: data.referee,
			affiliate_id: data.affiliate_id,
		}, 
		{
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
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
			else if (response.data.errors !== undefined) {
				Swal.fire({
				  	icon: 'warning',
				  	title:"Echec de procedure",
				  	text: response.data.errors,
				  	showConfirmButton: false,
				})
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