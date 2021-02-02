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
    
}

export default product_m