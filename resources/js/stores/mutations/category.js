const category_m = {

    GET_CATEGORIES: (state, data) => {
        state.categories = data.categories
    },
    RESET_NEW_CATEGORY :(state, data) =>{
    	state.newProduct = {

    	}
    },
    RESET_NEW_CATEGORY_INVALIDS: (state, data) =>{
        state.newCategoryInvalids = data
    },
    
}

export default category_m