import auth_a from './auth.js'
import users_a from './user.js'
import members_a from './member.js'


const default_actions = {
	
	
}

const actions = {
	...users_a, ...default_actions, ...members_a, ...auth_a
}

export default actions