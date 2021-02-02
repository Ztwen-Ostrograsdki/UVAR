<template>
    <div class="row mx-auto w-90 mt-3 profils administration">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les utilisateurs</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="users.length < 1">
                <h5 class="alert alert-warning p-2 w-100 ">
                    OOops aucun utilisateur enregistré sur la plateforme
                </h5>
            </div>
            <table class="table table-official text-white" v-if="users.length >= 1">
                <thead>
                    <th class="text-center">No</th>
                    <th>Nom et prénoms</th>
                    <th>Email</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(user, k) in users">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>Delete</td>
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
            'users'
        ])
	}
</script>

<style>
  
</style>