<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les Notifications</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="notifications.length < 1">
                <h5 class="alert alert-warning p-2 w-100 ">
                    OOops vous n'avez aucune notification
                </h5>
            </div>
            <table class="table table-official text-white text-center" v-if="notifications.length > 0">
                <thead>
                    <th>No</th>
                    <th>Description</th>
                    <th>Details</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(notif, k) in notifications">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
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
                        <td>{{ "une demande en cours ..." }}</td>
                        <td class="text-center">
                            <span class="mr-1 btn btn-success my-0 py-1" @click="manageAffiliation(notif.referee.id, true)">Approuver</span>
                            <span class="btn btn-warning my-0 py-1" @click="manageAffiliation(notif.referee.id, false)">Réfuser</span>
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
                
            }   
        },
		
        created(){
           
        },
        methods :{
           
           manageAffiliation(referee, status){
                this.$store.dispatch('manageAffiliation', {status: status, referee: referee})
           }
            
        },

        computed: mapState([
            'members', 'notifications', 'affiliationsNotifications'
        ])
	}
</script>

<style>
  
</style>