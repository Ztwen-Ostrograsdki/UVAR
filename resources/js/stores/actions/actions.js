import auth_actions from './authActions.js'


const default_actions = {
	getCounter: (state) => {
        axios.get('/admin/director/master/get&counter&for&all&data&with&authorization')
			.then(response => {
				state.commit('GET_DATA_LENGTH', response.data)
			})
            
	},
	getTOOLS: (state) => {
        axios.get('/admin/director/master/get&all&data&tools&with&authorization')
			.then(response => {
				state.commit('GET_TOOLS', response.data)
			})      
	},
	
}

const actions = {
	
}

export default actions