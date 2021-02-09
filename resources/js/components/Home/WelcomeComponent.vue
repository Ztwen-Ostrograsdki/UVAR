<template>
<div class="w-100 p-0 m-0">
    <home-caroussel></home-caroussel>
    <div class="w-100 mx-auto d-flex justify-content-center flex-column">
        <div class="w-75 mx-auto my-2 py-2 d-flex justify-content-center">
            <span class="btn btn-primary border-white px-3 px-lg-5 mr-1" @click="toggleDisplay('actions')">Les Actions</span>
            <span class="btn btn-primary border-white px-3 px-lg-5 ml-1" @click="toggleDisplay('products')">Les Produits</span>
        </div>
        <div class="w-95 mx-auto oneProperty mt-2" v-if="onActions">
            <div class="w-100 d-flex justify-content-start mb-0 mt-2">
                <h5 class="text-official fa-2x p-0 m-0 mb-1">Les Actions UVAR à la une
                    <span v-if="allActions.length > 0" class="text-white-50 ml-2">
                        (Plus de {{ allActions.length }} actions disponibles)
                    </span>
                </h5>

            </div>
            <h4 class="text-white-50 text-center p-3 mx-auto w-100" v-if="allActions.length <= 0">
                Chargement des données en cours...
            </h4>
            <div class="row w-100 mx-auto mt-2" v-if="allActions.length > 0">
                <div class="col-12 border my-1 row m-0 p-0" v-for="action in getApartOf(allActions, actionsLength)">
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
                                            <span v-if="connected" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cette action</span>
                                            <span v-if="!connected" class="m-0 float-right mr-2 btn btn-primary border-official">Inscrivez-vous pour acheter cette action</span>
                                        </h4>
                                        <p class="m-0 p-0 mt-1 w-100 float-right text-warning">
                                            Cette action n'est plus disponible sur le marché
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
            <span class="btn btn-primary d-inline-block w-100 border-warning" @click="changeLength('actions', true)" v-if="actionsLength !== true">Tout afficher</span>
            <span class="btn btn-primary d-inline-block w-100 border-warning" @click="changeLength('actions', 4)" v-if="actionsLength !== 4">Reduire l'affichage</span>
        </div>
        <div class="w-95 mx-auto oneProperty mt-2" v-if="onProducts">
            <div class="w-100 d-flex justify-content-start mb-0 mt-2">
                <h5 class="text-official fa-2x p-0 m-0 mb-1">Bienvenue à la boutique UVAR
                    <span v-if="allProducts.length > 0" class="text-white-50 ml-2">
                        (Plus de {{ allProducts.length }} produits disponibles)
                    </span>
                </h5>

            </div>
            <h4 class="text-white-50 text-center p-3 mx-auto w-100" v-if="allProducts.length <= 0">
                Chargement des données en cours...
            </h4>
            <div class="row w-100 mx-auto mt-2" v-if="allProducts.length > 0">
                <div class="col-12 border my-1 row m-0 p-0" v-for="product in getApartOf(allProducts, productsLength)">
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
                                        <h4 class="text-official p-0 m-0 mb-1">{{ product.product.name }}</h4> 
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(product.product.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(product.product.price).toAr }}</span>
                                            <span v-if="connected" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cet article </span>
                                            <span v-if="!connected" class="m-0 float-right mr-2 btn btn-primary border-official">Inscrivez-vous pour acheter cet article</span>
                                        </h4>
                                        <p class="m-0 p-0 mt-1 w-100 float-right text-warning">
                                            Cet article n'est plus disponible sur le marché
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
                                        <span class="d-inline-block text-white-50 float-right text-white-50">
                                            Vendeur : UVAR
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
                <span class="btn btn-primary d-inline-block w-100 border-warning" @click="changeLength('products', true)" v-if="productsLength !== true">Tout afficher</span>
                <span class="btn btn-primary d-inline-block w-100 border-warning" @click="changeLength('products', 4)" v-if="productsLength !== 4">Reduire l'affichage</span>
            </div>
        </div>
        <div class="section cl w-95 shadow p-0 py-3 pb-5 mx-auto border border-white my-2">
            <home-counter></home-counter>
        </div>
    </div>
</div>
</template>

<script>
    import { mapState } from 'vuex'
    export default {
        props : [],
        data() {
            return {
                onActions : false,
                onProducts : true,
                productsLength : 4,
                actionsLength : 4,
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
            this.$store.dispatch('getAllActions')
            this.$store.dispatch('getAllProducts')
        },
        methods :{
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
            changeLength(tag, value){
                if (tag == "actions") {
                    this.productsLength = 4
                    this.actionsLength = value
                }
                else if (tag == "products") {
                    this.productsLength = value
                    this.actionsLength = 4
                }
                
            },
            getApartOf(tags, total){
                let selected = []

                if (total >= tags.length) {
                    selected = tags
                }
                else{
                    if (total !== true) {
                        for (var i = 0; i < total; i++) {
                            selected.push(tags[i])
                        }
                    }
                    else{
                        selected = tags
                    }
                }

                return selected
                
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
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetAction', 'allActions', 'allProducts'
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