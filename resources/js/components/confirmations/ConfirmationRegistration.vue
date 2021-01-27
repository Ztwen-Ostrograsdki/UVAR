<template>
    <div class="modal fade" id="confirmationRegistration" tabindex="-1" role="dialog" aria-labelledby="confirmationRegistrationLabel" aria-hidden="true" style="top: 100px !important;">
        <div class="modal-dialog text-center border border-white">
            <div class="bg-linear-official-180 modal-content" style="border-style: solid; border-radius: 0;">
                <div class="w-100 mx-auto bg-linear-official-180">
                    <div class="mx-auto w-100 p-1 pb-2" style="">
                        <div class="w-100 p-2 my-1 mx-auto">
                            <h5 class="text-center mx-auto text-warning w-75">Confirmation d'inscription de membre</h5>
                            <hr class="m-0 p-0 bg-white mb-2 w-100">
                            <div class="mx-auto w-100" v-if="!refresh.status">
                                <p class="w-100 mx-auto text-center">
                                    <h5 class="text-danger cursive"> Votre inscrition est sur le point d'être finalisée <span class="text-warning">
                                    </span>
                                    </h5> 
                                    <br>
                                    <span class=""> </span>
                                </p>
                                <div class="w-100 mx-auto mt-2">
                                    <h5 class="mx-auto w-100 text-center text-white-50">Voulez-vous confirmer votre inscription?</h5>
                                    <div class="mx-auto w-100 d-flex justify-content-center">
                                        <button class="btn btn-danger mx-1" data-dismiss="modal" >Plus tard</button>
                                        <button class="btn btn-primary mx-1" @click="refreshStatus(true)">Confirmé</button>
                                    </div>
                                </div>
                            </div>
                            <div class="mx-auto w-100" v-if="refresh.status">
                                <p class="w-100 mx-auto text-center">
                                    <br>
                                    <h4 class="">
                                        <span class="fa fa-check-square-o text-success text-center d-block" style="font-size: 15px"></span>
                                        <i class="cursive text-success">BRAVO !!! la confiramation a été effective</i>
                                    </h4>
                                </p>
                                <div class="w-100 mx-auto mt-2">
                                    <h5 class="mx-auto w-100 text-center text-white-50">Monsieur / madame est désormais membre <span class="text-warning"> 
                                    </span> </h5>
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
                refresh: {status: false, confirm: false}
                
            }   
        },
        created(){
            
        },

        methods :{
            refreshStatus(status){
                this.refresh.status = status
            },
            refresherClasse(){
                let status = this.refresh.status
                let classe = this.targetedClasse.classe
                let route = this.$route.name

                
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

