<template>
	<div class="tab-pane active" id="Login">
	    <form role="form" class="form-horizontal" method="post">
	        <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="email" class="form-control" :class="invalids !== [] && invalids !== {} ? 'is-invalid' : '' " v-model="email" name="email" placeholder="Votre addresse email" type="email">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="invalids.email !== undefined">{{ invalids.email[0] }}</i>
                </div>
            </div>
	        <div class="form-group">
                <div class="col-sm-12">
                    <input  class="form-control" :class="invalids !== [] && invalids !== {} ? 'is-invalid' : '' " v-model="password" autocomplete="current-password" name="password" placeholder="Votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="invalids['password'] !== undefined">{{ invalids.password[0] }}</i>
                </div>
            </div>
	        <div class="row">
	            <div class="col-sm-10">
	                <button @click="login()" type="button" class=" ml-3 btn w-25 btn-radius btn-primary btn-radius px-3 py-2 border border-white">
	                    S'identifier
	                </button>
	                <a class="for-pwd" href="javascript:;">Mot de passe oublier?</a>
	            </div>
	        </div>
	    </form>
	</div>
</template>




<script>
	import { mapState } from 'vuex'
	export default{

		data() {
            return {
                email: undefined,
                password: undefined,
            }   
        },
		
        created(){
           
        },
		



		methods: {
			login(){
				let inputs = $('input')
				console.log(inputs)
				this.$store.dispatch('login', {email: this.email, password: this.password})
			}
		},

		computed: mapState([
            'invalids', 'newUserSucess', 'newUser', 'connected', 'member'
        ])
	}
</script>