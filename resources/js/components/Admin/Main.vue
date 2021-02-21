<template>
<div class="w-100 p-0 m-0 mx-auto">
  <transition name='justefade' appear>
    <div class="w-100 mx-auto text-white-50" v-if="isLoadedVisitors">
      <h5 class="text-info p-2 text-center w-100">UVAR compte aujourd'hui {{visitors.length}} visiteurs</h5>
    </div>
  </transition>
	<div class="w-100 p-0 m-0">
        <admin-dashboard></admin-dashboard>

        <div class="w-90 mx-auto p-0 m-0 my-2 mt-lg-5">
            <div class="mx-auto w-100" v-if="connected && active_member && active_member.id && user && user.role == 'admin' && $route.name !== 'membersProfil'">
               <div class="px-3 d-flex justify-content-start">
                   <router-link class="btn-official mx-1" :to="{name: 'usersListing'}">Les utilisateurs</router-link>
                   <router-link class="btn-official" :to="{name: 'membersListing'}">Les membres</router-link>
                   <router-link class="btn-official mx-1" :to="{name: 'actionsListing'}">Les actions</router-link>
                   <router-link class="btn-official" :to="{name: 'productsListing'}">Les produits</router-link>
                   <router-link class="btn-official mx-1" :to="{name: 'categoriesListing'}">Les Catégories</router-link>
                   <router-link class="btn-official" :to="{name: 'notifications'}">Les demandes d'affiliations</router-link>
                   <router-link class="btn-official mx-1" :to="{name: 'requests'}">Les demandes d'achat</router-link>
               </div> 
            </div>
            <div class="w-100 mx-auto">
                <router-view></router-view>
            </div>
        </div>
        
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
           this.$store.dispatch('getVisitors');
        },
        methods :{
            
        },

        computed: mapState([
            'users', 'admin_auth', 'user', 'members', 'notifications', 'actions', 'products', 'categories', 'visitors', 'totalBoughtByAction', 'active_member', 'active_member_photo', 'connected', 'isLoadedVisitors'
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