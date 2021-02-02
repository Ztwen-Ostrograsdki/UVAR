const uvar_action_m = {

    GET_ACTIONS: (state, data) => {
        state.actions = data.actions
        state.totalBoughtByAction = data.totalBoughtByAction
    },
    RESET_NEW_ACTION :(state, data) =>{
    	state.newAction = {

    	}
    },
    RESET_NEW_ACTION_INVALIDS: (state, data) =>{
        state.newActionInvalids = data
    },
    
}

export default uvar_action_m