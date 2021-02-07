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

	createProduct: (state, data) => {
		axios.post('/Uvar/administration', {
			
		})
		.then(response => {
			state.commit('GET_PRODUCTS', {products: response.data.products})
		})    
	},

	
}


export default product_a