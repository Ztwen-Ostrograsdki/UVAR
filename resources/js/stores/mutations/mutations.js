import users_m from './user.js'
import members_m from './member.js'

const default_mutations = {
	RESET_INVALIDS: (state, data) =>{
		state.invalids = data
	},
	RESET_MEMBER: (state, data) =>{
		state.member = {status: data.status, member: data.member}
	},
	RESET_USER: (state, data) =>{
		state.user = {status: data.status, user: data.user}
	},


	
}

const mutations = {
	 ...users_m, ...default_mutations, ...members_m
}

export default mutations