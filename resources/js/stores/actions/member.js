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
				state.commit('GET_MEMBER', {member: response.data.member})
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
		axios.post('/Uvar/membre/affiliation/ID=' + 2, {
			email: data.email,
		})
		.then(response => {
			// state.commit('GET_MEMBERS', {members: response.data.members})
			if (response.data.success !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: 'Connexion réussie',
				  showConfirmButton: false,
				  timer: 2000
				})
			}
			else if (response.data.invalids !== undefined) {
				state.commit('RESET_AFFILIATION_INVALIDS', {status: true, msg: response.data.invalids})
				Swal.fire({
				  icon: 'error',
				  title: 'AFFILIATION ECHOUEE',
				  text: "L'adresse ne correspond à aucun utilisateur. Rassurez-vous que l'utilisateur s'est déja enregistré",
				  showConfirmButton: false,
				  timer: 3000,
				  timerProgressBar: true,
				})
			}
		})  
	}

}


export default members_a