<template>
	<div class="w-100 p-0 m-0 my-3">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>A PROPOS DE NOUS</h3>
                        </div>
                        <p> Integer rutrum ligula eu dignissim laoreet. Pellentesque venenatis nibh sed tellus faucibus bibendum. Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                        <p>Sed fermentum est vitae rhoncus molestie. Cum sociis natoque penatibus et magnis dis montes.</p>
                    </div><!-- end clearfix -->
                </div><!-- end col -->

                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>LIENS </h3>
                        </div>
                        <ul class="footer-links">
                            <li><a href="#">Acceuil</a></li>
                            <li><a href="#">Profil</a></li>
                            <li><a href="#">Contact</a></li>
                        </ul><!-- end links -->
                    </div><!-- end clearfix -->
                </div><!-- end col -->
                
                <div class="col-lg-4 col-md-4 col-xs-12">
                    <div class="widget clearfix">
                        <div class="widget-title">
                            <h3>CONTACTS</h3>
                        </div>
                        <ul class="footer-links py-0">
                            <li><a href="mailto:#">info@yoursite.com</a></li>
                            <li><a href="#">www.yoursite.com</a></li>
                            <li>Rue 14 Cotonou Bénin </li>
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
           
        },

        computed: mapState([
            
        ])
	}
</script>