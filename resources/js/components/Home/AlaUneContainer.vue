<template>
<div id="overviews" class="section lb a_la_une w-100 bg-linear-official-dark py-2">
	<div class="w-100 p-0 m-0 mt-2 text-white-50">
		<div class="border border-secondary shadow mx-auto" style="width: 90%">
            <div class="section-title row text-center border-official w-100 bg-dark mx-auto mx-0 p-0 px-0">
            	<div class="w-100 mx-auto">
            		<h3 class="m-0 p-0 text-official">
	            		<span class="fa fa-shopping-bag mr-2 hover-btn-new"></span>
	            		<strong>SUR LE MARCHE....</strong>
	            	</h3>
                    <hr class="m-0 w-100 p-0 bg-official">
                    <hr class="m-0 w-100 p-0 my-1 bg-white">
            	</div>
                <div class="col-md-8 offset-md-2">
                    <p class="lead">Lorem Ipsum dolroin gravida nibh vel velit auctor aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem!</p>
                </div>
            </div><!-- end title -->
        
            <div v-for="action in allActions" class="row align-items-center mx-auto border-official px-0 pl-2" style="width: 98%">
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-0 p-0">
                    <div class="message-box">
                        <h4>{{ getCreatedAt(action.action.created_at) }}</h4>
                        <h2>{{ action.action.name }}</h2>
                        <p>
                            {{ action.action.description }}
                        </p>
                        <span class="text-white-50">
                            <span>actionnaire : </span>
                            <span>{{ 'UVAR'}}</span>
                        </span>


                        <a href="#" class="hover-btn-new"><span>Lire plus</span></a>
                    </div><!-- end messagebox -->
                </div><!-- end col -->
                
                <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 m-0 p-0">
                    <div class="post-media wow fadeIn p-0 px-0">
                        <img src="photo/ph4.jpg" class="img-fluid p-0 m-0 img-rounded">
                    </div><!-- end media -->
                </div><!-- end col -->
            </div>
        </div>
	</div>
</div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
		
        created(){
            this.$store.dispatch('getAllActionsOnlyAPart')
        },
        methods :{
            getCreatedAt(created_at){
                if (created_at !== null) {
                    let date = created_at
                        let parts = (date.split("-"))
                        let year = parts[0]
                        let month = parts[1]
                        let day = parts[2].substring(0, 2)
                        let times = ((parts[2].split('T'))[1]).split(':')
                        let hour = times[0] + 'H'
                        let min = times[1] + "'"

                        
                        month = Number(month) - 1

                        return day + " " + this.selfMonths[month] + " " + year + " à " + hour +  " " + min
                }
                else{
                    return "inconnue"
                }

            },
            getLeveler(level){
                level = level.replace('-', '_')
                return this.levels[level]
            },
            getPrice(price){
                let solde = Number(price)
                return {toFrancs: new Intl.NumberFormat().format(solde) + " FCFA", toAr: new Intl.NumberFormat().format(this.toARcoins(solde)) + " AR"}
            },
            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'myAccount', 'myBonuses', 'memberReady', 'targetAction', 'allActionsOnlyAPart', 'allActions'
        ])
	}
</script>
<style>
    #overviews h2{
        color: white;
    }
</style>