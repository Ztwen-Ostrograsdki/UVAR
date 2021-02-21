<template>
    <transition name="scalefade" appear>
    <div class="tab-pane my-5" id="newPassword  py-2">
        <div class="mx-auto w-50 border pb-2" :class="border">
            <div class="mx-auto w-100 my-0 bg-primary">
                <h4 class="text-center text-white m-0 py-3 mx-auto">Reinitialisation de mot de passe </h4>
            </div>
            <hr class="w-100 mx-auto bg-official p-0 m-0">
            <form role="form mt-3 w-50 mx-auto" class="form-horizontal">
            <div class=" mt-4 form-group">
                <div class="col-sm-12">
                    <input autocomplete="email" class="form-control" :class="userInvalids.email !== undefined ? 'is-invalid' : '' " v-model="newPassword.email" name="email" placeholder="Votre addresse email" type="email">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.email !== undefined">{{ userInvalids.email }}</i>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="new-password" class="form-control" :class="userInvalids.password !== undefined ? 'is-invalid' : '' " v-model="newPassword.password" name="password" placeholder="Votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.password !== undefined ">{{ userInvalids.password }}</i>
                </div>
            </div>
            <div class="form-group" v-if="newPassword.password !== ''">
                <div class="col-sm-12">
                    <input autocomplete="new-password" class="form-control" :class="userInvalids.password_confirmation !== undefined ? 'is-invalid' : '' " v-model="newPassword.password_confirmation" name="password_confirm" placeholder="Confirmez votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.password_confirmation !== undefined">{{ userInvalids.password }}</i>
                </div>
            </div>
            <div class="row ml-2">                           
                <div class="col-sm-10">
                    <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="reset()">
                        Réinitialiser
                    </button>
                    <button @click="redirectTo()" type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                        Annuler</button>
                </div>
            </div>
        </form>
        </div>
    </div>
    </transition>
</template>

<script>
    import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                userInvalids: {
                    email: undefined,
                    password: undefined,
                    password_confirmation: undefined,
                },
                newPassword: {
                    email: '',
                    password: '',
                    password_confirmation: '',
                    token: '',
                },
                border: 'border-white'
            }   
        },
        
        created(){
            this.newPassword.token = this.$route.params.token
            this.newPassword.email = this.$route.query.email
        },
        methods :{

           reset(){
                this.border = 'border-white'
                this.userInvalids = {
                    email: undefined,
                    password: undefined,
                    password_confirmation: undefined,
                },
                axios.post('/password/reset', this.newPassword, 
                    {
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                        }
                    })
                    .then(response => {
                        let resp = response.data
                        if (resp.invalids !== undefined) {
                            this.border = 'border-danger'
                            resp.invalids.password !== undefined ? this.userInvalids.password = resp.invalids.password[0] : this.userInvalids.password = undefined
                            resp.invalids.email !== undefined ? this.userInvalids.email = resp.invalids.email[0] : this.userInvalids.email = undefined
                            resp.invalids.token !== undefined ? this.userInvalids.token = resp.invalids.token[0] : this.userInvalids.token = undefined
                            resp.invalids.password_confirmation !== undefined ? this.userInvalids.password_confirmation = resp.invalids.password_confirmation[0] : this.userInvalids.password_confirmation = undefined
                        }
                        else if (resp.errors) {
                            this.border = 'border-danger'
                            this.userInvalids = {
                                email: resp.errors,
                                password: resp.errors,
                                email: resp.errors,
                                password_confirmation: resp.errors,
                            }
                        }
                        else{
                            if (resp.success !== undefined) {
                                this.border = 'border-succes'
                                Swal.fire({
                                  icon: 'success',
                                  title: response.data.success,
                                  showConfirmButton: false,
                                })

                                window.location = '/'
                            }
                        }
                    })
                    .catch(err => {
                        this.border = 'border-danger'
                        console.log(err)
                        Swal.fire({
                          icon: 'error',
                          title: "Une erreure inconnue s'est produite ",
                          showConfirmButton: false,
                          timer: 2000
                        })
                    })  
               },
                redirectTo(){
                    return  window.location = '/'
               }
            
        },

        computed: mapState([
            
        ])
    }
</script>