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
	getAllActions: (state) => {
		axios.post('/boutique/q=actions')
			.then(response => {
				console.log(response.data)
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

	createAction: (state, data) => {
		axios.post('/Uvar/administration', {
			
		})
		.then(response => {
			state.commit('GET_ACTIONS', {actions: response.data.actions})
		})    
	},

	
}


export default uvar_action_a