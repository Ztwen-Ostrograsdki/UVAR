<template>
    <div class="w-100 mx-auto">
        <div class="w-100 mx-auto">
        <transition name="bodyfade" appear>
            <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedProduct">
                <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                    <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                      <typical
                        class="vt-title"
                        :steps="['Chargement en cours...', 1000, 'Veuillez patienter', 500]"
                        :wrapper="'h2'"
                      ></typical>
                    </div>
                  </div>
            </div>
        </transition>
         <transition name="bodyfade" appear>
            <div v-if="isLoadedProduct" class="w-95 p-0 mx-auto mt-2 d-flex justify-content-start border" style="background-image:url('/master/images/uvar-font.jpg'); height: 350px;">
                <div class="mx-auto bg-official-opacity w-100 h-100 p-0">
                    <div class="mx-auto w-95 d-flex justify-content-center pt-3">
                        <div class="w-95 border border-white">
                            <div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
                                <h4 class="w-100 m-0 py-2">
                                    <span class="float-left ml-1">Détails de l'article</span>
                                    <span class="text-warning mx-auto mr-2">{{product.product.name}}</span>
                                    <span :title="'Editer l\' article ' + product.product.name" v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editProduct" @click="setEditingProduct(product.product)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                </h4>
                                
                            </div>
                            <div class="w-100 p-1 m-0 d-flex flex-column">
                                <span>
                                    <span class="fa fa-check"></span>
                                    <span> Total : {{product.product.total}}</span>
                                </span>
                                <span>
                                    <span class="fa fa-check"></span>
                                    <span> Vendues : {{product.totalBought}}</span>
                                </span>
                                <span class="mr-2">
                                    <span class="fa fa-check"></span>
                                    <span> Prix : 
                                    <span class="mx-2">{{getPrice(product.product.price).toAr}}</span> || 
                                    <span class="text-secondary mx-2">{{getPrice(product.product.price).toFrancs}}</span>
                                    </span>
                                </span>
                                <span class="w-100 d-flex justify-content-between">
                                    <span class="">
                                        <span class="fa fa-check"></span>
                                        <span>
                                            Postée dépuis le {{ getCreatedAt(product.product.updated_at) }}
                                        </span>
                                    </span>
                                    <span class="mr-2">
                                        <span class="fa fa-check"></span>
                                        <span> Actionnaire : 
                                            <span>
                                                UVAR
                                            </span>
                                        </span>
                                    </span>
                                </span>
                            </div>
                            <hr class="m-0 p-0 w-100 bg-white">
                            <div class="mx-auto w-100 px-3">
                                <h4 class="text-center w-100 mx-auto text-white my-0 py-1">
                                   Description 
                                </h4>
                                <hr class="m-0 p-0 w-100 bg-white">
                                <h5 class="my-0 p-2">
                                   {{product.product.description}} 
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </transition>
        <transition name="justefade" appear>
            <div class="w-100 mx-auto mt-2">
                <div class="w-100 mx-auto">
                    <h4 class="m-0 p-0 mx-auto pl-2 py-2 w-95 border border-white my-1 bg-dark text-white-50"  v-if="isLoadedProduct && product.buyers.length > 0"><span class="fa fa-user fa-2x"></span> Les Acheteurs de l'article <i>{{product.product.name}}</i> <strong class="text-secondary">({{product.buyers.length}})</strong> </h4>
                    <h4 class="m-0 p-0 pl-2 mx-auto py-2 w-95 border border-white my-1 bg-dark text-white-50"  v-if="isLoadedProduct && product.buyers.length < 1">Pas encore d'acheteur de l'article <i>{{product.product.name}}</i></h4>
                    <div class="w-95 mx-auto">
                        <table class="table table-official text-white" v-if="isLoadedProduct && product.buyers.length > 0">
                            <thead class="text-center">
                                <th>Acheteur</th>
                                <th>Quantité</th>
                                <th>Date d'achat</th>
                                <th>Actions</th>
                            </thead>
                            <tbody>
                                <tr v-for="(buyer, k) in product.buyers">
                                    <td>
                                        <span>
                                            <img class="action-photo border-official"  width="60" :src="getProfilPath(buyer.images)" >
                                        </span>
                                        <span class="ml-2">
                                            <a href="#" v-if="!buyer.member"   class="card-link d-inline-block text-white" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{buyer.user.name}}
                                                </span>
                                            </a>
                                            <router-link v-if="buyer.member" :to="{name: 'membersProfil', params: {id: buyer.member.id}}"   class="card-link d-inline-block text-white" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{buyer.member.name}}
                                                </span>
                                            </router-link>
                                        </span>
                                    </td>
                                    <td class="text-center">
                                        <span class="align-content">{{ buyer.shop.total }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="align-content">{{ getCreatedAt(buyer.shop.updated_at) }}</span>
                                    </td>
                                    <td class="text-center">
                                        <span class="fa fa-lock fa-2x p-2 pt-3 mr-1 cursor text-warning" :title="'Bloquer ' + buyer.user.name " ></span>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </transition>
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
            this.$store.dispatch('getProduct', this.$route.params.id)
            
        },
        updated(){

        },


        mounted(){

        },

        methods :{
            setEditingProduct(product){
                this.$store.commit('RESET_TARGETED_PRODUCT', product)
                this.$store.commit('RESET_EDITING_PRODUCT', product)
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
                let name = ''
                if (images.length > 0) {
                    name = images[0].name
                    path = name
                    return '/images/'+ path
                }
                else if (images.length == 0) {
                    return '/icons/contacts_3695.png'
                }

            },
        },

        computed: mapState([
            'member', 'connected', 'user','targetedProduct', 'allProducts', 'editingProduct', 'active_member', 'lastProduct', 'bestProduct', 'product', 'isLoadedProduct'
        ])
    }
</script>

<style>
    .header-table{
        background-color: rgba(100, 100, 100, 0.4) !important;
    }

    .fa.fa:hover{
        -webkit-transform: rotateZ(360deg);
        -ms-transform: rotateZ(360deg);
        -o-transform: rotateZ(360deg);
        transform: rotateZ(360deg);
        transition: transform 1s;
    }
    img.action-photo{
        border-radius: 100%;
        cursor: pointer;
    }

    img.action-photo:hover{
        transform: scale(1.1);

    }

    td span.align-content{
        position: relative;
        top: 15px;
    }
</style>