<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les Demandes d'achat {{requests.length}}</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="requests.length < 1">
                <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                    Aucune demande en cours...
                </h5>
            </div>
            <table class="table table-official text-white text-center" v-if="requests.length > 0">
                <thead>
                    <th>No</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-if="req.type == 'action'" v-for="(req, k) in requests">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>Le membre 
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
                            <span title="Autoriser la possession" class="mr-1 btn cursor btn-success fa fa-check my-0 py-1" @click="manageRequest(req.member, req.action, req.request, true)"></span>
                            <span title="Rejéter cette demande" class="btn fa cursor fa-close text-danger btn-warning my-0 py-1" @click="manageRequest(req.member, req.action, req.request, false)"></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
        data() {
            return {
                all : null,
            }   
        },
		
        created(){
           
        },
        methods :{
           
           manageRequest(member, action, request, status){
                this.$store.dispatch('manageRequest', {status: status})
           }
            
        },

        computed: mapState([
            'user', 'requests', 'active_member'
        ])
	}
</script>

<style>
  
</style>