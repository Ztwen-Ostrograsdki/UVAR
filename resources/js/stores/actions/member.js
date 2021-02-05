import Swal from 'sweetalert2'
const members_a = {
	getMembers: (state) => {
		axios.get('/Uvar/administration/members&get&data/now')
			.then(response => {
				state.commit('GET_MEMBERS', {members: response.data.members})
			})    
	},
	getMember: (state, id) => {
		axios.get('/Uvar/administration/get&a&member/profil/id=' + id)
			.then(response => {
				state.commit('GET_MEMBER', response.data)
			})    
	},

	createMember: (state, data) => {
		axios.post('/Uvar/administration', {
			name: data.name,
			name: data.name,
			name: data.name,
			name: data.name,
		})
		.then(response => {
			state.commit('GET_MEMBERS', {members: response.data.members})
		})    
	},

	affiliate: (state, data) =>{
		axios.post('/Uvar/membre/affiliation/ID=' +  data.member.IDENTIFY, {
			email: data.email,
		})
		.then(response => {
			// state.commit('GET_MEMBERS', {members: response.data.members})
			if (response.data.success !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: "Votre demande d'affiliation a bien été effectué. Vous recevrerez un email de confirmation",
				  showConfirmButton: false,
				})
				state.dispatch('getNotifications')
			}
			else if (response.data.errors !== undefined) {
				state.commit('RESET_AFFILIATION_INVALIDS', {status: true, msg: response.data.errors})
				Swal.fire({
				  icon: 'warning',
				  title: 'AFFILIATION ECHOUEE',
				  text: response.data.errors,
				  showConfirmButton: false,
				})
			}
		})  
	}

}


export default members_a