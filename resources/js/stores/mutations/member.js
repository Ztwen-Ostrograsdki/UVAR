const auth_mutations = {

    GET_MEMBERS: (state, data) => {
        state.members = data.members
    },
    GET_MEMBER: (state, data) => {
        state.member = data.member
        state.myActions = data.myActions
        state.myReferer = data.myReferer
        state.myAccount = data.myAccount
        state.myBonuses = data.myBonuses
        state.myProducts = data.myProducts
        state.myReferies = data.myReferies
        state.memberPhoto = data.myImage
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
    RESET_READY_MEMBER: (state, data) => {
        state.memberReady = data
    },
    RESET_INVALIDS_MEMBER_EDIT: (state, data) => {
        state.invalidsEditMember = data
    },
    RESET_EDITING_MEMBER: (state, member) => {
        state.editingMember = member
    },
    RESET_MEMBER_PHOTO: (state, photo) => {
        state.memberPhoto = photo
    },
     RESET_MEMBER_LOADING : (state, status) => {
        state.isLoadedMember = status
    },
    RESET_MEMBERS_LOADING : (state, status) => {
        state.isLoadedMembers = status
    },

    
}

export default auth_mutations