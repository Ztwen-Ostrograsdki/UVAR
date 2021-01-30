const auth_mutations = {

    GET_MEMBERS: (state, data) => {
        state.members = data.members
    },
    RESET_NEW_REFEREE :(state, data) =>{
    	state.newReferee = {email: data}
    }
    
}

export default auth_mutations