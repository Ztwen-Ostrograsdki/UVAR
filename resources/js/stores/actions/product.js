import Swal from 'sweetalert2'
const product_a = {
	getProducts: (state) => {
		axios.get('/Uvar/administration/products&get&data/now')
			.then(response => {
				state.commit('GET_PRODUCTS', {products: response.data.products})
			})   
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Erreure connexion: Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
			})   
	},
	getAllProducts: (state) => {
		axios.post('/boutique/q=articles')
			.then(response => {
				state.commit('GET_ALL_PRODUCTS', {
						products: response.data.products,
				})
			})
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
			})   
	},
	getAllProductsOnlyAPart: (state) => {
		axios.post('/boutique/q=articles/length')
			.then(response => {
				state.commit('GET_ALL_PRODUCTS_ONLY_A_PART', {
						products: response.data.products,
				})
			})
			.catch(err =>{
				if (err.response.status == 401) {
					Swal.fire({
					  icon: 'warning',
					  title: "Vous n'êtes pas authorisé",
					  showConfirmButton: false,
					})
					window.location = '/'
				}
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