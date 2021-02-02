import Swal from 'sweetalert2'
const category_a = {
	getCategories: (state) => {
		axios.get('/Uvar/administration/categories&get&data/now')
			.then(response => {
				state.commit('GET_CATEGORIES', {categories: response.data.categories})
			})    
	},

	createCategory: (state, data) => {
		axios.post('/Uvar/administration', {
			
		})
		.then(response => {
			state.commit('GET_CATEGORIES', {categories: response.data.categories})
		})    
	},

	
}


export default category_a