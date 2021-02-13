<template>
	<div class="w-100 mx-auto">
		<div class="w-100 mx-auto">
			<div class="w-100 p-0 mx-auto mt-2 d-flex justify-content-start border" style="background-image:url('/master/images/uvar-font.jpg'); height: 200px;">
				<div class="mx-auto bg-official-opacity w-100 h-100 p-0">
					<div class="mx-auto w-95 d-flex justify-content-start pt-3">
						<div class="w-25 border border-white">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<h4 class="w-100 m-0 py-2">Les actions à la une</h4>
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
						<div class="w-25 border border-white mx-2">
							<div class="w-100 p-0 m-0 border-bottom border-dark text-center header-table">
								<h4 class="w-100 m-0 py-2">Les articles disponibles</h4>
							</div>
							<div class="w-100 p-1 m-0 d-flex flex-column">
								<span>
									<span class="fa fa-check"></span>
									<span> Total : 24</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> Vendues : 24</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus vendue : 24</span>
								</span>
								<span>
									<span class="fa fa-check"></span>
									<span> La plus recente : 24</span>
								</span>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="w-100 mx-auto mt-2">
				<div class="w-100 mx-auto">
					<action-shop></action-shop>
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
        	}
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetedAction', 'allActions', 'editingAction', 'active_member', 'token', 'lastAction', 'bestAction'
        ])
	}
</script>

<style>
	.header-table{
		background-color: rgba(100, 100, 100, 0.4) !important;
	}

	.fa.fa:hover{
		-webkit-transform: rotateX(360deg);
        -ms-transform: rotateX(360deg);
        -o-transform: rotateX(360deg);
        transform: rotateX(360deg);
        transition: transform 1s;
	}
</style>