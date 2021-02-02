<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">La Boutique</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="products.length < 1">
                <h5 class="alert alert-warning p-2 w-100 ">
                    OOops la boutique est vide
                </h5>
            </div>
            <table class="table table-official text-white" v-if="products.length > 0">
                <thead>
                    <th>No</th>
                    <th>Nom</th>
                    <th>Prix</th>
                    <th>Quantité</th>
                    <th>Vendues</th>
                    <th>Restantes</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(product, k) in products">
                        <td>{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>{{ product.name }}</td>
                        <td>{{ product.price }}</td>
                        <td>{{ product.total }}</td>
                        <td>{{ 2 }}</td>
                        <td>{{ 3 }}</td>
                        <td class="text-center">
                            <span class="fa fa-lock  mr-1 cursor text-warning" :title="'Bloquer' + product.name " ></span>
                            <span class="fa fa-trash-o  cursor text-danger" :title="'Supprimer' + product.name "></span>
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
            'products'
        ])
	}
</script>

<style>
  
</style>