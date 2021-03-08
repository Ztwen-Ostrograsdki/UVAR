import Swal from 'sweetalert2'
const users_a = {
	getUsers: (state) => {
		axios.get('/Uvar/administration/users&get&data/now', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_USERS', {users: response.data.users})
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
			.finally(() => state.commit('RESET_USERS_LOADING', true))  
	},

	getUser: (state, data) => {
		axios.post('/Uvar/utilisateur/' + data, 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_USERS_REQUESTS', {user: response.data.user, requests: response.data.requests})
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
			.finally(() => state.commit('RESET_USER_LOADING', true))       
	},

	createUser: (state, data) => {
		axios.post('/Uvar/administration/tag/utilisateur', {
			name: data.name,
			email: data.email,
			password: data.password,
			password_confirmation: data.confirm_password
		}, 
		{
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
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
	manageMyAffiliation: (state, data) =>{
		axios.post('/Uvar/Je&ne&reconnais&pas&cette&demande/affiliations/manage/referer=' + data.affiliation.referer_id + '/referee=' + data.affiliation.referee_id + '/token=' + data.affiliation.token + '/r=' + data.response + '/key=' + data.affiliation.token + '/e=no', 
		{
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
	    })
		.then(response => {
			if (response.data.success !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: 'Affiliation approuvée avec succès! ',
				  text: "Veuillez à présent consulter votre boite de reception email, afin de finaliser le processus de membre UVAR.",
				  showConfirmButton: true,
				  timer: 4000
				})
				state.dispatch('getUser', data.affiliation.referee_id)
				
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


export default users_a