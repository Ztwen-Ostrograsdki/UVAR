<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <div class="w-100 mb-2 p-0">
                <h3 class="text-white d-inline">Les Actions</h3>
                <span data-toggle="modal" data-target="#createAction" class="btn btn-primary px-2 m-0 float-right mx-2">Nouvelle action</span>
                <span v-if="isLoadedActions" class="btn btn-secondary px-2 m-0 float-right" @click="toggleShowingAction()">{{oldsActions ? "Les Actions sur le marché" : "Archive des actions déjà retirées/vendues" }}</span>
            </div>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedActions">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des actions en cours...', 500, 'Veuillez patienter....', 500]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <div class="mx-auto w-100 mt-3" v-if="!oldsActions">
                <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedActions && actions.length < 1">
                    <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                        OOops aucune action n'est enregistrée
                    </h5>
                </div>

                <table class="table table-official text-white" v-if="isLoadedActions && actions.length > 0">
                    <thead class="text-center">
                        <th>No</th>
                        <th>Nom</th>
                        <th>Actionnaire</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Vendues</th>
                        <th>Restantes</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(action, k) in actions">
                            <td class="text-center">{{ k + 1 > 9 ? k + 1 : '0' + (k + 1) }}</td>
                            <td>
                                <router-link :to="{name: 'actionProfil', params: {id: action.id}}"   class="card-link d-inline-block text-white" >
                                    <span  class="w-100 d-inline-block link-profiler">
                                        {{action.name}}
                                    </span>
                                </router-link>
                                <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editActionData" @click="setEditingAction(action)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                            </td>
                            <td class="text-center">{{ getActionnary(action.actionnary) }}</td>
                            <td class="text-center">{{ toARcoins(action.price) + ' AR' }}</td>
                            <td class="text-center">{{ action.total }}</td>
                            <td class="text-center">{{ getTotalBought(action.id) }}</td>
                            <td class="text-center">{{ action.total - getTotalBought(action.id) }}</td>
                            <td class="text-center">
                                <span class="fa fa-lock mr-1 p-2 cursor text-warning" :title="'Archiver' + action.name " ></span>
                                <span @click="deleteAction(action)" class="fa fa-trash-o p-2 cursor text-danger" :title="'Supprimer' + action.name "></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="w-100 mx-auto mt-3" v-if="oldsActions">
                <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="boughtedActions.length < 1">
                    <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                        OOops aucune action dans les archives
                    </h5>
                </div>
                <table class="table table-official text-white" v-if="boughtedActions.length > 0">
                    <thead class="text-center">
                        <th>No</th>
                        <th>Nom</th>
                        <th>Actionnaire</th>
                        <th>Prix</th>
                        <th>Quantité</th>
                        <th>Vendues</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr v-for="(action, k) in boughtedActions" v-if="action.bought">
                            <td class="text-center">{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                            <td>{{ action.name }}</td>
                            <td class="text-center">{{ getActionnary(action.actionnary) }}</td>
                            <td class="text-center">{{ toARcoins(action.price) + ' AR' }}</td>
                            <td class="text-center">{{ action.total }}</td>
                            <td class="text-center">{{ getTotalBought(action.id) }}</td>
                            <td class="text-center">
                                <span class="fa fa-lock p-2 mr-1 cursor text-warning" :title="'Bloquer' + action.name " ></span>
                                <span @click="deleteAction(action)" class="p-2 fa fa-trash-o  cursor text-danger" :title="'Supprimer' + action.name "></span>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
	export default {
        data() {
            return {
                oldsActions: false,
            }   
        },
		
        created(){
            this.$store.dispatch('getActions')
        },
        methods :{

            toggleShowingAction(){
                this.oldsActions = !this.oldsActions
            },

            getActionnary(actionnary_id){
                let members = this.members
                let actionnary = null
                for (var i = 0; i < members.length; i++) {
                    if (members[i].id == actionnary_id) {
                        actionnary = members[i].name
                    }
                }

                return actionnary !== null ? actionnary : 'UVAR'
            },
            getTotalBought(action_id){
                let table = this.totalBoughtByAction
                return table[action_id] !== undefined  ? table[action_id] : 'inconnue'
            },

            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            setEditingAction(action){
                this.$store.commit('RESET_TARGETED_ACTION', action)
                this.$store.commit('RESET_EDITING_ACTION', action)
            },
            deleteAction(action){
                this.deletingAction = action
               
                Swal.fire({
                  title: "Suppression d'action",
                  text: "Voulez-vous vraiment supprimer l'action " + action.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Supprimer',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Suppression de l'action " + this.deletingAction.name,
                            text: 'Opération en cours veuillez patienter...',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Lancer',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return fetch('/Uvar/administration/tag/actions/' + this.deletingAction.id,{
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(response => {
                                        if (response.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Suppression échouée',
                                                text: response.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.success !== undefined) {
                                                this.$store.dispatch('getAllActions')
                                                this.$store.dispatch('getActions')
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: "Opération réussie! L'action " + this.deletingAction.name + " a bien été envoyée dans la corbeille",
                                                    showConfirmButton: true,
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                        .then((response) => {
                            if (response.isConfirmed) {
                                // this.$store.dispatch('getAllActions')
                                Swal.fire({
                                    icon: 'success',
                                    text: "Opération réussie! ",
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                })
            }

           
            
        },

        computed: mapState([
            'actions', 'members', 'totalBoughtByAction', 'token', 'connected', 'user', 'active_member', 'isLoadedActions', 'boughtedActions'
        ])
	}
</script>

<style>
  
</style>