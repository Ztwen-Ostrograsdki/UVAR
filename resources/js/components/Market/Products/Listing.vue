<template>
	<div class="w-100 mx-auto d-flex justify-content-center flex-column">
		<div class="w-95 mx-auto oneProperty mt-2">
            <div class="w-100 d-flex justify-content-start mb-0 mt-2">
                <h5 class="text-official fa-2x p-0 m-0 mb-1 w-100">
                    <span class="">
                        MARCHE UVAR 
                    </span>
                    <span class="float-right text-white-50">
                        <span class="fa">
                            <img class="text-official" src="/icons/graph-5_icon-icons.com_58023.png" width="40">
                        </span>
                        LES ARTICLES               
                    </span>
                </h5>

            </div>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedProducts">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des articles en cours...', 1000, 'Veuillez patienter....', 1000]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <div class="row w-100 mx-auto mt-2" v-if="isLoadedProducts">
                <div class="col-12 border my-1 row m-0 p-0" v-for="product in allProducts">
                    <div class="w-100 mx-auto d-flex justify-content-between p-0">
                        <div class="w-25 p-0 float-left" style="height: auto !important;">
                            <div class="w-100 p-0 m-0 float-left h-100">
                                <img v-if="product.images.length < 1" class="p-0 m-0 float-left w-100 h-100" src="/photo/ph2.jpg">
                                <img v-if="product.images.length > 0" class="p-0 m-0 float-left w-100 h-100" :src="'/images/'+ getProfilPath(product.images)">
                            </div>
                        </div>
                        <div class="w-75">
                            <div class="w-100 mx-auto">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official p-0 m-0 mb-1">
                                            <router-link v-if="user && member && active_member && user.role =='admin'" :to="{name: 'productProfil', params: {id: product.product.id}}"   class="card-link d-inline-block w-100 text-official" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{product.product.name}}
                                                </span>
                                            </router-link>
                                            <span v-if="user && user.role !== 'admin'">
                                                {{product.product.name}}
                                            </span>
                                        </h4>  
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(product.product.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(product.product.price).toAr }}</span>
                                            <i class="ml-2 text-white-50">({{product.totalBought}}) achétés</i>
                                            <i class="ml-2 text-danger">({{ product.product.total - product.totalBought}}) restants</i>
                                            <span @click="buyProduct(product.product, user)" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cet article</span>
                                        </h4>
                                        <p class="m-0 p-0 mt-1 w-100 float-right text-warning">
                                            Cet article est disponible sur le marché
                                        </p>
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{product.product.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                            Mise sur le marché dépuis le : {{  getCreatedAt(product.product.created_at) }}
                                        </span>
                                        <span class="float-right mr-2">
                                            <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editProduct" @click="setEditingProduct(product.product)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                            <span class="d-inline-block text-white-50 float-right text-white-50">
                                             Actionnaire : UVAR
                                            </span>
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		</div>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
	export default {
		props : [],
        data() {
            return {
                isLoaded : false,
            	options : false,
                actions : true,
                shop : true,
                total: 0,
                referies : true,
                selfMonths : [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"

                ],
            }
                
        },
		
        created(){
            this.$store.dispatch('getAllProducts')
        	this.$store.dispatch('getAllActions')
        },
        
        methods :{

            buyProduct(product, user){
                if (!navigator.onLine) {
                    Swal.fire({
                        icon: 'warning',
                        title: "Erreur de connexion à internet",
                        showConfirmButton: false,
                    })
                    return false
                }
                this.total = 0
                Swal.fire({
                    title: "Achat de l'article " + product.name,
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: "Veuillez renseiller la quantité de cet article à acheter"
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Acheter',
                    cancelButtonText: 'Annuler',
                    showLoaderOnConfirm: true,
                    preConfirm: (total) => {
                        this.total = total
                        return fetch('/Uvar/administration/boutique/product/q=achat/p='+ product.id + '/u=' + user.id + '/t=' + total,{
                                method: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                                },
                            })
                            .then(response => response.json())
                            .then(response => {
                                if (response.errors !== undefined) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.errors,
                                        showConfirmButton: false,
                                    })
                                }
                                else{
                                    if (response.success !== undefined) {
                                        this.$store.dispatch('getAllProducts')
                                        Swal.fire({
                                            icon: 'success',
                                            text: "Opération réussie! Pour entrer en Possession des articles veuillez faire un dépot de " + (Number(this.total) * product.price) + " FCFA sur le numero de la plateforme.",
                                            showConfirmButton: true,
                                        })
                                    }
                                }
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Echec: Ohhh, une erreure est survenue`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
            },
        	getCreatedAt(created_at){
                if (created_at !== null) {
                    let date = created_at
                        let parts = (date.split("-"))
                        let year = parts[0]
                        let month = parts[1]
                        let day = parts[2].substring(0, 2)
                        let times = ((parts[2].split('T'))[1]).split(':')
                        let hour = times[0] + 'H'
                        let min = times[1] + "'"

                        
                        month = Number(month) - 1

                        return day + " " + this.selfMonths[month] + " " + year + " à " + hour +  " " + min
                }
                else{
                    return "inconnue"
                }

            },
            getProfilPath(images){
                let path = ''
                if (images.length > 0) {
                    let name = images[0].name
                    path = name
                }

                return path

            },
            getLeveler(level){
                level = level.replace('-', '_')
                return this.levels[level]
            },
            getPrice(price){
                let solde = Number(price)
                return {toFrancs: new Intl.NumberFormat().format(solde) + " FCFA", toAr: new Intl.NumberFormat().format(this.toARcoins(solde)) + " AR"}
            },
            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            setEditingProduct(product){
                this.$store.commit('RESET_TARGETED_PRODUCT', product)
                this.$store.commit('RESET_EDITING_PRODUCT', product)
            }
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetedProduct', 'products', 'allProducts', 'editingProduct', 'active_member', 'isLoadedProducts'
        ])
	}
</script>
<style>
	.table-propertises table tr td{
        margin: 2px 0px 2px 0px;
        padding: 3px 0 3px 0px;
    }

    .table-propertises table tr{
        padding: 2px !important;
    }
</style>