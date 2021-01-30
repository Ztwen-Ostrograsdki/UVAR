<template>
<div class="row mx-auto w-90 my-3 profils">
	<div class="col-md-12">
        <member-options :options="options"></member-options>
        <span class="fa fa-navicon cursor text-white-50 fa-2x" @click="resetOptions()"></span>
        <span class="fa fa-close cursor text-white-50 fa-2x" title="Masquer le profil" @click="resetProfil()" v-if="profil"></span>
        <span class="fa fa-chevron-up cursor text-white-50" title="Afficher le profil" @click="resetProfil()" v-if="!profil"></span>
        <div class="tab-content">
            <transition name="justefade" appear> 
                <div class="mx-auto my-2 w-100 border-official" v-if="profil">
                    <div class="m-0 row w-100">
                        <div class="bg-official text-center m-0 p-0 col-sm-12 col-lg-4 row">
                            <span class="fa fa-user-o mx-auto col-12 mt-2" style="font-size: 100px"></span>
                            <hr class="m-0 p-0">
                            <span class="text-warning font-italic col-12">
                                Master
                            </span>
                            <div class="mx-auto d-flex col-12 my-1 mb-0 justify-content-center p-0">
                                <span class="bg-secondary pt-3 m-0 w-100 position-relative fa-2x" style="bottom: 0px; top: 6%">
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
                                        <td>Nom et Prénoms:</td>
                                        <td> {{ 'GASSOUYA' }} </td>
                                    </tr>
                                    <tr>
                                        <td>Sexe:</td>
                                        <td>{{ 'M'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Inscrit le:</td>
                                        <td>{{ '25/02/1888' }}</td>
                                    </tr>
                                </table>
                            </div>
                            <div class="border col-6 p-0">
                                <h5 class="text-center bg-secondary py-3 w-100 mx-auto m-0">Autres infos</h5>
                                <hr class="m-0 p-0">
                                <table class="table table-borderless text-white-50">
                                    <tr>
                                        <td>ID:</td>
                                        <td> {{ 'HAG2547545' }} </td>
                                    </tr>
                                    <tr>
                                        <td>Pays:</td>
                                        <td>{{ 'Bénin' }}</td>
                                    </tr>
                                    <tr>
                                        <td>No Tél:</td>
                                        <td>{{ '98 85 25 22' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Level:</td>
                                        <td>{{ '3'}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </transition>
            <div class="tab-pane active fade show mt-3" id="tab1">
                <div class="row text-center">
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!amount">
                                <div class="pricing-table-sign-up w-95" @click="resetAmount()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>Mon solde</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="amount">
                                <div class="pricing-table-header grd1" @click="resetAmount()">
                                    <h2>Mon solde</h2>
                                    <h3 class="m-0 p-0">225 550 000 FCFA</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">2 525 AR</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-user-secret 2x"></i> <strong>Actions:</strong>15 000 AR</p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 250 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Bonus Reseau:</strong>5 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Primes Formateur:</strong>0 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Autres primes:</strong>0.5 AR</p>
                                </div>
                                <div class="pricing-table-sign-up">
                                    <a href="#" class="hover-btn-new border border-white"><span>Opération</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!actions">
                                <div class="pricing-table-sign-up w-95" @click="resetAction()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>Mes actions</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="actions">
                                <div class="pricing-table-header grd1" @click="resetAction()">
                                    <h2>Mes actions</h2>
                                    <h3 class="m-0 p-0">2 550 000 FCFA</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">250 878 AR</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-user-secret 2x"></i> <strong>Affiliant:</strong>Dc Marc</p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 25 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>Mc Junior</p>
                                </div>
                                <div class="pricing-table-sign-up">
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
                                    <h2>Mes achats</h2>
                                    <h3 class="m-0 p-0">2 550 000 FCFA</h3>
                                    <hr class="m-0 p-0 bg-secondary w-50 mx-auto my-1">
                                    <h5 class="text-muted font-italic m-0 p-0">250 878 AR</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-user-secret 2x"></i> <strong>Affiliant:</strong>Dc Marc</p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 25 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>Mc Junior</p>
                                </div>
                                <div class="pricing-table-sign-up">
                                    <a href="#" class="hover-btn-new border border-white"><span>Faire du shopping</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!referies">
                                <div class="pricing-table-sign-up w-95" @click="resetReferies()">
                                    <a href="#" class="hover-btn-new w-100 border border-white"><span>Mes affiliés</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="referies">
                                <div class="pricing-table-header grd1" @click="resetReferies()">
                                    <h2>Mes affiliiés</h2>
                                    <h3 class="m-0 p-0">500</h3>
                                    <h5 class="text-warning font-italic m-0 p-0">Master Level member</h5>
                                </div>
                                <div class="pricing-table-space"></div>
                                <div class="pricing-table-features p-0">
                                    <p><i class="fa fa-user-secret 2x"></i> <strong>Affiliant:</strong>Dc Marc</p>
                                    <p><i class="fa fa-plus 2x"></i> <strong>Bonus:</strong> 25 AR</p>
                                    <p><i class="fa fa-user"></i> <strong>Récent:</strong>Mc Junior</p>
                                </div>
                                <div class="pricing-table-sign-up">
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
                profil : false,
                actions : true,
                amount : true,
                shop : true,
                referies : true,
                profiler: false
            }   
        },
		
        created(){
           
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
            }
            
        },

        computed: mapState([
            
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