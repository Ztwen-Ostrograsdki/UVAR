<template>
	<div class="w-100 p-0 m-0">
		<transition name="scalefade" appear>
        <div class="members-options  position-absolute border bg-linear-official-180 border-white" style="width: 250px; top: 30px; left:16px; z-index: 100; " v-if="options">
            <div class="w-100 border" style="">
                <a class="w-100 link-float d-inline-block border m-0 py-1" href="#">
                    <i class="fa fa-sliders fa-sm fa-fw mr-2"></i>
                    <span>Options</span>
                    <span class="mr-2 d-none d-lg-inline text-dark float-right"></span>
                </a>
                  <!-- Dropdown - User Information -->
                <div class="w-100 border p-2">
                        <a class="w-100 my-1 d-inline-block link-float" href="" style="border-radius: 30px;">
                            <i class="fas fa-cogs fa-sm fa-fw mr-2"></i>
                            Editer mon profil
                        </a>
                        <a class="w-100 my-1 d-inline-block link-float" data-toggle="modal" data-target="#affiliations" href="" style="border-radius: 30px;">
                            <i class="fa fa-line-chart fa-sm fa-fw mr-2"></i>
                            Affilier un membre
                        </a>
                        <a class="w-100 my-1 d-inline-block link-float" href="" style="border-radius: 30px;">
                            <i class="fa fa-line-chart fa-sm fa-fw mr-2"></i>
                            Vérifier mon solde
                        </a>
                        <a class="w-100 my-1 d-inline-block link-float" href="" style="border-radius: 30px;">
                            <i class="fa fa-line-chart fa-sm fa-fw mr-2"></i>
                            Effectuer une transaction
                        </a>
                        <a class="w-100 my-1 d-inline-block link-float" href="" style="border-radius: 30px;">
                            <i class="fa fa-line-chart fa-sm fa-fw mr-2"></i>
                            Soumettre une requête
                        </a>
                        <a class="w-100 my-1 d-inline-block link-float" href="" style="border-radius: 30px;">
                            <i class="fa fa-line-chart fa-sm fa-fw mr-2"></i>
                            Signaler un membre
                        </a>
                    <a class="w-100 py-1 d-inline-block link-float" href="#">
                         <i class="fas fa-list fa-sm fa-fw mr-2"></i>
                        Autres actions
                    </a>
                    <a class="w-100 py-1 pb-2 d-inline-block border-top link-float" href="">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Fermer mon compte
                    </a>
                    <form action=""  style="display: none;">
                    </form>
                </div>
            </div> 
        </div>
        </transition>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
        props: ['options'],
		
        created(){
           
        },

        computed: mapState([
            
        ])
	}
</script>

<style>
    .members-options a{
        color: white;
    }
    .members-options a:hover{
        color: #9dc15b !important
    }
</style>