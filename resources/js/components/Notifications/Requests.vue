<template>
    <div class="row mx-auto w-90 mt-3 profils">
        <transition name="bodyfade" appear>
            <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedRequests">
                <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                    <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                      <typical
                        class="vt-title"
                        :steps="['Chargement des demandes d\'affiliations UVAR en cours...', 1000, 'Veuillez patienter....', 1000]"
                        :wrapper="'h2'"
                      ></typical>
                    </div>
                  </div>
            </div>
        </transition>
    	<div class="w-100 mx-auto">

            <h3 class="text-white" v-if="isLoadedRequests">
                <strong v-if="(actionsRequests.length + productsRequests.length) > 0">
                    {{(actionsRequests.length + productsRequests.length) > 9 ? (actionsRequests.length + productsRequests.length) : '0' + (actionsRequests.length + productsRequests.length) }}
                </strong> 
                <span v-if="(actionsRequests.length + productsRequests.length) > 0">
                    demande{{(actionsRequests.length + productsRequests.length) > 1 ? 's' : ''}} d'achat en attente de confirmation
                </span>

                <span class="float-right">
                    <span @click="toggleRequest('actions')" v-if="isLoadedRequests" class="btn btn-secondary px-2 m-0">
                        Demandes d'achat des actions
                    </span>
                    <span @click="toggleRequest('products')" v-if="isLoadedRequests" class="btn btn-secondary px-2 m-0 ml-1">
                        Demandes d'achat des articles
                    </span>
                </span>
            </h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedRequests && (actionsRequests.length + productsRequests.length) < 1">
                <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                    Aucune demande en cours...
                </h5>
            </div>
            <table class="table table-official text-white text-center" v-if="isLoadedRequests && (actionsRequests.length + productsRequests.length) > 0">
                <thead>
                    <th>No</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-if="theRequest == 'actions'" v-for="(req, k) in actionsRequests">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td class="w-60">Le membre 
                            <i class="text-primary">
                                <router-link :to="{name: 'membersProfilOnAdmin', params: {id: req.member.id}}"   class="card-link d-inline-block" >
                                    <i  class="w-100 text-official d-inline-block link-profiler">
                                        {{req.member.name}}
                                    </i>
                                </router-link>
                            </i> 
                            fais une demande d'achat de <span class="text-warning">{{ req.request.total }}</span> actions de l'action 
                            <i class="text-warning">{{ req.action.name }}</i> 
                        </td>
                        <td>{{ "une demande en cours ..." }}</td>
                        <td class="text-center">
                            <span title="Autoriser la possession" class="mr-1 btn cursor btn-success fa fa-check my-0 py-1" @click="manageRequest(req.request, req.type, 1)"></span>
                            <span title="Rejéter cette demande" class="btn fa cursor fa-close text-danger btn-warning my-0 py-1" @click="manageRequest(req.request, req.type, 2)"></span>
                        </td>
                    </tr>
                </tbody>
                <tbody>
                    <tr v-if="theRequest == 'products'" v-for="(req, k) in productsRequests">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td class="w-60">L'utilisateur 
                            <i class="text-primary">
                                <router-link :to="{name: 'membersProfilOnAdmin', params: {id: req.user.id}}"   class="card-link d-inline-block" >
                                    <i  class="w-100 text-official d-inline-block link-profiler">
                                        {{req.user.name}}
                                    </i>
                                </router-link>
                            </i> 
                            fais une demande d'achat de <span class="text-warning">{{ req.request.total }}</span> articles de l'article 
                            <i class="text-warning">{{ req.product.name }}</i> 
                        </td>
                        <td>{{ "une demande en cours ..." }}</td>
                        <td class="text-center">
                            <span title="Autoriser la possession" class="mr-1 btn cursor btn-success fa fa-check my-0 py-1" @click="manageRequest(req.request, req.type, 1)"></span>
                            <span title="Rejéter cette demande" class="btn fa cursor fa-close text-danger btn-warning my-0 py-1" @click="manageRequest(req.request, req.type, 2)"></span>
                        </td>
                    </tr>
                    
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
	export default {
        data() {
            return {
                all : null,
                theRequest: 'actions'
            }   
        },
		
        created(){
            this.$store.dispatch('getRequests')
        },
        mounted(){
        },
        methods :{

            toggleRequest(type){
                this.theRequest = type
            },
           
            manageRequest(request, type, response){
                if (navigator.onLine) {
                    this.$store.dispatch('manageRequest', {request_id: request.id, type: type, response: response})
                }
                else{
                    Swal.fire({
                        icon: 'warning',
                        title: "Erreur de connexion à internet",
                        showConfirmButton: false,
                    })
                }
            }
            
        },

        computed: mapState([
            'user', 'actionsRequests', 'productsRequests', 'active_member', 'isLoadedRequests'
        ])
	}
</script>

<style>
    .w-60{
        width: 60% !important;
    }
</style>