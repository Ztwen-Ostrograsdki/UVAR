<template>
	<div class="w-100 p-0 m-0">
		<registred></registred>
		<confirm-registration></confirm-registration>
        <affiliation></affiliation>
        <edit-member-data></edit-member-data>
		<edit-member-photo></edit-member-photo>
        <edit-action></edit-action>
        <create-action></create-action>
        <create-product></create-product>
        <edit-product></edit-product>
            
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
		
        created(){
           
        },

        computed: mapState([
            
        ])
	}
</script>

<style>
	.fade-enter-active, .fade-leave-active{
        transition: opacity 2s, transform 1s;
    }

    .fade-enter, .fade-leave-active{
        opacity: 0;
        transform: translateY(-30px); 
    }
    .fadeR-enter-active, .fadeR-leave-active{
        transition: opacity 1s, transform 0.5s;
    }

    .fadeR-enter, .fadeR-leave-active{
        opacity: 0;
        transform: translateX(-30px); 
    }
    .fadelist-enter-active, .fadelist-leave-active{
        transition: opacity 0.5s;
    }

    .fadelist-enter, .fadelist-leave-to{
        opacity: 0;
    }

    .scale-enter-active, .scale-leave-active{
        transition: opacity 0.5s, transform 0.2s;
    }

    .scale-enter, .scale-leave-active{
        opacity: 0;
        transform: scale(0.8);
    }

    .rapidScale-enter-active, .rapidScale-leave-active{
        transition: opacity 0.5s, transform 0.5s;
    }

    .rapidScale-enter, .rapidScale-leave-active{
        opacity: 0;
        transform: scale(0.7);
    }
    .fadelow-enter-active, .fadelow-leave-active{
        transition: opacity 1s, transform 1s;
    }

    .fadelow-enter, .fadelow-leave-active{
        opacity: 0;
        -webkit-transform: scale(0.1);
        -ms-transform: scale(0.1);
        -o-transform: scale(0.1);
        transform: scale(0.1);
    }
    .justefade-enter-active, .justefade-leave-active{
        transition: opacity 0.5s,
    }

    .justefade-enter, .justefade-leave-active{
        opacity: 0;
        
    }
    .bodyfade-enter-active, .bodyfade-leave-active{
        transition: opacity 1s, transform 1s;
    }

    .bodyfade-enter, .bodyfade-leave-active{
        opacity: 0;
        -webkit-transform: translateY(20px);
        -ms-transform: translateY(20px);
        -o-transform: translateY(20px);
        transform: translateY(20px);
    }
    .depperscale-enter-active, .depperscale-leave-active{
        transition: opacity 1s, transform 1s;
    }

    .depperscale-enter, .depperscale-leave-active{
        opacity: 0;
        transform: scale(0.1);
    }

    .scalefade-enter-active, .scalefade-leave-active{
        transition: opacity 1s, transform 1s;
    }

    .scalefade-enter, .scalefade-leave-active{
        opacity: 0;
        transform: scale(0.1);
    }

    .cursive{
        font-family: cursive !important;
    }
</style>