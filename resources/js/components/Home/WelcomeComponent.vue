<template>
	<div class="w-100 p-0 m-0">
        <home-caroussel></home-caroussel>
        <div id="overviews" class="section lb a_la_une w-100">
            <a-la-une></a-la-une>
        </div>
        <!-- section class="page-section">
            <horizontal-home-caroussel></horizontal-home-caroussel>
        </section> -->

        <div class="section cl w-95 shadow p-0 py-3 pb-5 mx-auto border border-white my-2">
            <home-counter></home-counter>
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