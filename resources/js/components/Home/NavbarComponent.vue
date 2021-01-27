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
                    <img src="/logos/uvar.png" class="d-inline m-0 p-0" width="" height="70">
                </a>
                <button id="collapser-button" class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbars-host" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbars-host">
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <router-link class="nav-link" to="/">Acceuil</router-link>
                        </li>
                        <li class="nav-item">
                            <router-link class="nav-link" to="/profil">Mon profil</router-link>
                        </li>
                        <li class="nav-item dropdown">
                            <router-link class="nav-link dropdown-toggle"  id="dropdown-a" data-toggle="dropdown" to="/Uvar/administration">Administration</router-link>
                            <div class="dropdown-menu" aria-labelledby="dropdown-a">
                                <router-link class="dropdown-item" to="/Uvar/administration">Acceui</router-link>
                                <a class="dropdown-item" href="#">Gestion des actions </a>
                                <a class="dropdown-item" href="#">Gestion des produits </a>
                                <a class="dropdown-item" href="#">Les formations </a>
                                <a class="dropdown-item" href="#">Les affiliations </a>
                                <a class="dropdown-item" href="#">Les membres </a>
                            </div>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="#">Contact</a></li>
                        <li class="nav-item"><a class="nav-link" href="#">A propos</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right">
                        <li><a class="hover-btn-new log rounded border py-1" href="#" data-toggle="modal" data-target="#login"><span>Se connecter</span></a></li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
	</div>

</template>

<script>
    export default {
        mounted() {
            
        }
    }

</script>
