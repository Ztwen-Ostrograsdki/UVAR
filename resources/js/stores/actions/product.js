import Swal from 'sweetalert2'
const product_a = {
	getProducts: (state) => {
		axios.get('/Uvar/administration/products&get&data/now', 
				{
	        		headers: {
	        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
			        }
			    }
			)
			.then(response => {
				state.commit('GET_PRODUCTS', {
					products: response.data.products, 
					boughtedProducts: response.data.boughtedProducts,
					totalBoughtByProduct: response.data.totalBoughtByProduct,
				})
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
			.finally(() => state.commit('RESET_PRODUCTS_LOADING', true))  
	},
	getAllProducts: (state) => {
		axios.post('/boutique/q=articles', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_ALL_PRODUCTS', {
						products: response.data.products,
				})
				state.commit('GET_PRODUCTS_DETAILS', {
						lastProduct: {product: response.data.productsDetails.lastProduct, totalBought: response.data.productsDetails.lastTotalBought},
						bestProduct: {product: response.data.productsDetails.bestProduct, totalBought: response.data.productsDetails.bestTotalBought},
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
			.finally(() => state.commit('RESET_PRODUCTS_LOADING', true))    
	},
	getAllProductsOnlyAPart: (state) => {
		axios.post('/boutique/q=articles/length', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
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

	getProduct: (state, id) => {
		axios.post('/Uvar/administration/get&product&data&/target/id=' + id, 
			{
				headers: {
	    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
			})
			.then(response => {
				state.commit('GET_PRODUCT', {
					product: response.data.product,
					buyers: response.data.buyers,
					totalBought: response.data.totalBought,
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
			.finally(() => state.commit('RESET_PRODUCT_LOADING', true))  
	},
	createProduct: (state, data) => {
		axios.post('/Uvar/administration/tag/produits/',
		{
			image: data.product.image,
			name: data.product.product.name,
			description: data.product.product.description,
			price: data.product.product.price,
			total: data.product.product.total,
		},
		{
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
		})
		.then(response => {
			if (response.data.errors !== undefined) {
				state.commit('RESET_NEW_PRODUCT_INVALIDS', response.data.errors)
			}
			else if (response.data.success !== undefined) {
				$('#createProduct').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'success',
				  title: "Créaction d'un nouvel article",
				  text: response.data.success,
				  showConfirmButton: false,
				})
				state.dispatch('getProducts')
				state.dispatch('getAllProducts')
			}
		})    
		.catch(err =>{
			if (err.response.status == 403) {
				$('#createProduct').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'warning',
				  title: "Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				
			}
		})   
	},
	updateProduct: (state, data) => {
		axios.put('/Uvar/administration/tag/produits/' + data.product.product.id,
		{
			image: data.product.image,
			name: data.product.product.name,
			description: data.product.product.description,
			price: data.product.product.price,
			total: data.product.product.total,
		}, 
		{
			headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
		})
		.then(response => {
			if (response.data.errors !== undefined) {
				state.commit('RESET_INVALIDS_PRODUCT_EDIT', response.data.errors)
			}
			else if (response.data.success !== undefined) {
				state.dispatch('getProducts')
				state.dispatch('getAllProducts')
				$('#editProduct').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'success',
				  title: response.data.success,
				  showConfirmButton: false,
				  timer: 2000
				})
			}
			
		})  
		.catch(err =>{
			if (err.response.status == 403) {
				$('#editProduct').modal('hide')
				$('body').removeClass('modal-open')
				$('.modal-backdrop').remove()
				Swal.fire({
				  icon: 'warning',
				  title: "Vous n'êtes pas authorisé",
				  showConfirmButton: false,
				})
				
			}
		})     
	},

	
}


export default product_a