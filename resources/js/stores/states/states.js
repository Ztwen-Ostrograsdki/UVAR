import user_s from './user.js'
import member_s from './member.js'
import auth_s from './auth.js'
import uvar_action_s from './uvar_action.js'
import product_s from './product.js'
import category_s from './category.js'

const default_states = {
    

}

const states = {
	...user_s, ...default_states, ...member_s, ...auth_s, ...uvar_action_s, ...product_s, ...category_s
}

export default states