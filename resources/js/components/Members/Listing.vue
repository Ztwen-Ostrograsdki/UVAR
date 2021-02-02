<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les Membres</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="members.length < 1">
                <h5 class="alert alert-warning p-2 w-100 ">
                    OOops aucun membre n'est enregistré
                </h5>
            </div>
            <table class="table table-official text-white" v-if="members.length > 0">
                <thead>
                    <th>No</th>
                    <th>Nom et prénoms</th>
                    <th>ID Ref.</th>
                    <th>Email</th>
                    <th>Tél</th>
                    <th>Niveau</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(member, k) in members">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>
                            <router-link :to="{name: 'membersProfil', params: {id: member.id}}"   class="card-link d-inline-block" >
                                <span  class="w-100 d-inline-block link-profiler">
                                    {{member.name}}
                                </span>
                            </router-link>
                        </td>
                        <td>{{ member.IDENTIFY }}</td>
                        <td>{{ member.email }}</td>
                        <td>{{ member.phone }}</td>
                        <td>{{ member.level }}</td>
                        <td>{{ member.country }}</td>
                        <td class="text-center">
                            <span class="fa fa-lock  mr-1 cursor text-warning" :title="'Bloquer' + member.name " ></span>
                            <span class="fa fa-trash-o  cursor text-danger" :title="'Supprimer' + member.name "></span>
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
           
            
        },

        computed: mapState([
            'members'
        ])
	}
</script>

<style>
  
</style>