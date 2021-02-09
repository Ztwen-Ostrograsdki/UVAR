import Swal from 'sweetalert2'
const uvar_action_a = {
	getActions: (state) => {
		axios.get('/Uvar/administration/actions&get&data/now')
			.then(response => {
				state.commit('GET_ACTIONS', {
						actions: response.data.actions,
						totalBoughtByAction: response.data.totalBoughtByAction,
				})
			})
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
			})   
	},
	getAction: (state, action) => {
		// axios.get('/Uvar/administration/actions&get&data/now' + action.id)
		// 	.then(response => {
		// 		state.commit('GET_ACTION', {
		// 				action: response.data.action,
		// 				totalBoughtByAction: response.data.totalBoughtByAction,
		// 		})
		// 	})
		// 	.catch(err =>{
		// 		if (err.response.status == 401) {
		// 			Swal.fire({
		// 			  icon: 'warning',
		// 			  title: "Vous n'êtes pas authorisé",
		// 			  showConfirmButton: false,
		// 			})
		// 			window.location = '/'
		// 		}
		// 	})   
	},
	getAllActions: (state) => {
		axios.post('/boutique/q=actions')
			.then(response => {
				state.commit('GET_ALL_ACTIONS', {
						actions: response.data.actions,
				})
			})
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
			})   
	},
	getAllActionsOnlyAPart: (state) => {
		axios.post('/boutique/q=actions/length')
			.then(response => {
				state.commit('GET_ALL_ACTIONS_ONLY_A_PART', {
						actions: response.data.actions,
				})
			})
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
			})   
	},

	createAction: (state, data) => {
		axios.post('/Uvar/administration', {
			
		})
		.then(response => {
			state.commit('GET_ACTIONS', {actions: response.data.actions})
		})    
	},
	updateAction: (state, data) => {
		axios.put('/Uvar/administration/tag/actions/' + data.action.action.id, {
			image: data.action.image,
			name: data.action.action.name,
			description: data.action.action.description,
			price: data.action.action.price,
			total: data.action.action.total,
		})
		.then(response => {
			if (response.data.errors !== undefined) {
				state.commit('RESET_INVALIDS_ACTION_EDIT', response.data.errors)
			}
			else if (response.data.success !== undefined) {
				state.dispatch('getActions')
				state.dispatch('getAllActions')
				// if (data.route.name == 'profilAction') {
				// 	state.dispatch('getAction', data.route.params.id)
				// }
				$('#editActionData').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'success',
				  title: response.data.success,
				  showConfirmButton: false,
				  timer: 2000
				})
			}
			
		})  
		.catch(err =>{
			if (err.response.status == 403) {
				$('#editActionData').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'warning',
				  title: "Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				
			}
		})     
	},

	
}


export default uvar_action_a