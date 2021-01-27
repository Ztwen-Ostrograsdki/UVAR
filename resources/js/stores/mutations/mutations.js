import auth_mutations from './authMutations.js'

const default_mutations = {

	
}

const mutations = {
	 ...auth_mutations, ...default_mutations
}

export default mutations