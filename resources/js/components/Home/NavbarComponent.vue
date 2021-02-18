<template>
	<div class="w-100 p-0 m-0">
		<!-- <div id="preloader">
	        <div class="loader-container">
	            <div class="progress-br float shadow">
	                <div class="progress__item"></div>
	            </div>
	        </div>
	    </div> -->
    <!-- END LOADER --> 
    
    <!-- Start header -->
    <header class="top-navbar">
        <nav class="navbar navbar-expand-lg navbar-light bg-light py-1 border-official">
            <div class="container-fluid">
                <a class="navbar-brand text-official cursive" href="/">
                    <img src="/logos/uvar.png" class="d-inline m-0 p-0 uvar-logo" width="" height="70">
                </a>
                <button id="collapser-button" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbars-host">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active homePage" >
                            <router-link class="nav-link" to="/">Acceuil</router-link>
                        </li>
                        <li class="nav-item profiling" v-if="connected && active_member && active_member.id == null">
                            <router-link class="nav-link" :to="{name: 'usersProfil', params: {id: user.id}}">Mon profil</router-link>
                        </li>
                        <li class="nav-item profiling" v-if="connected && active_member && active_member.id">
                            <router-link class="nav-link" :to="{name: getProfilRouteName(active_member).name, params: {id: getProfilRouteName(active_member).id}}">Mon profil</router-link>
                        </li>
                        <li class="nav-item dropdown marketsTables" v-if="connected">
                            <router-link class="nav-link dropdown-toggle"  id="dropdown-a" data-toggle="dropdown" to="/">Le Marché</router-link>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <router-link class="dropdown-item" :to="{name: 'shop_home_actions'}">Les actions</router-link>
                                <router-link class="dropdown-item" :to="{name: 'shop_home_products'}"> Les Articles</router-link>
                            </div>
                        </li>
                        
                        <li class="nav-item dropdown administrationTables" v-if="connected && user.role == 'admin'">
                            <router-link class="nav-link dropdown-toggle"  id="dropdown-a" data-toggle="dropdown" to="/Uvar/administration">Administration</router-link>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <router-link class="dropdown-item" to="/Uvar/administration">Acceuil</router-link>
                                <a class="dropdown-item" href="#">Les formations </a>
                                <router-link class="dropdown-item" :to="{name: 'notifications'}"> Les affiliations en attente</router-link>
                                <router-link class="dropdown-item" :to="{name: 'notifications'}"> Les achats en attente</router-link>
                                <router-link class="dropdown-item" :to="{name: 'productsListing'}"> Gestion des produits</router-link>
                                <router-link class="dropdown-item" :to="{name: 'actionsListing'}"> Gestions des actions</router-link>
                                <router-link class="dropdown-item" :to="{name: 'usersListing'}">Les utilisateurs</router-link>
                                <router-link class="dropdown-item" :to="{name: 'membersListing'}">Les membres</router-link>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">A propos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li v-if="!connected">
                            <a class="hover-btn-new log rounded border py-1" href="#" data-toggle="modal" data-target="#login">
                                <span>Se connecter</span>
                            </a>
                        </li>
                        <li v-if="connected">
                            <a class="hover-btn-new log rounded border py-1" href="#" @click="logoutTask()">
                                <span class="fa fa-user mr-1 text-success"></span>
                                <span>{{ user.name }}</span>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
    <member-options :options="logoutShow"></member-options>
	</div>

</template>

<script>
    import { mapState } from 'vuex'
    export default{

        data() {
            return {
                logoutShow: false,
                timer: 0
            }   
        },
        
        created(){
            this.$store.dispatch('getActiveMember')
            if (this.connected) {
                this.$store.dispatch('getUser', this.user.id)
            }
        },

        updated(){
            let li_s = $('#navbars-host li.nav-item')
            let active_before = $('#navbars-host li.nav-item.active')
            let route = this.$route

            active_before.removeClass('active')
            if (route.path == '/') {
                $('#navbars-host li.nav-item.homePage').addClass('active')
            }
            else if (route.name == 'membersProfil' || route.name == 'membersProfilOnAdmin' || route.name == 'usersListing') {
                $('#navbars-host li.nav-item.profiling').addClass('active')
            }
            else if (route.path.search('administration') !== -1) {
               $('#navbars-host li.dropdown.administrationTables').addClass('active') 
            }
            else if (route.path.search('boutique') !== -1) {
               $('#navbars-host li.dropdown.marketsTables').addClass('active') 
            }
        },
        
        methods: {
            logoutTask(){
                return this.logoutShow = !this.logoutShow
            },
            clicked(){
                this.timer += this.timer
            },
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
            getProfilPath(){
                let directory = ''
                let image = this.memberPhoto
                if (image.length > 0) {
                    let name = image[0].name
                    directory = name
                }
                return directory

            },
        },
        
        computed: mapState([
            'user', 'connected', 'member', 'login', 'active_member', 'memberPhoto', 'userRequests', 'active_member_photo', 'token'
        ])
    }

</script>
<style>
    img.login-photo{
        display: ;
        border-radius: 50%;
        z-index: 3000;

    }

    img.uvar-logo:hover{
        -webkit-transform: rotateZ(360deg);
        -ms-transform: rotateZ(360deg);
        -o-transform: rotateZ(360deg);
        transform: rotateZ(360deg);
        transition: transform 1s;
    }

    .w-screen.h-screen.bg-gray-800.flex.flex-col.justify-center{
        color: white !important;
    }
</style>