<template>
	<div class="tab-pane" id="Registration">
        <form role="form" class="form-horizontal">
            <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="name"  class="form-control" :class="userInvalids.name !== undefined || invalids.name !== undefined ? 'is-invalid' : '' " v-model="newUser.name" name="name" id="name" placeholder="Votre nom et prenoms" type="text">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name !== undefined">{{ userInvalids.name }}</i>
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.name == undefined && invalids.name !== undefined">{{ invalids.name[0] }}</i>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="email" class="form-control" :class="userInvalids.email !== undefined || invalids.email !== undefined ? 'is-invalid' : '' " v-model="newUser.email" name="email" id="email" placeholder="Votre addresse email" type="email">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.email !== undefined">{{ userInvalids.email }}</i>
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.email == undefined && invalids.email !== undefined">{{ invalids.email[0] }}</i>
                </div>
            </div>
            <div class="form-group">
                <div class="col-sm-12">
                    <input autocomplete="new-password" class="form-control" :class="userInvalids.password !== undefined || invalids.password !== undefined ? 'is-invalid' : '' " v-model="newUser.password" id="password" name="password" placeholder="Votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.password !== undefined">{{ userInvalids.password }}</i>
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.password == undefined && invalids.password !== undefined">{{ invalids.password[0] }}</i>
                </div>
            </div>
            <div class="form-group" v-if="newUser.password !== ''">
                <div class="col-sm-12">
                    <input autocomplete="new-password" class="form-control" :class="userInvalids.confirm_password !== undefined || invalids.password !== undefined ? 'is-invalid' : '' " v-model="newUser.confirm_password" name="password_confirm" id="password_confirm" placeholder="Confirmez votre mot de passe" type="password">
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.confirm_password !== undefined">{{ userInvalids.confirm_password }}</i>
                    <i class="m-0 p-0 mt-1 text-danger" v-if="userInvalids.confirm_password == undefined && invalids.password !== undefined">{{ invalids.password[0] }}</i>
                </div>
            </div>
            <div class="row">                           
                <div class="col-sm-10">
                    <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="create()">
                        Soumettre
                    </button>
                    <button @click="resetNewUser()" type="button" data-dismiss="modal" aria-hidden="true" class="btn btn-secondary btn-radius py-2 px-3 border border-dark w-25">
                        Annuler</button>
                </div>
            </div>
        </form>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
	export default {
        data() {
            return {
                userInvalids: {
                	name: undefined,
                	email: undefined,
                	password: undefined,
                	confirm_password: undefined,
                }
            }   
        },
		
        created(){
           
        },
        methods :{

        	resetNewUser(){
        		this.$store.commit('RESET_NEW_USER')
        	},
           create(){

           		let user = this.newUser
           		let name = user.name
           		let email = user.email
           		let password = user.password
           		let confirm_password = user.confirm_password
           			
       			if (name !== '') {
       				this.userInvalids.name = undefined
       			}
       			else{
       				this.userInvalids.name = "Veuillez renseigner ce champ"
       			}

       			if (email !== '') {
       				this.userInvalids.email = undefined
       			}
       			else{
       				this.userInvalids.email = "Veuillez renseigner ce champ"
       			}

       			if (password !== '') {
       				if (confirm_password !== '' && password !== confirm_password) {
       					this.userInvalids.confirm_password = "Les mots de passe ne correspondent pas"
       				}
       				else if (confirm_password == "") {
       					this.userInvalids.confirm_password = "Veuillez confirmer votre mot de passe!"
       				}
       				else{
       					this.userInvalids.confirm_password = undefined
       					this.userInvalids.password = undefined
       				}
       			}
       			else{
       				this.userInvalids.password = "Veuillez renseigner ce champ"
       			}

       			if (name !== '' && email !== '' && password !== '' && confirm_password !== '') {
           			if (this.userInvalids.name == undefined && this.userInvalids.email == undefined && this.userInvalids.password == undefined && this.userInvalids.confirm_password == undefined) {
           				this.$store.dispatch('createUser', user)
           			}
           		}

           }
            
        },

        computed: mapState([
            'invalids', 'newMember', 'user', 'newUser', 'newUserSucess'
        ])
	}
</script>