<template>
	<div class="row text-center mx-auto">
        <div class="col-lg-12">
            <form class="checkdomain form-inline">
                <div class="checkdomain-wrapper w-75 mx-auto">
                    <div class="form-group">
                        <label class="sr-only" for="domainnamehere">Domain name</label>
                        <input type="text" class="form-control p-2" id="domainnamehere" placeholder="Recherche...">
                        <button type="submit" class="btn btn-primary grd1"><i class="fa fa-search"></i></button>
                    </div>
                    <hr>
                    <div class="clearfix"></div>
                    <div class="checkbox checkbox-warning">
                        <input id="domaincom" type="checkbox" class="styled" checked>
                        <label for="domaincom">.com</label>
                    </div>
                    <div class="checkbox checkbox-warning">
                        <input id="domainnet" type="checkbox" class="styled" checked>
                        <label for="domainnet">.net</label>
                    </div>
                    <div class="checkbox checkbox-warning">
                        <input id="domainorg" type="checkbox" class="styled">
                        <label for="domainorg">.org</label>
                    </div>
                    <div class="checkbox checkbox-warning">
                        <input id="domaintv" type="checkbox" class="styled">
                        <label for="domaintv">.tv</label>
                    </div>
                    <div class="checkbox checkbox-warning">
                        <input id="domaininfo" type="checkbox" class="styled">
                        <label for="domaininfo">.info</label>
                    </div>
                </div><!-- end checkdomain-wrapper -->
            </form>
        </div>
        <!-- end col -->
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