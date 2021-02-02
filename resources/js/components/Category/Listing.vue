<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les catégories</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="categories.length < 1">
                <h5 class="alert alert-warning p-2 w-100 ">
                    OOops la boutique est vide
                </h5>
            </div>
            <table class="table table-official text-white" v-if="categories.length > 0">
                <thead>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Produits dans la boutique</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(category, k) in categories">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>{{ category.name }}</td>
                        <td>{{ 3 }}</td>
                        <td class="text-center">
                            <span class="fa fa-lock  mr-1 cursor text-warning" :title="'Bloquer' + category.name " ></span>
                            <span class="fa fa-trash-o  cursor text-danger" :title="'Supprimer' + category.name "></span>
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
            'categories'
        ])
	}
</script>

<style>
  
</style>