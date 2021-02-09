const uvar_action_m = {

    GET_ACTIONS: (state, data) => {
        state.actions = data.actions
        state.totalBoughtByAction = data.totalBoughtByAction
    },
        GET_ACTION: (state, data) => {
        state.action = data.action
    },
     GET_ALL_ACTIONS: (state, data) => {
        state.allActions = data.actions
    },
    GET_ALL_ACTIONS_ONLY_A_PART: (state, data) => {
        state.allActionsOnlyAPart = data.actions
    },
    RESET_NEW_ACTION :(state, data) =>{
    	state.newAction = {

    	}
    },
    RESET_NEW_ACTION_INVALIDS: (state, data) =>{
        state.newActionInvalids = data
    },
    RESET_INVALIDS_ACTION_EDIT: (state, data) =>{
        state.newActionInvalids = data
    },
    RESET_TARGETED_ACTION: (state, data) =>{
        state.targetedAction = data
    },
    RESET_EDITING_ACTION: (state, data) =>{
        state.editingAction = data
    },

    
}

export default uvar_action_m