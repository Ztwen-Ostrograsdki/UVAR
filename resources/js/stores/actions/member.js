import Swal from 'sweetalert2'
const members_a = {
	getMembers: (state) => {
		axios.get('/Uvar/administration/members&get&data/now')
			.then(response => {
				state.commit('GET_MEMBERS', {members: response.data.members})
			})    
	},
	getMember: (state, id) => {
		state.commit('RESET_READY_MEMBER', false)
		axios.get('/Uvar/administration/get&a&member/profil/id=' + id)
			.then(response => {
				state.commit('GET_MEMBER', response.data)
				state.commit('RESET_READY_MEMBER', true)
			})    
	},

	createMember: (state, data) => {
		axios.post('/Uvar/administration', {
			name: data.name,
		})
		.then(response => {
			state.commit('GET_MEMBERS', {members: response.data.members})
		})    
	},
	updateMemberData: (state, data) => {
		axios.put('/Uvar/administration/tag/membres/' + data.member_id, {
			name: data.name,
			sexe: data.sexe,
			phone: data.phone,
			country: data.country
		})
		.then(response => {
			if (response.data.errors !== undefined) {
				Swal.fire({
				  icon: 'error',
				  title: "Le formulaire est invalide",
				  showConfirmButton: false,
				})
				
				state.commit('RESET_INVALIDS_MEMBER_EDIT', response.data.errors)
			}
			else if (response.data.success !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: response.data.success,
				  showConfirmButton: false,
				  timer: 2000
				})
				state.dispatch('getMembers')
				state.dispatch('getUsers')
				state.dispatch('getMember', data.member_id)
				$('#editMemberData').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				
			}

		})
		.catch(err => {
			Swal.fire({
			  icon: 'warning',
			  title: 'Erreure Serveur',
			  showConfirmButton: false,
			})
		}) 
	},
	updateMemberPhoto: (state, data) => {
		axios.put('/Uvar/administration/update/images/membres/' + data.data.member.id, {
			image: data.data.image,
			headers: {'content-Type': 'multipart/form-data', 'charset': 'UTF8'},
		})
		.then(response => {
			if (response.data.success !== undefined) {
				Swal.fire({
				  icon: 'success',
				  title: response.data.success,
				  showConfirmButton: false,
				  timer: 2000
				})
				state.dispatch('getMembers')
				state.dispatch('getUsers')
				state.dispatch('getMember', data.data.member.id)
				$('#setMemberImage').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				
			}

		})
		.catch(err => {
			Swal.fire({
			  icon: 'warning',
			  title: 'Erreure Serveur',
			  showConfirmButton: false,
			})
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