import Swal from 'sweetalert2'
const product_a = {
	getProducts: (state) => {
		axios.get('/Uvar/administration/products&get&data/now')
			.then(response => {
				state.commit('GET_PRODUCTS', {products: response.data.products})
			})    
	},

	createProduct: (state, data) => {
		axios.post('/Uvar/administration', {
			
		})
		.then(response => {
			state.commit('GET_PRODUCTS', {products: response.data.products})
		})    
	},

	
}


export default product_a