<template>
	<div class="tab-pane active" id="Login">
	    <form role="form" class="form-horizontal" method="post">
	        <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="email" class="form-control" :class="invalidsLogin !== [] && invalidsLogin !== {} ? 'is-invalid' : '' " v-model="email" name="email" placeholder="Votre addresse email" type="email">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsLogin.email !== undefined">{{ invalidsLogin.email[0] }}</i>
                </div>
            </div>
	        <div class="form-group">
                <div class="col-sm-12">
                    <input  class="form-control" :class="invalidsLogin !== [] && invalidsLogin !== {} ? 'is-invalid' : '' " v-model="password" autocomplete="current-password" name="password" placeholder="Votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="invalidsLogin['password'] !== undefined">{{ invalidsLogin.password[0] }}</i>
                </div>
            </div>
	        <div class="row">
	            <div class="col-sm-10">
	                <button @click="login()" type="button" class=" ml-3 btn w-25 btn-radius btn-primary btn-radius px-3 py-2 border border-white">
	                    S'identifier
	                </button>
	                <a @click="forgotPassword()" data-dismiss="modal" class="for-pwd" href="javascript:;">Mot de passe oublier?</a>
	            </div>
	        </div>
	    </form>
	</div>
</template>




<script>
	import { mapState } from 'vuex'
	import Swal from 'sweetalert2'
	export default{

		data() {
            return {
                email: undefined,
                password: undefined,
                forgot: {email: ''}
            }   
        },
		
        created(){
        },

        updated(){
        },
		



		methods: {
			login(){
				let token = $('meta[name="csrf-token"]').attr('content')
				this.$store.commit('RESET_LOGIN_INVALIDS', [])
				this.$store.dispatch('login', {email: this.email, password: this.password, token: token})
			}, 

			forgotPassword(){
                Swal.fire({
                    title: "Réinitialisation de mot de passe ",
                    input: 'text',
                    inputAttributes: {
                        autocapitalize: 'off',
                        placeholder: "Veuillez renseiller votre addresse mail"
                    },
                    showCancelButton: true,
                    confirmButtonText: 'Envoyer',
                    cancelButtonText: 'Annuler',
                    showLoaderOnConfirm: true,
                    preConfirm: (email) => {
                    	this.forgot.email = email
                        axios.post('/password/email',{email: this.forgot.email}, {
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                            })
                            .then(response => response.json())
                            console.log(response)
                            .then(response => {
                            	console.log(response)
                                if (response.errors !== undefined) {
                                    Swal.fire({
                                        icon: 'error',
                                        title: response.errors,
                                        showConfirmButton: false,
                                    })
                                }
                                else{
                                    if (response.success !== undefined) {
                                        Swal.fire({
                                            icon: 'success',
                                            text: "Nous vous avons envoyé un code de réinitialisation de mot de passe. veuiller vérifier votre boite de reception mail!",
                                            showConfirmButton: true,
                                        })
                                    }
                                }
                            })
                            .catch(error => {
                                Swal.showValidationMessage(
                                    `Echec: Ohhh Une erreure est survenue!!!`
                                )
                            })
                    },
                    allowOutsideClick: () => !Swal.isLoading()
                })
                
            },
		},

		computed: mapState([
            'invalidsLogin', 'newUserSucess', 'newUser', 'connected', 'member',
        ])
	}
</script>