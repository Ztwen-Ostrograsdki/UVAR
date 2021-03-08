<template>
		<div id="carouselExampleControls" class="carousel slide bs-slider box-slider" data-ride="carousel" data-pause="hover" data-interval="false" >
        <!-- Indicators -->
        <ol class="carousel-indicators">
            <li data-target="#carouselExampleControls" data-slide-to="0" class="active"></li>
            <li data-target="#carouselExampleControls" data-slide-to="1"></li>
            <li data-target="#carouselExampleControls" data-slide-to="2"></li>
        </ol>
        <div class="carousel-inner" style="height: 580px" role="listbox">

            <div class="carousel-item active">
                <div id="home" class="first-section" style="background-image:url('master/images/uvar-font.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-right">
                                    <div class="big-tagline">
                                        <h2><strong>Université Virtuelle Académique</strong> <span class="text-lowercase">de la</span> Réussite</h2>
                                        <p class="lead">Nous construisons l'Afrique de demain </p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <span class="fa fa-user mx-1"></span>
                                                    <span class="d-none d-md-inline" @click="becomeMember()">Devenir membre</span>
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new ">
                                                <span>
                                                    <router-link v-if="connected && user" class="p-0" :to="{name: 'shop_home_actions'}">
                                                        <span class="fa fa-shopping-bag mx-1"></span>
                                                        <span class="d-none d-md-inline">A la boutique</span>
                                                    </router-link>
                                                    <a href="#" v-if="!connected || !user" class="p-0">
                                                        <span class="fa fa-shopping-bag mx-1"></span>
                                                        <span class="d-none d-md-inline">A la boutique</span>
                                                    </a href="#">
                                                </span>
                                            </a>
                                    </div>
                                </div>
                            </div><!-- end row -->            
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <div class="carousel-item">
                <div id="home" class="first-section" style="background-image:url('/photo/ph9.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-left">
                                    <div class="big-tagline">
                                        <h2><strong>Université Virtuelle Académique</strong> <span class="text-lowercase">de la</span> Réussite</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">Nous construisons l'Afrique de demain </p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <router-link v-if="connected && user" class="p-0" :to="{name: 'shop_home_products'}">
                                                        <span class="fa fa-shopping-bag mx-1"></span>
                                                        <span class="d-none d-md-inline">A la boutique</span>
                                                    </router-link>
                                                    <a href="#" v-if="!connected || !user" class="p-0">
                                                    <span class="fa fa-shopping-bag mx-1"></span>
                                                    <span class="d-none d-md-inline">A la boutique</span>
                                                </a href="#">
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <router-link v-if="connected && user" class="p-0" :to="{name: 'shop_home_actions'}">
                                                        <span class="fa fa-home mx-1"></span>
                                                        <span class="d-none d-md-inline">Et les actions</span>
                                                    </router-link>
                                                    <a href="#" v-if="!connected || !user" class="p-0">
                                                    <span class="fa fa-home mx-1"></span>
                                                    <span class="d-none d-md-inline">Et les actions</span>
                                                </a href="#">
                                                </span>
                                            </a>
                                    </div>
                                </div>
                            </div><!-- end row -->            
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <div class="carousel-item">
                <div id="home" class="first-section" style="background-image:url('photo/ph8.jpg');">
                    <div class="dtab">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12 col-sm-12 text-center">
                                    <div class="big-tagline">
                                        <h2><strong>Université Virtuelle Académique</strong> <span class="text-lowercase">de la</span> Réussite</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">Nous construisons l'Afrique de demain</p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <router-link v-if="connected && user" class="p-0" :to="{name: 'shop_home_products'}">
                                                        <span class="fa fa-shopping-bag mx-1"></span>
                                                        <span class="d-none d-md-inline">A la boutique</span>
                                                    </router-link>
                                                    <a href="#" v-if="!connected || !user" class="p-0">
                                                        <span class="fa fa-shopping-bag mx-1"></span>
                                                        <span class="d-none d-md-inline">A la boutique</span>
                                                    </a href="#">
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new ">
                                                <span>
                                                    <router-link v-if="connected && user" class="p-0" :to="{name: 'shop_home_actions'}">
                                                        <span class="fa fa-bank mx-1"></span>
                                                        <span class="d-none d-md-inline">Et les actions</span>
                                                    </router-link>
                                                    <a href="#" v-if="!connected || !user" class="p-0">
                                                        <span class="fa fa-bank mx-1"></span>
                                                        <span class="d-none d-md-inline">Et les actions</span>
                                                    </a href="#">
                                                </span>
                                            </a>
                                    </div>
                                </div>
                            </div><!-- end row -->            
                        </div><!-- end container -->
                    </div>
                </div><!-- end section -->
            </div>
            <!-- Left Control -->
            <a class="new-effect carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                <span class="fa fa-angle-left" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>

            <!-- Right Control -->
            <a class="new-effect carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                <span class="fa fa-angle-right" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
	export default {
		
        created(){

        },
        methods: {
            becomeMember(){
                if (!this.connected || !this.user) {
                    Swal.fire({
                        title: "Devenir membre UVAR",
                        text: "Pour devenir un membre UVAR, vous devrez vous faire affilier par un membre UVAR du site. Pour cela, veuillez entrer en contact avec un membre UVAR, ou bien veuillez envoyer une demande d'affiliation à l'administrateur UVAR.", 
                        showCancelButton: true,
                        showConfirmButton: false,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        cancelButtonText: 'Veuillez vous connecter',
                    })
                    return false
                }
                Swal.fire({
                    title: "Devenir membre UVAR",
                    text: "Pour devenir un membre UVAR, vous devrez vous faire affilier par un membre UVAR du site. Pour cela, veuillez entrer en contact avec un membre UVAR, ou bien veuillez envoyer une demande d'affiliation à l'administrateur UVAR.", 
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Lancer une demande',
                    cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Envoie de demande",
                            input: 'text',
                            inputAttributes: {
                                autocapitalize: 'off',
                                required: true,
                                placeholder: "Veuillez renseiller la quantité d'actions"
                            },
                            showLoaderOnConfirm: true,
                            showConfirmButton: true,
                            confirmButtonText: 'Envoyer',
                            preConfirm: (message) => {
                                return axios.post('/Uvar/send/demande=affiliation/id=' + this.user.id + '/message=' + message,{
                                        headers: {
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                        },
                                    })
                                    .then(response => {
                                        if (response.data.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                text: response.data.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.data.success !== undefined) {
                                                Swal.fire({
                                                    icon: 'success',
                                                    showConfirmButton: true,
                                                    text: response.data.success
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                    }
                })
            },

        },
        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetAction', 'allActions', 'allProducts'
        ])
	}
</script>

<style>
    
</style>