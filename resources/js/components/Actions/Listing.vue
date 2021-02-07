<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les Actions</h3>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="actions.length < 1">
                <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                    OOops aucune action n'est enregistrée
                </h5>
            </div>
            <table class="table table-official text-white" v-if="actions.length > 0">
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
                        <td class="text-center">{{ k + 1 > 10 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>{{ action.name }}</td>
                        <td class="text-center">{{ getActionnary(action.actionnary) }}</td>
                        <td class="text-center">{{ toARcoins(action.price) + ' AR' }}</td>
                        <td class="text-center">{{ action.total }}</td>
                        <td class="text-center">{{ getTotalBought(action.id) }}</td>
                        <td class="text-center">{{ action.total - getTotalBought(action.id) }}</td>
                        <td class="text-center">
                            <span class="fa fa-lock  mr-1 cursor text-warning" :title="'Bloquer' + action.name " ></span>
                            <span class="fa fa-trash-o  cursor text-danger" :title="'Supprimer' + action.name "></span>
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
            }

           
            
        },

        computed: mapState([
            'actions', 'members', 'totalBoughtByAction'
        ])
	}
</script>

<style>
  
</style>