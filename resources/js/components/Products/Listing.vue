<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white d-inline">La Boutique</h3>
            <span data-toggle="modal" data-target="#createProduct" class="btn btn-primary px-2 m-0 float-right mx-2">Nouvel article</span>
                <span v-if="isLoadedProducts" class="btn btn-secondary px-2 m-0 float-right" @click="toggleShowingProduct()">{{oldsProducts ? "Les articles sur le marché" : "Archive des articles déjà retirés/vendus" }}</span>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedProducts && products.length < 1">
                <h5 class="bg-official text-white p-2 w-100 ">
                    OOops la boutique est vide
                </h5>
            </div>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedProducts">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des articles UVAR en cours...', 1000, 'Veuillez patienter....', 1000]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <table class="table table-official text-white mt-3" v-if="isLoadedProducts && !oldsProducts">
                <thead class="text-center">
                    <th>No</th>
                    <th>Nom</th>
                    <th>Actionnaire</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Vendues</th>
                    <th>Restantes</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(product, k) in products">
                        <td class="text-center">{{ k + 1 > 9 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>
                            <router-link :to="{name: 'productProfil', params: {id: product.id}}"   class="card-link d-inline-block text-white" >
                                <span  class="w-100 d-inline-block link-profiler">
                                    {{product.name}}
                                </span>
                            </router-link>
                            <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editProduct" @click="setEditingProduct(product)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                        </td>
                        <td class="text-center">{{ 'UVAR' }}</td>
                        <td class="text-center">{{ toARcoins(product.price) + ' AR' }}</td>
                        <td class="text-center">{{ product.total }}</td>
                        <td class="text-center">{{ getTotalBought(product.id) }}</td>
                        <td class="text-center">{{ product.total - getTotalBought(product.id) }}</td>
                        <td class="text-center">
                            <span class="fa fa-lock mr-1 p-2 cursor text-warning" :title="'Archiver' + product.name " ></span>
                            <span @click="deleteProduct(product)" class="fa fa-trash-o p-2 cursor text-danger" :title="'Supprimer' + product.name "></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="w-100 mx-auto mt-3" v-if="oldsProducts">
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="boughtedProducts.length < 1">
                    <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                        OOops aucun article dans les archives
                    </h5>
                </div>
                <table class="table table-official text-white" v-if="boughtedProducts.length > 0">
                    <thead class="text-center">
                        <th>No</th>
                        <th>Nom</th>
                        <th>Actionnaire</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Vendues</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(product, k) in boughtedProducts">
                            <td class="text-center">{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                            <td>{{ product.name }}</td>
                            <td class="text-center">{{ 'UVAR'}}</td>
                            <td class="text-center">{{ toARcoins(product.price) + ' AR' }}</td>
                            <td class="text-center">{{ product.total }}</td>
                            <td class="text-center">{{ getTotalBought(product.id) }}</td>
                            <td class="text-center">
                                <span class="fa fa-lock p-2 mr-1 cursor text-warning" :title="'Bloquer' + product.name " ></span>
                                <span @click="deleteProduct(product)" class="p-2 fa fa-trash-o  cursor text-danger" :title="'Supprimer' + product.name "></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
    </div>
</template>

<script>
    import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                oldsProducts: false,
                deletingProduct: {},
            }   
        },
        
        created(){
            this.$store.dispatch('getProducts')
           if (this.connected && this.user && this.user.role == 'admin') {
                this.$store.dispatch('getProducts')
           }

        },
        methods :{

            toggleShowingProduct(){
                this.oldsProducts = !this.oldsProducts
            },
            setEditingProduct(product){
                this.$store.commit('RESET_TARGETED_PRODUCT', product)
                this.$store.commit('RESET_EDITING_PRODUCT', product)
            },

            getTotalBought(product_id){
                let table = this.totalBoughtByProduct
                return table[product_id] !== undefined  ? table[product_id] : 'inconnue'
            },

            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            deleteProduct(product){
                this.deletingProduct = product
               
                Swal.fire({
                  title: "Suppression d'article",
                  text: "Voulez-vous vraiment supprimer l'article " + product.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Supprimer',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Suppression de l'article " + this.deletingProduct.name,
                            text: 'Opération en cours veuillez patienter...',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Lancer',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return fetch('/Uvar/administration/tag/produits/' + this.deletingProduct.id,{
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(response => {
                                        if (response.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Suppression échouée',
                                                text: response.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.success !== undefined) {
                                                this.$store.dispatch('getAllProducts')
                                                this.$store.dispatch('getProducts')
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: "Opération réussie! L'article " + this.deletingProduct.name + " a bien été envoyée dans la corbeille",
                                                    showConfirmButton: true,
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                        .then((response) => {
                            if (response.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    text: "Opération réussie! ",
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                })
            }

           
            
        },

        computed: mapState([
            'products', 'members', 'totalBoughtByProduct', 'token', 'connected', 'user', 'active_member', 'isLoadedProducts', 'boughtedProducts'
        ])
    }
</script>
<style>
  
</style>