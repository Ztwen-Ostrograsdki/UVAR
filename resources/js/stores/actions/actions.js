import auth_a from './auth.js'
import users_a from './user.js'
import members_a from './member.js'
import uvar_action_a from './uvar_action.js'
import product_a from './product.js'
import category_a from './category.js'


const default_actions = {
	
	
}

const actions = {
	...users_a, ...default_actions, ...members_a, ...auth_a, ...uvar_action_a, ...product_a, ...category_a
}

export default actions