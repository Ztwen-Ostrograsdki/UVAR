<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Mes Notifications</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="userRequests.length < 1">
                <h5 class="fa-2x text-center text-white-50 bg-linear-official-50 p-2 w-100 ">
                    OOops vous n'avez aucune notification
                </h5>
            </div>
            <table class="table table-official text-white text-center" v-if="userRequests.length > 0">
                <thead>
                    <th>No</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(req, k) in userRequests">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>Le membre 
                            <i class="text-primary">
                                <router-link :to="{name: 'membersProfil', params: {id: req.member.id}}"   class="card-link d-inline-block" >
                                    <i  class="w-100 text-official d-inline-block link-profiler">
                                        {{req.member.name}}
                                    </i>
                                </router-link>
                            </i> 
                            vous a demandé en affiliation
                            <i class="text-warning">{{ user.name }}</i> 
                        </td>
                        <td>{{req.member.email}}</td>
                        <td class="text-center">
                            <span v-if="!req.affiliation || req.affiliation == 0 || req.affiliation == false" class="mr-1 btn btn-success my-0 py-1" @click="manageMyAffiliation(req.affiliation, 'yes')">Approuver</span>
                            <span v-if="req.affiliation || req.affiliation == 1 || req.affiliation == true" class="mr-1 disabled btn btn-success my-0 py-1">Déja approuvée</span>

                            <span v-if="!req.affiliation || req.affiliation == 0 || req.affiliation == false" class="btn btn-warning my-0 py-1" @click="manageMyAffiliation(req.affiliation, 'no')">Réfuser</span>
                            <span v-if="req.affiliation || req.affiliation == 1 || req.affiliation == true" class="mr-1 btn btn-danger my-0 py-1">Abandonner</span>
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
            this.$store.dispatch('getUser', this.$route.params.id)
        },
        // updated(){
        //     this.$store.dispatch('getUser', this.$route.params.id)
        // },
        methods :{
            manageMyAffiliation(affiliation, r){
                if (navigator.onLine) {
                    this.$store.dispatch('manageMyAffiliation', {affiliation: affiliation, response: r})
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
            'user', 'userRequests'
        ])
	}
</script>

<style>
  
</style>