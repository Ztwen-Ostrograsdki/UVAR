<template>
	<div class="affiliations">
	<div class="modal fade" id="affiliations" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title text-white">Formulaire d'affiliation</h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input autocomplete="email" class="form-control" :class="affiliationsInvalids.status == true ? 'is-invalid' : '' " v-model="newReferee.email" name="email" placeholder="Veuillez renseigner l'adresse mail de l'affiliant" type="email">
                            <i class="m-0 p-0 mt-1 text-danger" v-if="affiliationsInvalids.status == true">{{ affiliationsInvalids.msg }}</i>
                        </div>
                    </div>
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="affiliate()">
                                Soumettre
                            </button>
                            <button @click="resetNewReferee()" type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                                Avorter</button>
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
                    email: undefined,
                }
            }   
        },
        
        created(){
           // this.$store.dispatch('getUserMember')
        },
        methods :{

            resetNewReferee(){
                // this.$store.commit('RESET_NEW_REFEREE', undefined)
                // $('#affiliations form input').removeClass('is-invalid')
                // $('#affiliations form i').text('')
            },
           affiliate(){
                let email = this.newReferee.email
                let member = this.active_member
                if (email !== '' && email !== undefined) {
                    this.$store.commit('RESET_AFFILIATION_INVALIDS', {status: false, msg: ""})
                    this.$store.dispatch('affiliate', {email: this.newReferee, member: member})
                }
                else{
                    this.$store.commit('RESET_AFFILIATION_INVALIDS', {status: true, msg: "Veuillez renseigner l'adresse mail de l'utilisateur"})
                }

           }
            
        },

        computed: mapState([
            'user', 'newReferee', 'affiliationsInvalids', 'connected', 'member', 'user_member', 'active_member'
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