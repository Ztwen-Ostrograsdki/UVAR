const product_m = {

    GET_PRODUCTS: (state, data) => {
        state.products = data.products
        state.boughtedProducts = data.boughtedProducts
        state.totalBoughtByProduct = data.totalBoughtByProduct
    },
    RESET_NEW_PRODUCT :(state, data) =>{
        state.newProduct = {

        }
    },
    RESET_NEW_PRODUCT_INVALIDS: (state, data) =>{
        state.invalidsNewProduct = data
    },
    RESET_INVALIDS_PRODUCT_EDIT: (state, data) =>{
        state.invalidsEditProduct = data
    },
    RESET_TARGETED_PRODUCT: (state, data) =>{
        state.targetedProduct = data
    },
    RESET_EDITING_PRODUCT: (state, data) =>{
        state.editingProduct = data
    },
    RESET_NEW_PRODUCT_INVALIDS: (state, data) =>{
        state.invalidsNewProduct = data
    },
    GET_ALL_PRODUCTS: (state, data) =>{
        state.allProducts = data.products
    },
    GET_ALL_PRODUCTS_ONLY_A_PART: (state, data) =>{
        state.allProductsOnlyAPart = data.products
    },
    RESET_PRODUCT_LOADING : (state, status) => {
        state.isLoadedProduct = status
    },
    RESET_PRODUCTS_LOADING : (state, status) => {
        state.isLoadedProducts = status
    },
    
}

export default product_m