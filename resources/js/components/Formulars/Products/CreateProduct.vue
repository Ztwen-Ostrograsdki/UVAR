<template>
	<div class="createProduct">
	<div class="modal fade" id="createProduct" tabindex="-1" role="dialog" aria-labelledby="CreateProductModal">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-white">Creation d'un nouvel article <span class="text-warning">{{newProduct.name}}</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="invalidsNewProduct.name !== undefined ? 'is-invalid' : '' " v-model="newProduct.name" placeholder="Le nom de l'article" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsNewProduct.name !== undefined">{{ invalidsNewProduct.name[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between px-3">
                        <div style="width: 45%">
                            <input autocomplete="price"  class="form-control" :class="invalidsNewProduct.price !== undefined ? 'is-invalid' : '' " v-model="newProduct.price" placeholder="Le prix de l'article" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsNewProduct.price !== undefined">{{ invalidsNewProduct.price[0] }}</i>
                        </div>
                        <div style="width: 51%">
                            <input autocomplete="total"  class="form-control" :class="invalidsNewProduct.total !== undefined ? 'is-invalid' : '' " v-model="newProduct.total" placeholder="La quantité de l'article à mettre sur le marché" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsNewProduct.total !== undefined">{{ invalidsNewProduct.total[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" :class="invalidsNewProduct.description !== undefined ? 'is-invalid' : '' " v-model="newProduct.description" placeholder="Décrivez cet article en quelques lignes...">
                            
                            </textarea>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsNewProduct.description !== undefined">{{ invalidsNewProduct.description[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input @change="imageChanged" class="form-control custom-file pb-3" type="file">
                        </div>
                    </div>
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="createProduct()">
                                Mettre à jour
                            </button>
                            <button @click="cancelImage()" type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                                Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>

	</div>
</template>
<script>
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                theProduct: {
                    image: '',
                    product: {},
                    route: ''
                }
            }
        },
        
        created(){
           // this.$store.dispatch('getMember', this.$route.params.id)
        },
        methods :{

            imageChanged(e){
                this.theProduct.image = ''
                this.theProduct.route = ''
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])
                fileReader.onload = (e) =>{
                    this.theProduct.image = e.target.result
                }
            },
            
           createProduct(){
                this.theProduct.product = this.newProduct
                this.theProduct.route = this.$route
                this.$store.commit('RESET_NEW_PRODUCT_INVALIDS', {})
                this.$store.dispatch('createProduct', {product: this.theProduct})
           },
           cancelImage(){
                this.actionPhoto.image = ''
           }
            
        },

        computed: mapState([
            'user', 'member', 'active_member', 'connected', 'invalidsNewProduct', 'newProduct', 
        ])
    }
</script>









<style>
    .loginer input.form-control{
        
    }

    .customer-box .tab-content .form-group .form-control, .loginer select{
        height: 40px !important;
        padding: 3px !important;
        font-size: 1.1rem !important;
        margin: 0 !important;
        color: black !important;
    }
</style>