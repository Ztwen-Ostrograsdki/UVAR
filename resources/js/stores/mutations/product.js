const product_m = {

    GET_PRODUCTS: (state, data) => {
        state.products = data.products
    },
    RESET_NEW_PRODUCT :(state, data) =>{
    	state.newProduct = {

    	}
    },
    RESET_NEW_PRODUCT_INVALIDS: (state, data) =>{
        state.newProductInvalids = data
    },
    GET_ALL_PRODUCTS: (state, data) =>{
        state.allProducts = data.products
    },
    GET_ALL_PRODUCTS_ONLY_A_PART: (state, data) =>{
        state.allProductsOnlyAPart = data.products
    }
    
}

export default product_m