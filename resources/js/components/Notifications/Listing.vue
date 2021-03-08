<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les Demandes d'affiliations en attente</h3>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedNotifications">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des notifications UVAR en cours...', 1000, 'Veuillez patienter....', 1000]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedNotifications && notifications.length < 1">
                <h5 class="fa-2x text-center text-white-50 bg-linear-official-50 p-2 w-100">
                    OOops vous n'avez aucune notification
                </h5>
            </div>
            <table class="table table-official text-white text-center" v-if="isLoadedNotifications && notifications.length > 0">
                <thead>
                    <th>No</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(notif, k) in notifications">
                        <td>{{ k + 1 > 9 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>Le membre 
                            <i class="text-primary">
                                <router-link :to="{name: 'membersProfilOnAdmin', params: {id: notif.referer.id}}"   class="card-link d-inline-block" >
                                    <i  class="w-100 text-official d-inline-block link-profiler">
                                        {{notif.referer.name}}
                                    </i>
                                </router-link>
                            </i> 
                            fais une demande d'affiliation de Mr/Mme 
                            <i class="text-warning">{{ notif.referee.name }}</i> 
                        </td>
                        <td v-if="notif.affiliation.accepted">
                            <span  class="text-success fa fa-check"></span>
                            <span class="text-success ml-2">Approuvée</span>
                        </td>
                        <td v-if="!notif.affiliation.accepted">
                            <span  class="text-info fa fa-close"></span>
                            <span class="text-info ml-2">Non approuvée</span>
                        </td>
                        <td class="text-center">
                            <span class="mr-1 btn btn-success my-0 py-1" @click="manageAffiliation(notif.referee.id, true, notif.affiliate_id)">Approuver</span>
                            <span class="btn btn-warning my-0 py-1" @click="manageAffiliation(notif.referee.id, false, notif.affiliate_id)">Réfuser</span>
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
            }   
        },
		
        created(){
            this.$store.dispatch('getNotifications')
        },
        mounted(){
        },
        methods :{
           
            manageAffiliation(referee, status, affiliate_id){
                if (navigator.onLine) {
                    this.$store.dispatch('manageAffiliation', {status: status, referee: referee, affiliate_id: affiliate_id})
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
            'members', 'notifications', 'affiliationsNotifications', 'requests', 'isLoadedNotifications'
        ])
	}
</script>

<style>
  
</style>