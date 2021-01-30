<template>
	<div class="editMemberData">
	<div class="modal fade" id="editMemberData" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-white">Edition de profil</h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="userInvalids.name !== undefined || invalids.name !== undefined ? 'is-invalid' : '' " v-model="newUser.name" name="name" placeholder="Votre nom et prenoms" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name !== undefined">{{ userInvalids.name }}</i>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name == undefined && invalids.name !== undefined">{{ invalids.name[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="email" class="form-control" :class="affiliationsInvalids.email !== undefined || invalids.email !== undefined ? 'is-invalid' : '' " v-model="newReferee.email" name="email" placeholder="Veuillez renseigner l'adresse mail de l'affiliant" type="email">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="affiliationsInvalids.email !== undefined">{{ affiliationsInvalids.email }}</i>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="affiliationsInvalids.email == undefined && invalids.email !== undefined">{{ invalids.email[0] }}</i>
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="userInvalids.name !== undefined || invalids.name !== undefined ? 'is-invalid' : '' " v-model="newUser.name" name="name" placeholder="Votre nom et prenoms" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name !== undefined">{{ userInvalids.name }}</i>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name == undefined && invalids.name !== undefined">{{ invalids.name[0] }}</i>
                        </div>
                        <div class="col-sm-12">
                            <input autocomplete="name"  class="form-control" :class="userInvalids.name !== undefined || invalids.name !== undefined ? 'is-invalid' : '' " v-model="newUser.name" name="name" placeholder="Votre nom et prenoms" type="text">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name !== undefined">{{ userInvalids.name }}</i>
                            <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name == undefined && invalids.name !== undefined">{{ invalids.name[0] }}</i>
                        </div>
                    </div>
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="affiliate()">
                                Mettre à jour
                            </button>
                            <button type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                                Annuler</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
      </div>
    </div>

	</div>
</template>
<script>
    import { mapState } from 'vuex'
    export default {
        data() {
            return {
                userInvalids: {
                    name: undefined,
                    phone: undefined,
                    country: undefined,
                    sexe: undefined,

                }
            }   
        },
        
        created(){
           
        },
        methods :{

           updateMemberData(tag){
                

           }
            
        },

        computed: mapState([
            'invalids', 'user', 'member'
        ])
    }
</script>









<style>
    .loginer input.form-control{
        
    }

    .customer-box .tab-content .form-group .form-control, .loginer select{
        height: 40px !important;
        padding: 3px !important;
        font-size: 1.1rem !important;
        margin: 0 !important;
        color: black !important;
    }
</style>