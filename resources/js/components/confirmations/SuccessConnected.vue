<template>
    <div class="modal fade" id="successConnected" tabindex="-1" role="dialog" aria-labelledby="successConnectedLabel" aria-hidden="true" style="top: 100px !important;">
        <div class="modal-dialog text-center border border-white">
            <div class="bg-linear-official-180 modal-content" style="border-style: solid; border-radius: 0;">
                <div class="w-100 mx-auto bg-linear-official-180">
                    <div class="mx-auto w-100 p-1 pb-2" style="">
                        <div class="w-100 p-2 my-1 mx-auto">
                            <h5 class="text-center mx-auto text-warning w-75">
                                UVAR Alert Connection System
                            </h5>
                            <hr class="m-0 p-0 bg-white mb-2 w-100">
                            </div>
                            <div class="mx-auto w-100" v-if="connected.status">
                                <p class="w-100 mx-auto text-center">
                                    <br>
                                    <h4 class="">
                                        <span class="fa fa-check-square-o text-success text-center d-block" style="font-size: 15px"></span>
                                        <i class="cursive text-success">Vous ête maintenant connecté</i>
                                    </h4>
                                </p>
                                <div class="w-100 mx-auto mt-2">
                                    <div class="mx-auto w-100 d-flex justify-content-center">
                                        <button class="btn btn-success mx-1 w-50" data-dismiss="modal" >Terminée</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>


<script>
    import { mapState } from 'vuex'
    export default { 
        props : [],
        data() {
            return {
                connected: {status: true, confirm: false}
                
            }   
        },
        created(){
            
        },

        methods :{
            refreshStatus(status){
                this.refresh.status = status
            },
        },

        computed: mapState([
           
        ])
    }

    
</script>
<style>
    div#options span:hover{
        transform: scale(1.3);
    }
</style>

