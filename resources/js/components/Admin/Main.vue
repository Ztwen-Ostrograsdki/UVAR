<template>
<div class="w-100 p-0 m-0 mx-auto">
	<div class="w-100 p-0 m-0">
        <admin-dashboard></admin-dashboard>

        <div class="w-100 mx-auto p-0 m-0 my-2 mt-lg-5">
            <div>
                
            </div>
            <div class="w-95 mx-auto">
                <table class="table table-official text-white">
                    <thead>
                        <th>No</th>
                        <th>ID Ref.</th>
                        <th>Nom et prénoms</th>
                        <th>Actions</th>
                    </thead>
                    <tbody>
                        <tr>
                            <td>12</td>
                            <td>25485445</td>
                            <td>HOUNDEKINDO</td>
                            <td>Delete</td>
                        </tr>
                        <tr>
                            <td>12</td>
                            <td>25485445</td>
                            <td>HOUNDEKINDO</td>
                            <td>Delete</td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
        
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
            
        ])
	}
</script>

<style>
.table-official tbody tr:nth-of-type(odd) {
    background-color: rgba(0, 0, 00, 0.5);
}
.table-official td, .table-official th{
    border: thin solid white;
    border-collapse: collapse;
}
.table-official thead{
    background-color: gray;
}
</style>