const uvar_action_m = {

    GET_ACTIONS: (state, data) => {
        state.actions = data.actions
        state.totalBoughtByAction = data.totalBoughtByAction
        state.boughtedActions = data.boughtedActions
    },
    GET_ACTION: (state, data) => {
        state.action = data
    },
    GET_SELECTED_ACTIONS: (state, data) => {
        state.selectedActions = data.selectedActions
    },
     GET_ALL_ACTIONS: (state, data) => {
        state.allActions = data.actions 
    },
    RESET_ACTION_LOADING : (state, status) => {
        state.isLoadedAction = status
    },
    RESET_SELECTED_LOADING : (state, status) => {
        state.isLoadedSelectedProducts = status
        state.isLoadedSelectedActions = status
    },
    RESET_ACTIONS_LOADING : (state, status) => {
        state.isLoadedActions = status
    },
    GET_ACTIONS_DETAILS: (state, data) => {
        state.lastAction = data.lastAction
        state.bestAction = data.bestAction
    },
    GET_ALL_ACTIONS_ONLY_A_PART: (state, data) => {
        state.allActionsOnlyAPart = data.actions
    },
    RESET_NEW_ACTION :(state, data) =>{
    	state.newAction = {

    	}
    },
    RESET_NEW_ACTION_INVALIDS: (state, data) =>{
        state.invalidsNewAction = data
    },
    RESET_INVALIDS_ACTION_EDIT: (state, data) =>{
        state.invalidsEditAction = data
    },
    RESET_TARGETED_ACTION: (state, data) =>{
        state.targetedAction = data
    },
    RESET_EDITING_ACTION: (state, data) =>{
        state.editingAction = data
    },

    
}

export default uvar_action_m