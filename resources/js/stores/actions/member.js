const members_a = {
	getMembers: (state) => {
		axios.get('/Uvar/administration/members&get&data/now')
			.then(response => {
				state.commit('GET_MEMBERS', {members: response.data.members})
			})    
	},

	createMember: (state, data) => {
		axios.post('/Uvar/administration', {
			name: data.name,
			name: data.name,
			name: data.name,
			name: data.name,
		})
		.then(response => {
			state.commit('GET_MEMBERS', {members: response.data.members})
		})    
	},

}


export default members_a