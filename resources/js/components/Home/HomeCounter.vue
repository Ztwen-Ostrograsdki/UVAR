<template>
<div class="section cl w-95 shadow p-0 py-3 pb-5 mx-auto mt-2 ">
	<div class="w-100 p-0 m-0 my-3">
        <div class="w-100 m-0 p-1 mx-auto text-center">
            <h2 class="text-official m-0 p-0 mb-2 pb-2">
               <span class="fa fa-line-chart mx-2"></span> 
               <strong>NOS PRESTATIONS</strong>
            </h2>
            <hr class="m-0 w-100 p-0 bg-official">
            <hr class="m-0 w-100 p-0 my-1 bg-white">
        </div>
		<transition name="scale" appear>
            <div class="container">
                <div class="row text-left stat-wrap">
                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="fa fa-cubes"></i></span>
                        <p class="stat_count">12000</p>
                        <h3>Actions vendues</h3>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="fa fa-graduation-cap"></i></span>
                        <p class="stat_count">24000</p>
                        <h3>Formations par ans</h3>
                    </div><!-- end col -->

                    <div class="col-md-4 col-sm-4 col-xs-12">
                        <span data-scroll class="global-radius icon_wrap effect-1 alignleft"><i class="fa fa-shopping-bag"></i></span>
                        <p class="stat_count">5000</p>
                        <h3>Prestations - Shopping</h3>
                    </div><!-- end col -->
                </div><!-- end row -->
            </div>      
        </transition>
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