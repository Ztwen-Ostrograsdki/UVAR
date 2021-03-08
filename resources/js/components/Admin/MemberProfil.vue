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
    .cursor{
        cursor: pointer;
    }
    .cursor:hover{
        transform: scale(1.1);
    }

    .pricing-table h2{
        font-size: 1.2rem;
    }
    .profils p{
        padding: 0;
        margin: 0;
        font-size: 0.8rem;     
    }

    div.pricing-table-sign-up a{
        font-size: 0.7rem;
    }

    .pricing-table-header.grd1 {
        border-top: thin solid white !important;
    }

    .pricing-table.pricing-table-highlighted{
        background-color: rgba(100, 100, 100, 0.9);
        border-right: thin solid white !important;
        border-left: thin solid white !important;
        border-bottom: thin solid white !important;
    }
    .pricing-table.pricing-table-highlighted p i.fa{
        color: #9dc15b !important;
    }

    .membersProfil table tr td{
        margin: 2px 0px 2px 0px;
        padding: 6px 0 6px 0px;
    }

    .membersProfil table tr{
        padding: 2px !important;
    }
    

    
</style>