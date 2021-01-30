import user_s from './user.js'
import members_s from './member.js'

const default_states = {
    invalids: {},
    login: false,
    member: {status: false, member: {}},
    user: {status: false, user: {}},

}

const states = {
	...user_s, ...default_states, ...members_s
}

export default states