<template>
	<div class="editProduct">
	<div class="modal fade" id="editProduct" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 v-if="targetedProduct" class="modal-title text-white">Edition de l'article <span class="text-warning">{{targetedProduct.name}}</span></h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="invalidsEditProduct.name !== undefined ? 'is-invalid' : '' " v-model="editingProduct.name" placeholder="Le nom de l'article" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditProduct.name !== undefined">{{ invalidsEditProduct.name[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group d-flex justify-content-between px-3">
                        <div style="width: 45%">
                            <input autocomplete="price"  class="form-control" :class="invalidsEditProduct.price !== undefined ? 'is-invalid' : '' " v-model="editingProduct.price" placeholder="Le prix de l'article" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditProduct.price !== undefined">{{ invalidsEditProduct.price[0] }}</i>
                        </div>
                        <div style="width: 51%">
                            <input autocomplete="total"  class="form-control" :class="invalidsEditProduct.total !== undefined ? 'is-invalid' : '' " v-model="editingProduct.total" placeholder="La quantité de l'article" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditProduct.total !== undefined">{{ invalidsEditProduct.total[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <textarea class="form-control" :class="invalidsEditProduct.description !== undefined ? 'is-invalid' : '' " v-model="editingProduct.description" placeholder="Décrivez">
                            
                            </textarea>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsEditProduct.description !== undefined">{{ invalidsEditProduct.description[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input @change="imageChanged" class="form-control custom-file pb-3" type="file">
                        </div>
                    </div>
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="updateProduct()">
                                Mettre à jour
                            </button>
                            <button @click="cancelImage()" type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                                Avorter</button>
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
                productPhoto: {
                    image: '',
                    product: {},
                    route: ''
                }
            }
        },
        
        created(){
            
        },
        methods :{

            imageChanged(e){
                this.productPhoto.image = ''
                this.productPhoto.route = ''
                let fileReader = new FileReader()
                fileReader.readAsDataURL(e.target.files[0])
                fileReader.onload = (e) =>{
                    this.productPhoto.image = e.target.result
                }
            },
            
           updateProduct(){
                this.productPhoto.product = this.editingProduct
                this.productPhoto.route = this.$route
                this.$store.commit('RESET_INVALIDS_PRODUCT_EDIT', {})
                this.$store.dispatch('updateProduct', {product: this.productPhoto})
           },
           cancelImage(){
                this.actionPhoto.image = ''
           }
            
        },

        computed: mapState([
            'user', 'member', 'active_member', 'connected', 'invalidsEditProduct', 'editingProduct', 'targetedProduct'
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