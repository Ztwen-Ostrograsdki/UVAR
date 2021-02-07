<template>
    <div class="row mx-auto w-90 mt-3 profils">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Profil action</h3>
            
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
            'action', 'targetAction', 'active_member', 'connected', 'login', 'user'
        ])
	}
</script>

<style>
  
</style>