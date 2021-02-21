const uvar_action_s = {
	targetedAction: {},
	editingAction: {},
	isLoadedAction: false,
	isLoadedActions: false,
	isLoadedSelectedActions: false,
	bestAction: {},
	lastAction: {},
	invalidsEditAction: {},
	action: {action: {}, buyers: [], totalBought: 0, last: {}, first: {}},
	selectedActions: [],
	allActions: [],
	actions: [],
	totalBoughtByAction: [],
	boughtedActions: [],
	newAction: {
		name: '',
		description: '',
		total: '',
		price: '',
	},
	invalidsNewAction: {},
}

export default uvar_action_s