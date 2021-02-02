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