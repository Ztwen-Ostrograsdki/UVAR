<template>
	<div class="w-100 p-0 m-0 my-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>A PROPOS DE NOUS</h3>
                        </div>
                        <p class="text-center">
                            Personne ne peut se développer tout seul. C'est l'un des plus grands principes enseignés par le Développement Personnel. C'est ensemble qu'on est fort. C'est pour mettre en pratique ce principe que <span style="text-transform: uppercase; font-weight: bold">l'Université Virtuelle Académie de la Réussite</span> a mis sur pieds un vaste projet de développement dénommé <span style="text-transform: uppercase; font-weight: bold">Help Africa</span>  du nom d'une Organisation Non Gouvernementale Américaine composé d'Afro descendants et d'immigrés africains aux Etats Unis qui porte avec nous le projet. Ce projet a pour objectif principal de créer une communauté économique et intellectuelle africaine pour régler les problèmes les plus importants du continent tout en produisant pour nous-mêmes et pour nos frères de la richesse.
                        </p>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>LIENS </h3>
                        </div>
                        <ul class="footer-links">
                            <li class="" >
                                <router-link class="" to="/">Acceuil</router-link>
                            </li>
                            <li class="" v-if="connected && active_member && active_member.id == null">
                                <router-link class="" :to="{name: 'usersProfil', params: {id: user.id}}">Mon profil</router-link>
                            </li>
                            <li class="" v-if="connected && active_member && active_member.id">
                                <router-link class="" :to="{name: getProfilRouteName(active_member).name, params: {id: getProfilRouteName(active_member).id}}">Mon profil</router-link>
                            </li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
                
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>COORDONNEES</h3>
                        </div>
                        <ul class="footer-links py-0">
                            <li><a href="mailto:#">Email: socratesdesouza23@gmail.com</a></li>
                            <li><a href="#"> Tel: (+229) 97 37 03 20</a></li>
                            <li><a href="#">site: www.uvaracademiedelareussite.com</a></li>
                            <li>Adresse: Rue 14 Akpaka Bénin </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
	</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
		
        created(){
            this.$store.dispatch('getActiveMember')
            if (this.connected) {
                this.$store.dispatch('getUser', this.user.id)
            }
        },

        methods: {
            getProfilRouteName(member = undefined){
                let name
                let id = 0
                let route = this.$route.name
                if (route !== 'membersProfil') {
                    name = 'membersProfil'
                }
                else{
                    if (member && member.id == this.$route.params.id) {

                    }
                    else if(member && member.id == this.$route.params.id){
                        name = 'membersProfilOnAdmin'
                    }
                }
                if (member !== undefined) {
                    return {name: name, id: member.id}
                }
            },
        },

       computed: mapState([
            'user', 'connected', 'member', 'login', 'active_member', 'memberPhoto', 'userRequests', 'active_member_photo', 'token'
        ])
	}
</script>