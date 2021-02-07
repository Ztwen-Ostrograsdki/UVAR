<template>
<div class="row mx-auto w-100 my-1 profils membersProfil">
    <div class="col-md-12">
        <div class="w-100 mx-auto p-1 d-flex justify-content-start">
            <span v-if="showProperties" @click="hideProperties()" class="float-left fa-2x fa fa-undo cursor text-official"></span>
            <h4 class="mx-3 text-white-50 d-inline" v-if="memberReady">Profil de :<strong>{{member.name}}</strong></h4>
        </div>
        <span class="fa fa-close cursor text-white-50 fa-2x" title="Masquer le profil" @click="resetProfil()" v-if="profil && !showProperties"></span>
        <span class="fa fa-chevron-up cursor text-white-50" title="Afficher le profil" @click="resetProfil()" v-if="!profil && !showProperties"></span>
        <div class="tab-content" v-if="!showProperties">
            <transition name="justefade" appear> 
                <div class="mx-auto my-2 w-100 border-official" v-if="profil && member.name !== undefined">
                    <div class="m-0 row w-100">
                        <div class="bg-official text-center m-0 p-0 col-sm-12 col-lg-4 row">
                            <div class="d-flex flex-column m-0 p-0 justify-content-start w-100">
                                <img class="p-0 m-0 float-left w-100" src="/photo/ph4.jpg" style="height: 80%">
                                <span class="bg-secondary fa-2x m-0 w-100 pt-2" style="height: 20%;">
                                    <span v-if="user.id == member.user_id" data-toggle="modal" data-target="#editMemberData" class="fa fa-edit cursor mx-2" @click="setEditingMember(active_member)"></span>
                                    <span>{{member.name}}</span>
                                </span>
                            </div>
                        </div>
                        <div class=" col-lg-8 col-sm-12 row m-0 p-0" style="">
                            <div class="col-12 border-official p-0">
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
            <div class="tab-pane active fade show mt-3" id="tab1" >
                <div class="mx-auto d-flex justify-content-center my-2 w-100" v-if="!memberReady">
                    <h5 class="text-white-50 py-2 text-center">Chargement du profil en cours...</h5>
                </div>
                <div class="row text-center" v-if="memberReady">
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
                                    <span title="Epingler les actions achetées" @click="displayProperties('actions')" class="float-right fa fa-tag cursor text-official"></span>
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
                                    <span> Produit{{ myProducts.totalProducts > 1 ? 's' : '' }} acheté{{ myProducts.totalProducts > 1 ? 's' : '' }}</span>
                                    <span title="Epingler les produits achetés" @click="displayProperties('products')" class="float-right fa fa-tag cursor text-official"></span>
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
                                    <h3 class="m-0 p-0">{{ myReferies.length > 9 ? myReferies.length :  + "0" + myReferies.length }}</h3>
                                    <h5 class="text-warning font-italic m-0 p-0">{{ getLeveler(member.level) }} Level member</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <span v-if="myReferies.length > 0" class="text-center text-white-50 fa-2x">{{getReferies(myReferies).total}}</span>
                                    <span v-if="myReferies.length > 0"> Membre{{ myReferies.length > 1 ? 's' : '' }} affilié{{ myReferies.length > 1 ? 's' : '' }}</span>
                                    <span v-if="myReferies.length == 0"> Aucun membres affiliés</span>
                                    <span title="Epingler les membres affiliés" @click="displayProperties('referies')" class="float-right fa fa-tag cursor text-official"></span>
                                    <p>
                                        <i class="fa fa-user-secret 2x"></i> <strong>Affiliant:</strong>
                                        <router-link v-if="myReferer !== null && myReferer !== undefined" :to="{name: 'membersProfil', params: {id: myReferer.id}}"   class="card-link d-inline-block" >
                                            <span  class="w-100 d-inline-block link-profiler">
                                                {{myReferer.name}}
                                            </span>
                                        </router-link>

                                        {{ myReferer !== null ? '' : 'Non reféré' }}
                                    </p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> {{ getBonus(myBonuses).total }}</p>
                                    <p v-if="myReferies.length > 0">
                                        <i class="fa fa-user"></i> <strong>Récent:</strong>
                                        <router-link v-if="myReferies.length > 0" :to="{name: 'membersProfil', params: {id: myReferies[0].id}}"   class="card-link d-inline-block" >
                                            <i  class="w-100 text-official d-inline-block link-profiler">
                                                {{myReferies[0].name.substring(0, 5)}}...
                                            </i>
                                        </router-link>
                                    </p>
                                </div>
                                <div class="pricing-table-sign-up" v-if="user.id == member.user_id">
                                    <a href="#" data-toggle="modal" data-target="#affiliations" class="hover-btn-new border border-white"><span>Affilier +</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                </div>
            </div>
        </div>
        <div>
            <div class="mt-3" v-if="showProperties">
                <members-properties :active="targetTable"></members-properties>
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
                targetTable : undefined,
                showProperties : false,
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
            displayProperties(active){
                this.showProperties = true
                this.targetTable = active
            },
            hideProperties(){
                this.showProperties = false
            },
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
            },
            getBonus(bonuses){
                let total = 0
                for (var i = 0; i < bonuses.length; i++) {
                    total += bonuses[i].value
                }

                return {total: new Intl.NumberFormat().format(this.toARcoins(total)) + " AR"}
            },
            getReferies(referies){
                let total = referies.length 
                if (total > 9) {
                    total = total
                }
                else{
                    total = "0" + total
                }

                return {total: total}
            },
            resetActiveMember(){
                this.$store.dispatch('getMember', this.$route.params.id)
            },
            setEditingMember(member){
                this.$store.commit('RESET_EDITING_MEMBER', member)
                console.log(this.editingMember)
            }
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'user_member', 'myActions', 'myAccount', 'myReferer', 'myReferies', 'myProducts', 'myBonuses', 'memberReady', 'editingMember', 'active_member'
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