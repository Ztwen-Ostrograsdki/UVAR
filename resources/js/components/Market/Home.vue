<template>
	<div class="w-100 mx-auto">
		<div class="w-100 mx-auto">
			<transition name="scalefade" appear>
			<div v-if="isLoadedActions && isLoadedProducts" class="w-100 p-0 mx-auto mt-2 d-none d-sm-flex justify-content-start border" style="background-image:url('/master/images/uvar-font.jpg'); height: 240px;">
				<div class="mx-auto bg-official-opacity w-100 h-100 p-0">
					<div class="mx-auto w-95 d-flex justify-content-start pt-3">
						<div style="with: auto" class="border border-white">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<router-link class="w-100 m-0 py-2 d-inline-block h4" :to="{name: 'shop_home_actions'}"> Les actions UVAR à la une</router-link>
							</div>
							<div class="w-100 p-1 m-0 d-flex flex-column">
								<span>
									<span class="fa fa-check"></span>
									<span> Total : {{ getActionsDetails().total }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> Vendues : {{ getActionsDetails().bought }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus vendue : 
										<a :href="bestAction.action ? '#action' + bestAction.action.id : ''" class="text-white card-link">
											{{ bestAction.action ? bestAction.action.name : 'Pas encore' }}
										</a>
										<span>
											({{ bestAction.totalBought ? bestAction.totalBought : '00' }})
										</span>
									</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus recente : 
										<a :href="lastAction.action ? '#action' + lastAction.action.id : ''" class="text-white card-link">
											{{ lastAction.action ? lastAction.action.name : 'Pas encore' }}
										</a>
										<span>
											({{ lastAction.totalBought ? lastAction.totalBought : '00' }})
										</span>
									</span>
								</span>
							</div>
						</div>
						<div style="with: auto" class="border border-white mx-2">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<router-link class="w-100 m-0 py-2 d-inline-block h4" :to="{name: 'shop_home_products'}"> Les articles UVAR à la une</router-link>
							</div>
							<div class="w-100 p-1 m-0 d-flex flex-column">
								<span>
									<span class="fa fa-check"></span>
									<span> Total : {{ getProductsDetails().total }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> Vendues : {{ getProductsDetails().bought }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus vendue : 
										<a :href="bestProduct.product ? '#product' + bestProduct.product.id : ''" class="text-white card-link">
											{{ bestProduct.product ? bestProduct.product.name : 'Pas encore' }}
										</a>
										<span>
											({{ bestProduct.totalBought ? bestProduct.totalBought : '00' }})
										</span>
									</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus recente : 
										<a :href="lastProduct.product ? '#product' + lastProduct.product.id : ''" class="text-white card-link">
											{{ lastProduct.product ? lastProduct.product.name : 'Pas encore' }}
										</a>
										<span>
											({{ lastProduct.totalBought ? lastProduct.totalBought : '00' }})
										</span>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			</transition>

			<transition name="scalefade" appear>
			<div v-if="isLoadedActions && isLoadedProducts" class="w-100 p-0 mx-auto mt-2 d-flex d-sm-none justify-content-start border" style="background-image:url('/master/images/uvar-font.jpg'); height: 350px;">
				<div class="mx-auto bg-official-opacity w-100 h-100 p-0">
					<div class="mx-auto w-95 d-flex flex-column justify-content-start pt-3">
						<div style="with: auto" class="border border-white">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<router-link class="w-100 m-0 py-2 d-inline-block h4" :to="{name: 'shop_home_actions'}"> Les actions UVAR à la une</router-link>
							</div>
							<div class="w-100 p-1 m-0 d-flex flex-column">
								<span>
									<span class="fa fa-check"></span>
									<span> Total : {{ getActionsDetails().total }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> Vendues : {{ getActionsDetails().bought }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus vendue : 
										<a :href="bestAction.action ? '#action' + bestAction.action.id : ''" class="text-white card-link">
											{{ bestAction.action ? bestAction.action.name : 'Pas encore' }}
										</a>
										<span>
											({{ bestAction.totalBought ? bestAction.totalBought : '00' }})
										</span>
									</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus recente : 
										<a :href="lastAction.action ? '#action' + lastAction.action.id : ''" class="text-white card-link">
											{{ lastAction.action ? lastAction.action.name : 'Pas encore' }}
										</a>
										<span>
											({{ lastAction.totalBought ? lastAction.totalBought : '00' }})
										</span>
									</span>
								</span>
							</div>
						</div>
						<div style="with: auto" class="border border-white mt-1">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<router-link class="w-100 m-0 py-2 d-inline-block h4" :to="{name: 'shop_home_products'}"> Les articles UVAR à la une</router-link>
							</div>
							<div class="w-100 p-1 m-0 d-flex flex-column">
								<span>
									<span class="fa fa-check"></span>
									<span> Total : {{ getProductsDetails().total }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> Vendues : {{ getProductsDetails().bought }}</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus vendue : 
										<a :href="bestProduct.product ? '#product' + bestProduct.product.id : ''" class="text-white card-link">
											{{ bestProduct.product ? bestProduct.product.name : 'Pas encore' }}
										</a>
										<span>
											({{ bestProduct.totalBought ? bestProduct.totalBought : '00' }})
										</span>
									</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus recente : 
										<a :href="lastProduct.product ? '#product' + lastProduct.product.id : ''" class="text-white card-link">
											{{ lastProduct.product ? lastProduct.product.name : 'Pas encore' }}
										</a>
										<span>
											({{ lastProduct.totalBought ? lastProduct.totalBought : '00' }})
										</span>
									</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			</transition>
			<transition name="scalefade" appear>
				<div class="w-100 mx-auto mt-2">
					<div class="w-100 mx-auto" v-if="$route.name == 'shop_home_actions'">
						<action-shop></action-shop>
					</div>
					<div class="w-100 mx-auto" v-if="$route.name == 'shop_home_products'">
						<product-shop></product-shop>
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
            	options : false,
                actions : true,
                shop : true,
                total: 0,
                referies : true,
            }
                
        },
		
        created(){

        },

        mounted(){

        },
        methods :{

        	getActionsDetails(actions = this.allActions){
        		let total = 0
        		let bought = 0
        		if (actions.length > 0) {
        			for (var i = 0; i < actions.length; i++) {
        				let action = actions[i]
        				bought += action.totalBought
        				total += action.action.total
        			}
        		}

        		return {total, bought}
        	},
        	getProductsDetails(products = this.allProducts){
        		let total = 0
        		let bought = 0
        		if (products.length > 0) {
        			for (var i = 0; i < products.length; i++) {
        				let product = products[i]
        				bought += product.totalBought
        				total += product.product.total
        			}
        		}

        		return {total, bought}
        	},



            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetedAction', 'allActions', 'editingAction', 'active_member', 'lastAction', 'bestAction', 'allProducts', 'bestProduct', 'lastProduct', 'isLoadedActions', 'isLoadedProducts'
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
</style>