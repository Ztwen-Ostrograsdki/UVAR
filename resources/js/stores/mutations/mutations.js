import users_m from './user.js'
import members_m from './member.js'
import auth_m from './auth.js'
import uvar_action_m from './uvar_action.js'
import product_m from './product.js'
import category_m from './category.js'

const default_mutations = {
	
	
}

const mutations = {
	 ...users_m, ...default_mutations, ...members_m, ...auth_m, ...uvar_action_m, ...product_m, ...category_m
}

export default mutations