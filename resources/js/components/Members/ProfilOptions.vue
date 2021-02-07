<template>
	<div class="w-100 p-0 m-0">
		<transition name="scalefade" appear>
        <div class="members-options  position-absolute border bg-linear-official-180 border-white" style="width: 250px; top: 70px; right:16px; z-index: 100; " v-if="options">
            <div class="w-100 border" style="">
                <a class="w-100 link-float d-inline-block border m-0 py-1" href="#">
                    <i class="fa fa-sliders fa-sm fa-fw mr-2"></i>
                    <span>Options</span>
                    <span class="mr-2 d-none d-lg-inline text-dark float-right"></span>
                </a>
                  <!-- Dropdown - User Information -->
                <div class="w-100 border p-2">
                        <router-link style="border-radius: 30px;" v-if="connected && active_member !== null" :to="{name: 'membersProfil', params: {id: active_member.id}}"   class="w-100 my-1 d-inline-block link-float" >
                            <!-- <i  class="fas fa-user fa-sm fa-fw mr-2"></i> -->
                            <img alt="Mon profil" width="30" v-if="active_member_photo.length > 0" class="login-photo border-official" :src="'/images/'+ getProfilPath()">
                            Mon profil
                        </router-link>
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
                    <a class="w-100 py-1 pb-2 d-inline-block border-top link-float" href="" @click="logout()">
                        <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2"></i>
                        Me déconnecter
                    </a>
                    <form id="logout-form" action="" method="POST" style="display: none;">
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
           if (this.connected) {
                this.$store.dispatch('getMember', this.active_member.id)
            }
        },
        methods: {
            logout(){
                this.$store.dispatch('logout')
            },
            getProfilPath(){
                let directory = ''
                let image = this.active_member_photo
                if (image.length > 0) {
                    let name = image[0].name
                    directory = name
                }
                return directory

            },
        },

        computed: mapState([
            'user', 'connected', 'member', 'active_member', 'memberPhoto', 'active_member_photo'
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
    img.login-photo{
        display: ;
        border-radius: 50%;
        z-index: 3000;

    }
</style>