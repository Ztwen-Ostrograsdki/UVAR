import Swal from 'sweetalert2'
const category_a = {
	getCategories: (state) => {
		axios.get('/Uvar/administration/categories&get&data/now', 
			{
        		headers: {
        			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
		        }
		    })
			.then(response => {
				state.commit('GET_CATEGORIES', {categories: response.data.categories})
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

	createCategory: (state, data) => {
		axios.post('/Uvar/administration', {
			
		}, 
		{
    		headers: {
    			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
	        }
	    })
		.then(response => {
			state.commit('GET_CATEGORIES', {categories: response.data.categories})
		})   
	},

	
}


export default category_a