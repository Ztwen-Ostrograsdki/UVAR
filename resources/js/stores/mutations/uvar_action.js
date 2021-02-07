const uvar_action_m = {

    GET_ACTIONS: (state, data) => {
        state.actions = data.actions
        state.totalBoughtByAction = data.totalBoughtByAction
    },
     GET_ALL_ACTIONS: (state, data) => {
        state.allActions = data.actions
    },
    RESET_NEW_ACTION :(state, data) =>{
    	state.newAction = {

    	}
    },
    RESET_NEW_ACTION_INVALIDS: (state, data) =>{
        state.newActionInvalids = data
    },
    RESET_TARGETED_ACTION: (state, data) =>{
        state.targetAction = data
    },

    
}

export default uvar_action_m