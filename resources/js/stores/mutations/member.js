const auth_mutations = {

    GET_MEMBERS: (state, data) => {
        state.members = data.members
    },
    GET_MEMBER: (state, data) => {
        state.member = data.member
    },
    RESET_NEW_REFEREE :(state, data) =>{
    	state.newReferee = {email: data}
    },
    RESET_AFFILIATION_INVALIDS: (state, data) =>{
        state.affiliationsInvalids = data
    },
    RESET_MEMBER: (state, data) =>{
		state.member = {status: data.status, member: data.member}
	},
    
}

export default auth_mutations