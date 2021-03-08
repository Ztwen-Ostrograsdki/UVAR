<template>
    <div class="mx-auto w-100 my-1 ">
        <div class="w-100 mx-auto">
            <members-profil></members-profil>
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
           this.$store.dispatch('getMember', this.$route.params.id)
        },
        methods :{
           
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'user_member', 'myActions', 'myAccount', 'myReferer', 'myReferies', 'myProducts', 'myBonuses', 'memberReady', 'editingMember', 'active_member', 'memberPhoto'
        ])
    }
</script>

<style>
    
</style>