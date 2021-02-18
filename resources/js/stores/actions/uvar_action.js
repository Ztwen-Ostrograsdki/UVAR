import Swal from 'sweetalert2'
const uvar_action_a = {
	getActions: (state) => {
		axios.post('/Uvar/administration/actions&get&data/now', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_ACTIONS', {
					actions: response.data.actions,
					totalBoughtByAction: response.data.totalBoughtByAction,
					boughtedActions: response.data.boughtedActions,
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
			.finally(() => state.commit('RESET_ACTIONS_LOADING', true))  
	},
	getAction: (state, id) => {
		axios.post('/Uvar/administration/get&action&data&/target/id=' + id, 
			{
				headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
			})
			.then(response => {
				state.commit('GET_ACTION', {
					action: response.data.action,
					buyers: response.data.buyers,
					totalBought: response.data.totalBought,
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
			.finally(() => state.commit('RESET_ACTION_LOADING', true))  
	},
	getAllActions: (state) => {
		axios.post('/boutique/q=actions', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_ALL_ACTIONS', {
						actions: response.data.actions,
				})
				state.commit('GET_ACTIONS_DETAILS', {
						lastAction: {action: response.data.actionsDetails.lastAction, totalBought: response.data.actionsDetails.lastTotalBought},
						bestAction: {action: response.data.actionsDetails.bestAction, totalBought: response.data.actionsDetails.bestTotalBought},
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
			.finally(() => state.commit('RESET_ACTIONS_LOADING', true))  
	},
	getAllActionsOnlyAPart: (state) => {
		axios.post('/boutique/q=actions/length', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
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
		axios.post('/Uvar/administration/tag/actions/',
		{
			image: data.action.image,
			name: data.action.action.name,
			description: data.action.action.description,
			price: data.action.action.price,
			total: data.action.action.total,
		},
		{
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
		})
		.then(response => {
			if (response.data.errors !== undefined) {
				state.commit('RESET_NEW_ACTION_INVALIDS', response.data.errors)
			}
			// state.commit('GET_ACTIONS', {actions: response.data.actions})
			else if (response.data.success !== undefined) {
				$('#createAction').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'success',
				  title: "Créaction d'une nouvelle action",
				  text: response.data.success,
				  showConfirmButton: false,
				})
				state.dispatch('getActions')
				state.dispatch('getAllActions')
			}
		})    
		.catch(err =>{
			if (err.response.status == 403) {
				$('#createAction').modal('hide')
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
	updateAction: (state, data) => {
		axios.put('/Uvar/administration/tag/actions/' + data.action.action.id, {
			image: data.action.image,
			name: data.action.action.name,
			description: data.action.action.description,
			price: data.action.action.price,
			total: data.action.action.total,
		}, 
		{
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
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