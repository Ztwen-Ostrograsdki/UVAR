<template>
<div class="w-100 p-0 m-0 mx-auto">
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
	export default {
        data() {
            return {
                
            }   
        },
		
        created(){
            // this.$store.dispatch('getActiveMember')
            // this.$store.dispatch('getUsers')
            // this.$store.dispatch('getMembers')
            // this.$store.dispatch('getActions')
            // this.$store.dispatch('getProducts')
            // this.$store.dispatch('getCategories')
            // this.$store.dispatch('getNotifications')
            // this.$store.dispatch('getRequests')
        },
        methods :{
            
        },

        computed: mapState([
            'users', 'user', 'members', 'notifications', 'actions', 'products', 'categories', 'totalBoughtByAction', 'active_member', 'active_member_photo', 'requests', 'token', 'connected'
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