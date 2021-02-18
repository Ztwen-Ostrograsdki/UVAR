<template>
    <div class="row mx-auto w-90 mt-3">
    	<div class="w-95 mx-auto">
            <h3 class="text-white">Les utilisateurs</h3>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedUsers">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des utilisateurs UVAR en cours...', 500, 'Veuillez patienter....', 500]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedUsers && users.length < 1">
                <h5 class="bg-official text-center text-white my-2 p-3 w-100 ">
                    OOops aucun utilisateur enregistré sur la plateforme
                </h5>
            </div>
            <table class="table table-official text-center" v-if="isLoadedUsers">
                <thead>
                    <th class="text-center">No</th>
                    <th>Nom et prénoms</th>
                    <th>Email</th>
                    <th>Compte confirmé</th>
                    <th>Membre UVAR</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(usr, k) in users">
                        <td class="text-white">{{ k + 1 > 9 ? k + 1 : '0' + (k + 1) }}</td>
                        <td class="text-left text-white" v-if="usr.member">
                            <router-link v-if="usr.member" :to="{name: 'membersProfilOnAdmin', params: {id: usr.member.id}}"   class="card-link text-white d-inline-block">
                                {{ usr.name }}
                            </router-link>
                        </td>
                        <td v-if="!usr.member" class="text-left text-white">{{ usr.name }}</td>
                        <td class="text-white">{{ usr.email }}</td>
                        <td>
                            <span v-if="!usr.confirmation_token"  :title="usr.name + ' a bien confirmé son compte UVAR'" class="mr-1 text-success cursor fa fa-check my-0 fa-2x"></span>
                            <span v-if="usr.confirmation_token && usr.confirmation_token !=='locked'"  :title="usr.name + ' n\'a pas confirmé son compte UVAR'" class="text-warning fa cursor fa-close text-danger my-0 fa-2x"></span>
                            <span v-if="usr.confirmation_token && usr.confirmation_token == 'locked'"  :title="usr.name + ' a été vérouillé!'" class="text-warning fa cursor fa-lock text-danger my-0 fa-2x"></span>
                        </td>
                        <td>
                            <span v-if="usr.member" :title="usr.name + ' est un membre UVAR'" class="mr-1 cursor text-success fa fa-2x fa-check my-0" ></span>
                            <span v-if="!usr.member"  :title="usr.name + ' n\'est un membre UVAR'" class="fa cursor fa-close text-danger fa-2x text-warning my-0"></span>
                        </td>
                        <td class="text-center">
                            <span v-if="!usr.confirmation_token" style="font-size: 1.2rem;" @click="lockUser(usr)" class="fa fa-lock p-2 mr-1 cursor text-warning" :title="'Bloquer ' + usr.name " ></span>
                            <span v-if="usr.confirmation_token && usr.confirmation_token == 'locked'" style="font-size: 1.2rem;" @click="dislockUser(usr)" class="fa fa-unlock p-2 mr-1 cursor text-success" :title="'Déverouiller ' + usr.name " ></span>
                            <span style="font-size: 1.2rem;" @click="deleteUser(usr)" class="p-2 fa fa-user-times  cursor text-danger" :title="'Supprimer ' + usr.name "></span>
                            <span style="font-size: 1.2rem;" @click="sendEmail(usr)" class="p-2 fa fa-envelope cursor text-primary" :title="'envoyez un mail à ' + usr.name "></span>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</template>

<script>
	import { mapState } from 'vuex'
    import Swal from 'sweetalert2'
	export default {
        data() {
            return {
                lockedUser : '',
                dislockedUser : '',
                deletingUser : '',
            }   
        },
		
        created(){
             this.$store.dispatch('getUsers')
        },
        
        methods :{
            lockUser(user){
                this.lockedUser = user
               
                Swal.fire({
                  title: "Système de blocage utilisateur/membre",
                  text: "Voulez-vous vraiment bloquer l'utilisateur " + user.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Bloquer',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Blocage utilisateur : " + this.lockedUser.name,
                            text: 'Opération en cours veuillez patienter...',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Lancer',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return fetch('/Uvar/administration/security/a=locked/user/u=' + this.lockedUser.id,{
                                        method: 'PUT',
                                        headers: {
                                            'X-CSRF-TOKEN': this.token,
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(response => {
                                        if (response.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Blocage échouée',
                                                text: response.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.success !== undefined) {
                                                this.$store.dispatch('getUsers')
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: response.success,
                                                    showConfirmButton: true,
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                        .then((response) => {
                            if (response.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    text: "Opération réussie! ",
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                })
            },
            dislockUser(user){
                this.dislockedUser = user
                Swal.fire({
                  title: "Système de déverrouillage utilisateur/membre",
                  text: "Voulez-vous vraiment déverrouiller l'utilisateur " + user.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Déverouiller',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Déverrouillage utilisateur : " + this.dislockedUser.name,
                            text: 'Opération en cours veuillez patienter...',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Lancer',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return fetch('/Uvar/administration/security/a=dislocked/user/u=' + this.dislockedUser.id,{
                                        method: 'PUT',
                                        headers: {
                                            'X-CSRF-TOKEN': this.token,
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(response => {
                                        if (response.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Déblocage échouée',
                                                text: response.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.success !== undefined) {
                                                this.$store.dispatch('getUsers')
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: response.success,
                                                    showConfirmButton: true,
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                        .then((response) => {
                            if (response.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    text: "Opération réussie! ",
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                })
            },
            deleteUser(user){
                this.deletingUser = user
                Swal.fire({
                  title: "Système de suppression avancée utilisateur/membre",
                  text: "Voulez-vous vraiment supprimer définitivement l'utilisateur " + user.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Supprimer',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Suppression utilisateur : " + this.deletingUser.name,
                            text: 'Opération en cours veuillez patienter...',
                            showCancelButton: true,
                            cancelButtonText: 'Annuler',
                            confirmButtonText: 'Lancer',
                            showLoaderOnConfirm: true,
                            preConfirm: () => {
                                return fetch('/Uvar/administration/tag/utilisateur/' + this.deletingUser.id,{
                                        method: 'DELETE',
                                        headers: {
                                            'X-CSRF-TOKEN': this.token,
                                        },
                                    })
                                    .then(response => response.json())
                                    .then(response => {
                                        if (response.errors !== undefined) {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Suppression échouée',
                                                text: response.errors,
                                                showConfirmButton: false,
                                            })
                                        }
                                        else{
                                            if (response.success !== undefined) {
                                                this.$store.dispatch('getUsers')
                                                this.$store.dispatch('getMembers')
                                                Swal.fire({
                                                    icon: 'success',
                                                    text: response.success,
                                                    showConfirmButton: true,
                                                })
                                            }
                                        }
                                    })
                                    .catch(error => {
                                        Swal.showValidationMessage(
                                            "Erreure serveur"
                                        )
                                    })
                            },
                            allowOutsideClick: () => !Swal.isLoading()
                        })
                        .then((response) => {
                            if (response.isConfirmed) {
                                Swal.fire({
                                    icon: 'success',
                                    text: "Opération réussie! ",
                                    showConfirmButton: true,
                                })
                            }
                        })
                    }
                })
            }

        },

        computed: mapState([
            'users', 'user', 'connected', 'member', 'active_member', 'isLoadedUsers'
        ])
	}
</script>

<style>
  
</style>