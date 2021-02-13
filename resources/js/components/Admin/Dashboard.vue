<template>
<div class="row mx-auto w-90 mt-3 profils administration">
	<div class="col-md-12" v-if="$route.name !== 'membersProfil'">
        <router-link title="Recharger la page par defaut" class="fa fa-recycle mx-1" :to="{name: 'adminDefault'}"></router-link>
        <span class="fa fa-close cursor text-white-50" title="Masquer le profil" @click="resetTables()" v-if="tables"></span>
        <span class="fa fa-chevron-up cursor text-white-50" title="Afficher le profil" @click="resetTables()" v-if="!tables"></span>
        <router-link class="float-right text-white" :to="{name: 'notifications'}">
            <span :title="'Vous avez ' + notifications.length + ' notifications' " class="fa float-right text-white fa-bell cursor fa-2x">
                <span class="float-right bg-danger position-relative text-white p-1" style="right: 11px; top: 1px; border-radius: 50%; font-size: 0.5rem !important;">
                    <span>{{ notifications.length }}</span>
                </span>
            </span>
        </router-link>
        

        <div class="tab-content" v-if="connected && active_member && active_member.id && user && user.role == 'admin'">
            <transition name="justefade" appear> 
                
            </transition>
            <div class="tab-pane active fade show mt-3" id="tab1">
                <div class="row text-center">
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!transactionsTable">
                                <div class="pricing-table-sign-up w-95">
                                    <a href="#" class="hover-btn-new w-100" @click="resetTransaction()"><span>Les transactions</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="transactionsTable">
                                <span class="fa fa-close cursor text-white-50 float-right m-2" @click="resetTransaction()"></span>
                                <div class="pricing-table-header grd1" @click="resetTransaction()">
                                    <h2>Les transactions</h2>
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
                                    <a href="#" class="hover-btn-new"><span>Opération</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!actionsTable">
                                <div class="pricing-table-sign-up w-95">
                                    <a href="#" class="hover-btn-new w-100" @click="resetAction()"><span>Les actions</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="actionsTable">
                                <span class="fa fa-close cursor text-white-50 float-right m-2" @click="resetAction()"></span>
                                <div class="pricing-table-header grd1" @click="resetAction()">
                                    <h2>Les actions</h2>
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
                                    <a href="#" class="hover-btn-new"><span>Mettre sur le marché</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="productsTable == false">
                                <div class="pricing-table-sign-up w-95">
                                    <a href="#" class="hover-btn-new w-100" @click="resetProducts()"><span>La boutique</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="productsTable == true">
                                <span class="fa fa-close cursor text-white-50 float-right m-2" @click="resetProducts()"></span>
                                <div class="pricing-table-header grd1" @click="resetProducts()">
                                    <h2>La boutique</h2>
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
                                    <a href="#" class="hover-btn-new"><span>Un nouveau produit</span></a>
                                </div>
                            </div>
                        </transition>
                    </div>
                    <div class="col-md-3">
                        <transition>
                            <div class="w-100 mx-auto d-flex justify-content-between my-0" v-if="!membersTable">
                                <div class="pricing-table-sign-up w-95">
                                    <a href="#" class="hover-btn-new w-100" @click="resetMembers()"><span>Les membres</span></a>
                                </div>
                            </div>
                        </transition>
                        <transition name="bodyfade" appear>
                            <div class="pricing-table pricing-table-highlighted my-0" v-if="membersTable">
                                <span class="fa fa-close cursor text-white-50 float-right m-2" @click="resetMembers()"></span>
                                <div class="pricing-table-header grd1" @click="resetMembers()">
                                    <h2>Les membres</h2>
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
                                    <a href="#" class="hover-btn-new"><span>Affilier +</span></a>
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
                usersTable : false,
                membersTable : false,
                actionsTable : false,
                productsTable : false,
                transactionsTable : false,
                teachersTable : false,
                bonusTable : false,
                options : false,
                tables : false,
            }   
        },
		
        created(){
            this.$store.dispatch('getActiveMember')
            this.$store.dispatch('getToken')
           if (this.connected && this.user && this.user.role == 'admin') {
                this.$store.dispatch('getUsers')
                this.$store.dispatch('getMembers')
                this.$store.dispatch('getActions')
                this.$store.dispatch('getProducts')
                this.$store.dispatch('getCategories')
                this.$store.dispatch('getNotifications')
                this.$store.dispatch('getRequests')
           }

        },
        methods :{
            resetAction(){
                return this.actionsTable = !this.actionsTable
            },
            resetTransaction(){
                return this.transactionsTable = !this.transactionsTable
            },
            resetBonus(){
                return this.bonusTable = !this.bonusTable
            },
            resetTeachers(){
                return this.teachersTable = !this.teachersTable
            },
            resetProducts(){
                return this.productsTable = !this.productsTable
            },
            resetMembers(){
                return this.membersTable = !this.membersTable
            },
            resetUsers(){
                return this.usersTable = !this.usersTable
            },
            resetTables(){
                return this.tables = !this.tables
            },
            resetOptions(){
                return this.options = !this.options
            }
            
        },

        computed: mapState([
            'users', 'user', 'members', 'notifications', 'actions', 'products', 'categories', 'totalBoughtByAction', 'active_member', 'active_member_photo', 'requests', 'token', 'connected'
        ])
	}
</script>

<style>
    
</style>