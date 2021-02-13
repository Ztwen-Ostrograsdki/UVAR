
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
                        LES ACTIONS               
                    </span>
				</h5>

			</div>
			<h4 class="text-white-50 text-center p-3 mx-auto w-100" v-if="allActions.length <= 0">
				Chargement des données en cours...
			</h4>
			<div class="row w-100 mx-auto" v-if="allActions.length > 0">
				<div :id="'action' + action.action.id" class="col-12 border my-1 row m-0 p-0" v-for="action in allActions">
					<div class="w-100 mx-auto d-flex justify-content-between p-0">
						<div class="w-25 p-0 float-left" style="height: auto !important;">
							<div class="w-100 p-0 m-0 float-left h-100">
                                <img v-if="action.images.length < 1" class="p-0 m-0 float-left w-100 h-100" src="/photo/ph2.jpg">
								<img v-if="action.images.length > 0" class="p-0 m-0 float-left w-100 h-100" :src="'/images/'+ getProfilPath(action.images)">
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
                                            <i class="ml-2 text-white-50">({{action.totalBought}}) achétées</i>
                                            <i class="ml-2 text-danger">({{ action.action.total - action.totalBought}}) restantes</i>
											<span @click="buyAction(action.action, active_member)" class="m-0 float-right mr-2 btn btn-primary border-official">Acheter cette action</span>
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
										<span class="float-right mr-2">
                                            <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editActionData" @click="setEditingAction(action.action)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                            <span class="d-inline-block text-white-50 float-right text-white-50">
                                             Actionnaire : {{ action.action.actionnary == null ? 'UVAR' : action.action.actionnary }}
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
        	this.$store.dispatch('getAllActions')
        },
        methods :{

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
            setEditingAction(action){
                this.$store.commit('RESET_TARGETED_ACTION', action)
                this.$store.commit('RESET_EDITING_ACTION', action)
            }
            
        },
        updated(){
            $(document).ready(function(){
                $(window).on('hashchange', function(e){
                    let hash = location.hash.substr(1)
                    if (hash !== "") {
                        if (hash.search('action') !== -1) {
                            $('div.targetedAction').removeClass('border-official shadow targetedAction')
                            $('div#' + hash).addClass('border-official bg-official-opacity shadow targetedAction')
                        }
                    }

                })
            })
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetedAction', 'allActions', 'editingAction', 'active_member', 'token'
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