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
                                        <h2><strong>Université Virtuelle Académique</strong> de la Réussite</h2>
                                        <p class="lead">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <span class="fa fa-user mx-1"></span>
                                                    <span>Devenir membre</span>
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new ">
                                                <span>
                                                    <span class="fa fa-shopping-bag mx-1"></span>
                                                    <span>A la boutique</span>
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
                                        <h2><strong>Université Virtuelle Académique</strong> de la Réussite</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">With Landigoo responsive landing page template, you can promote your all hosting, domain and email services. </p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <span class="fa fa-object-group mx-1"></span>
                                                    <span>Les Actions</span>
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new ">
                                                <span>
                                                    <span class="fa fa-shopping-bag mx-1"></span>
                                                    <span>A la boutique</span>
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
                                        <h2><strong>Université Virtuelle Académique</strong> de la Réussite</h2>
                                        <p class="lead" data-animation="animated fadeInLeft">1 IP included with each server 
                                            Your Choice of any OS (CentOS, Windows, Debian, Fedora)
                                            FREE Reboots</p>
                                            <a href="#" class="hover-btn-new">
                                                <span>
                                                    <span class="fa fa-object-group mx-1"></span>
                                                    <span>Les Actions</span>
                                                </span>
                                            </a>
                                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                            <a href="#" class="hover-btn-new ">
                                                <span>
                                                    <span class="fa fa-shopping-bag mx-1"></span>
                                                    <span>A la boutique</span>
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
	export default {
		
        created(){
           
        },

        computed: mapState([
            
        ])
	}
</script>

<style>
    
</style>