<template>
<div class="row mx-auto w-100 my-3 profils">
	<div class="col-md-12">
        <div class="w-100 mx-auto p-1 d-flex justify-content-start">
            <h4 class="text-white-50" v-if="member.name !== undefined">Profil de :<strong>{{member.name}}</strong></h4>
        </div>
        <span class="fa fa-close cursor text-white-50 fa-2x" title="Masquer le profil" @click="resetProfil()" v-if="profil && member.name !== undefined"></span>
        <span class="fa fa-chevron-up cursor text-white-50" title="Afficher le profil" @click="resetProfil()" v-if="!profil"></span>
        <div class="tab-content">
            <transition name="justefade" appear> 
                <div class="mx-auto my-2 w-100 border-official" v-if="profil && member.name !== undefined">
                    <div class="m-0 row w-100">
                        <div class="bg-official text-center m-0 p-0 col-sm-12 col-lg-4 row">
                            <span class="fa fa-user-o mx-auto col-12 mt-2" style="font-size: 100px"></span>
                            <hr class="m-0 p-0">
                            <span class="text-warning font-italic col-12">
                                {{ member.level }}
                            </span>
                            <div class="mx-auto d-flex col-12 my-1 mb-0 justify-content-center p-0">
                                <span class="bg-secondary pt-3 m-0 w-100 position-relative" style="bottom: 0px; top: 6%">
                                    Modifier le profil
                                </span>
                            </div>
                        </div>
                        <div class=" col-lg-8 col-sm-12 row m-0 p-0" style="">
                            <div class="col-6 border-official p-0">
                                <h5 class="text-center bg-secondary py-3 w-100 mx-auto m-0">Infos personnelles</h5>
                                <hr class="m-0 p-0">
                                <table class="table table-borderless text-white-50">
                                    <tr>
                                        <td>Nom :</td>
                                        <td> {{ member.name }} </td>
                                    </tr>
                                    <tr>
                                        <td>Sexe:</td>
                                        <td>{{ member.sexe == 'female' ? 'Féminin' : 'Masculin'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Inscrit le:</td>
                                        <td>{{ getCreatedAt(member.created_at) }}</td>
                                    </tr>
                                     <tr>
                                        <td>Email</td>
                                        <td>{{ member.email }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="border col-6 p-0">
                                <h5 class="text-center bg-secondary py-3 w-100 mx-auto m-0">Autres infos</h5>
                                <hr class="m-0 p-0">
                                <table class="table table-borderless text-white-50">
                                    <tr>
                                        <td>ID:</td>
                                        <td> {{ member.IDENTIFY }} </td>
                                    </tr>
                                    <tr>
                                        <td>Pays:</td>
                                        <td>{{ member.country}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Tél:</td>
                                        <td>{{ member.phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Level:</td>
                                        <td>{{ member.level }}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
            <div class="mx-auto d-flex justify-content-center my-2 w-100 border-official" v-if="member.name == undefined">
                <h5 class="text-white-50 py-2">Chargement du profil en cours...</h5>
            </div>
            <div class="tab-pane active fade show mt-3" id="tab1" >
                <div class="mx-auto d-flex justify-content-center my-2 w-100 border-official" v-if="member.name == undefined">
                    <h5 class="text-white-50 py-2 text-center">Chargement du tableau de bord...</h5>
                </div>
                <div class="row text-center" v-if="member.name !== undefined">
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!amount">
                                <div class="pricing-table-sign-up w-95" @click="resetAmount()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>{{ user.id == member.user_id ? 'Mon ' : ' Son '}} solde</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="amount">
                                <div class="pricing-table-header grd1" @click="resetAmount()">
                                    <h2>{{ user.id == member.user_id ? 'Mon ' : ' Son '}} solde</h2>
                                    <h3 class="m-0 p-0">{{ getAccount(myAccount.solde).toFrancs}}</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">{{ getAccount(myAccount.solde).toAr }}</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 00 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Bonus Reseau:</strong>00 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Primes Formateur:</strong>0 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Primes Consulteur <strong class="d-inline d-md-none">formation</strong> :</strong>00 AR</p>
                                </div>
                                <div class="pricing-table-sign-up" v-if="user.id == member.user_id">
                                    <a href="#" class="hover-btn-new border border-white"><span>Opération</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!actions">
                                <div class="pricing-table-sign-up w-95" @click="resetAction()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} actions</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="actions">
                                <div class="pricing-table-header grd1" @click="resetAction()">
                                    <h2>{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} actions</h2>
                                    <h3 class="m-0 p-0"> {{ getMyActions(myActions).pricesToFrancs }}</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">{{ getMyActions(myActions).pricesToAr }}</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <span class="text-center text-white-50 fa-2x">{{getMyActions(myActions).totalActions}}</span>
                                    <span> Actions achetées</span>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 25 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>{{ "(" + myActions.lastAction.total + ") " + myActions.lastAction.action.name.substring(0, 9) }}...</p>
                                </div>
                                <div class="pricing-table-sign-up" v-if="user.id == member.user_id">
                                    <a href="#" class="hover-btn-new border border-white"><span>Aller sur le marché</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="shop == false">
                                <div class="pricing-table-sign-up w-95" @click="resetShop()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>Faire du shopping</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="shop == true">
                                <div class="pricing-table-header grd1 border border-white" @click="resetShop()">
                                    <h2>{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} achats</h2>
                                    <h3 class="m-0 p-0">{{ getMyProducts(myProducts).pricesToFrancs }}</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">{{ getMyProducts(myProducts).pricesToAr }}</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <span class="text-center text-white-50 fa-2x">{{getMyProducts(myProducts).totalProducts}}</span>
                                    <span> Produits achetés</span>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus Achat:</strong> 00 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>{{ "(" + myProducts.lastProduct.total + ") " + myProducts.lastProduct.product.name.substring(0, 9) }} ...</p>
                                </div>
                                <div class="pricing-table-sign-up" v-if="user.id == member.user_id">
                                    <a href="#" class="hover-btn-new border border-white"><span>Faire du shopping</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!referies">
                                <div class="pricing-table-sign-up w-95" @click="resetReferies()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} affiliés</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="referies">
                                <div class="pricing-table-header grd1" @click="resetReferies()">
                                    <h2>{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} affiliiés</h2>
                                    <h3 class="m-0 p-0">500</h3>
                                    <h5 class="text-warning font-italic m-0 p-0">{{ getLeveler(member.level) }} Level member</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-user-secret 2x"></i> <strong>Affiliant:</strong>Dc Marc</p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 25 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>Mc Junior</p>
                                </div>
                                <div class="pricing-table-sign-up" v-if="user.id == member.user_id">
                                    <a href="#" data-toggle="modal" data-target="#affiliations" class="hover-btn-new border border-white"><span>Affilier +</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div><!-- end pane -->
        </div><!-- end content -->
    </div>
</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
        data() {
            return {
                options : false,
                profil : true,
                actions : true,
                amount : true,
                shop : true,
                referies : true,
                profiler: false,
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
                levels : {
                    level_1: 'First',
                    level_2: 'Better',
                    level_3: 'Third',
                    level_4: 'Master',
                    beginner: 'Amateur',
                }
            }   
        },
		
        created(){
           this.$store.dispatch('getMember', this.$route.params.id)
        },
        methods :{
            resetAction(){
                return this.actions = !this.actions
            },
            resetShop(){
                return this.shop = !this.shop
            },
            resetReferies(){
                return this.referies = !this.referies
            },
            resetAmount(){
                return this.amount = !this.amount
            },
            resetProfil(){
                return this.profil = !this.profil
            },
            resetOptions(){
                return this.options = !this.options
            }, 
            getAccount(account){
                let solde = Number(account)
                return {toFrancs: new Intl.NumberFormat().format(solde) + " FCFA", toAr: new Intl.NumberFormat().format(this.toARcoins(solde)) + " AR"}
            },
            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            getMyActions(actions){
                let totalPrices = actions.totalPrices
                let totalActions = actions.totalActions

                return {
                    pricesToFrancs : new Intl.NumberFormat().format(totalPrices) + " FCFA",
                    pricesToAr : new Intl.NumberFormat().format(this.toARcoins(totalPrices)) + " AR",
                    totalActions
                    }
            },
            getMyProducts(products){
                let totalPrices = products.totalPrices
                let totalProducts = products.totalProducts

                return {
                    pricesToFrancs : new Intl.NumberFormat().format(totalPrices) + " FCFA",
                    pricesToAr : new Intl.NumberFormat().format(this.toARcoins(totalPrices)) + " AR",
                    totalProducts
                    }
            },
            fecthActions(action){
                if (isNaN(action)) {
                    return "(" + action.total + ") " + action.action.name
                }
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
            getLeveler(level){
                level = level.replace('-', '_')
                return this.levels[level]
            }
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'user_member', 'myActions', 'myAccount', 'myReferer', 'myProducts'
        ])
	}
</script>

<style>
    .cursor{
        cursor: pointer;
    }
    .cursor:hover{
        transform: scale(1.1);
    }

    .pricing-table h2{
        font-size: 1.2rem;
    }
    .profils p{
        padding: 0;
        margin: 0;
        font-size: 0.8rem;     
    }

    div.pricing-table-sign-up a{
        font-size: 0.7rem;
    }

    .pricing-table-header.grd1 {
        border-top: thin solid white !important;
    }

    .pricing-table.pricing-table-highlighted{
        background-color: rgba(100, 100, 100, 0.9);
        border-right: thin solid white !important;
        border-left: thin solid white !important;
        border-bottom: thin solid white !important;
    }
    .pricing-table.pricing-table-highlighted p i.fa{
        color: #9dc15b !important;
    }
    

    
</style>