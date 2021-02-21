<template>
<div class="w-100 p-0 m-0">
    <home-caroussel></home-caroussel>
    <div class="w-100 mx-auto d-flex justify-content-center flex-column">
        <transition name="scalefade" appear>
            <div class="w-75 mx-auto my-2 py-2 d-flex justify-content-center">
                <span class="btn btn-primary border-white px-3 px-lg-5 mr-1" @click="toggleDisplay('actions')">Les Actions disponibles</span>
                <span class="fa cursor fa-refresh text-warning fa-2x mx-2 mt-1" title="Afficher d'autres" @click="getOthers"></span>
                <span class="btn btn-primary border-white px-3 px-lg-5 ml-1" @click="toggleDisplay('products')">Les Articles disponibles</span>
            </div>
        </transition>
        <div class="w-95 mx-auto oneProperty mt-2" v-if="onActions">
            <div class="w-100 d-flex justify-content-start mb-0 mt-2">
                <h5 class="text-official p-0 m-0 mb-1"><span class="fa-2x">Les Actions UVAR à la une</span>
                    <span v-if="isLoadedSelectedActions && selectedActions.length > 0" class="text-white-50 ml-2">
                        (Plus de centaines d'actions vendues chaque semaines sur UVAR)
                    </span>
                </h5>

            </div>
            <transition name="bodyfade" appear>
                <div class="app mx-auto w-100 text-white text-center my-3" v-if="!isLoadedSelectedActions">
                    <typical
                        class="vt-title"
                        :steps="['Chargement des actions en cours...', 1000, 'Veuillez patienter....', 1000]"
                        :wrapper="'h2'"
                      ></typical>
                </div>
            </transition>
            <transition name="scalefade" appear>
            <div class="row w-100 mx-auto mt-2" v-if="isLoadedSelectedActions && selectedActions.length > 0">
                <div class="col-12 border my-1 row m-0 p-0" v-for="action in selectedActions">
                    <div class="w-100 mx-auto d-flex justify-content-between p-0">
                        <div class="w-25 p-0 float-left" style="height: auto !important;">
                            <div class="w-100 p-0 m-0 float-left h-100">
                                <img class="p-0 m-0 float-left w-100 h-100" src="/photo/ph2.jpg">
                            </div>
                        </div>
                        <div class="w-75">
                            <div class="w-100 mx-auto">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official p-0 m-0 mb-1">{{ action.action.name }}</h4> 
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(action.action.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(action.action.price).toAr }}</span>
                                            <span v-if="!connected || !active_member || !active_member.id" class="m-0 float-right mr-2 btn btn-primary border-official">Inscrivez-vous pour acheter cette action</span>
                                            <i class="ml-2 text-white-50">({{action.totalBought}}) achétées</i>
                                            <i class="ml-2 text-danger">({{ action.action.total - action.totalBought}}) restantes</i>
                                            <span v-if="connected && active_member && active_member.id" @click="buyAction(action.action, active_member)" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cette action</span>
                                        </h4>
                                        <p class="m-0 p-0 mt-1 w-100 float-right text-warning">
                                            {{ action.bought ? 'Cette action n\'est plus disponible sur le marché' :'Cette action est disponible sur le marché'}}
                                        </p>
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{action.action.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                            Mise sur le marché dépuis le : {{  getCreatedAt(action.action.created_at) }}
                                        </span>
                                        <span class="d-inline-block text-white-50 float-right text-white-50">
                                            Actionnaire : {{ action.action.actionnary == null ? 'UVAR' : action.action.actionnary }}
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </transition>
        </div>
        <div class="w-95 mx-auto oneProperty mt-2" v-if="onProducts">
            <div class="w-100 d-flex justify-content-start mb-0 mt-2">
                <h5 class="text-official p-0 m-0 mb-1"><span class="fa-2x">Bienvenue à la boutique UVAR</span>
                    <span v-if="isLoadedSelectedProducts && selectedProducts.length > 0" class="text-white-50 ml-2">
                        (Plus de centaines d'articles vendus chaque semaines sur UVAR)
                    </span>
                </h5>

            </div>
            <transition name="bodyfade" appear>
                <div class=" app mx-auto w-100 text-white text-center my-3" v-if="!isLoadedSelectedProducts">
                    <typical
                        class="vt-title"
                        :steps="['Chargement des actions en cours...', 1000, 'Veuillez patienter....', 1000]"
                        :wrapper="'h2'"
                      ></typical>
                </div>
            </transition>
            <transition name="scalefade" appear>
                <div class="row w-100 mx-auto mt-2" v-if="isLoadedSelectedProducts && selectedProducts.length > 0">
                    <div class="w-100 mx-auto d-flex justify-content-between p-0">
                        <div class="row w-100 mx-auto mt-2" v-if="isLoadedSelectedProducts">
                            <div class="col-12 border my-1 row m-0 p-0" v-for="product in selectedProducts">
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
                                                        <span v-if="connected && user" @click="buyProduct(product.product, user)" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cet article</span>
                                                        <span v-if="!connected || !user" class="m-0 float-right mr-2 btn btn-primary border-official">Connectez-vous pour acheter cet article</span>
                                                    </h4>
                                                    <p class="m-0 p-0 mt-1 w-100 float-right text-warning">
                                                        {{ product.bought ? 'Cet article n\'est plus disponible sur le marché' : 'Cet article est disponible sur le marché'}}
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
            </transition>
        </div>
        <div class="section cl w-95 shadow p-0 py-3 pb-5 mx-auto border border-white my-2">
            <home-counter></home-counter>
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
                onActions : false,
                onProducts : true,
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
            this.$store.dispatch('getSelected')
        },

        computed: {
            
        },
        methods :{
            getOthers(){
                this.$store.dispatch('getSelected')
            },

            getProfilPath(images){
                let path = ''
                if (images.length > 0) {
                    let name = images[0].name
                    path = name
                }

                return path

            },

            buyAction(action, member){
                if (!navigator.onLine) {
                    Swal.fire({
                        icon: 'warning',
                        title: "Erreur de connexion à internet",
                        showConfirmButton: false,
                    })
                    return false
                }
                let token = this.token
                this.total = 0
                Swal.fire({
                    title: "Achat de l'action " + action.name,
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: "Veuillez renseiller la quantité d'actions"
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Acheter',
                    cancelButtonText: 'Annuler',
                    showLoaderOnConfirm: true,
                    preConfirm: (total) => {
                        this.total = total
                        return fetch('/Uvar/administration/boutique/action/q=achat/a='+ action.id + '/m=' + member.id + '/t=' + total,{
                                method: 'PUT',
                                headers: {
                                    'X-CSRF-TOKEN': token,
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
                                        this.$store.dispatch('getMember', member.id)
                                        this.$store.dispatch('getRequests')
                                        this.$store.dispatch('getAllActions')
                                        Swal.fire({
                                            icon: 'success',
                                            text: "Opération réussie! Pour entrer en Possession des actions veuillez faire un dépot de " + (Number(this.total) * action.price) + " FCFA sur le numero de la plateforme.",
                                            showConfirmButton: true,
                                        })
                                    }
                                }
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Echec: ${error}`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                .then((response) => {
                    if (response.isConfirmed) {
                        this.$store.dispatch('getMember', member.id)
                        this.$store.dispatch('getRequests')
                        this.$store.dispatch('getAllActions')
                        Swal.fire({
                            icon: 'success',
                            text: "Opération réussie! Pour entrer en Possession des actions veuillez faire un dépot de " + (Number(this.total) * action.price) + " FCFA sur le numero de la plateforme.",
                            showConfirmButton: true,
                        })
                    }
                })
            },
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
                                        this.$store.dispatch('getRequests')
                                        this.$store.dispatch('getselectedProducts')
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
                                    `Echec: ${error}`
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
            toggleDisplay(tag){
                if (tag == "actions") {
                    this.onActions = true
                    this.onProducts = false
                }
                else if (tag == "products") {
                    this.onActions = false
                    this.onProducts = true
                }
                
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
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetAction', 'selectedProducts', 'selectedActions', 'active_member', 'isLoadedSelectedActions', 'isLoadedSelectedProducts'
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



<!-- <template> -->
    
        <!-- <div id="overviews" class="section lb a_la_une w-100"> -->
            <!-- <a-la-une></a-la-une> -->
        <!-- </div> -->
        <!-- section class="page-section">
            <horizontal-home-caroussel></horizontal-home-caroussel>
        </section> -->
        <!-- <div class="section cl w-95 shadow p-0 py-3 pb-5 mx-auto border border-white my-2"> -->
            <!-- <home-counter></home-counter> -->
        <!-- </div> -->

<!--    </div>
</template> -->