<template>
    <div class="row mx-auto w-95 mt-3 profils">
    	<div class="w-100 mx-auto">
            <h3 class="text-white">Les Membres</h3>
            <transition name="bodyfade" appear>
                <div class="mx-auto w-100 text-white text-center my-3" v-if="!isLoadedMembers">
                    <div id="app" class="w-screen h-screen bg-gray-800 flex flex-col justify-center">
                        <div class="container m-auto bg-gray-900 text-center text-white shadow-2xl h-64 flex flex-col justify-center rounded-lg text-3xl">
                          <typical
                            class="vt-title"
                            :steps="['Chargement des membres UVAR en cours...', 1000, 'Veuillez patienter....', 1000]"
                            :wrapper="'h2'"
                          ></typical>
                        </div>
                      </div>
                </div>
            </transition>
            <div class="mx-auto d-flex justify-content-center px-2 w-75" v-if="isLoadedMembers && members.length < 1 ">
                <h5 class="fa-2x text-center border border-white text-white-50 bg-linear-official-50 p-2 w-100 ">
                    OOops aucun membre n'est enregistré
                </h5>
            </div>
            <table class="table table-official text-white" v-if="isLoadedMembers">
                <thead>
                    <th>No</th>
                    <th>Nom et prénoms</th>
                    <th>ID Ref.</th>
                    <th>Email</th>
                    <th>Tél</th>
                    <th>Niveau</th>
                    <th>Pays</th>
                    <th>Actions</th>
                </thead>
                <tbody>
                    <tr v-for="(member, k) in members">
                        <td>{{ k + 1 > 9 ? k + 1 : '0' + (k + 1) }}</td>
                        <td>
                            <router-link :to="{name: 'membersProfil', params: {id: member.id}}"   class="card-link d-inline-block text-white" >
                                <span  class="w-100 d-inline-block link-profiler">
                                    {{member.name}}
                                </span>
                            </router-link>
                        </td>
                        <td>{{ member.IDENTIFY }}</td>
                        <td>{{ member.email }}</td>
                        <td>{{ member.phone }}</td>
                        <td>{{ member.level }}</td>
                        <td>{{ member.country }}</td>
                        <td class="text-center">
                            <span v-if="!member.user.confirmation_token" style="font-size: 1.2rem;" @click="lockMember(member.user)" class="fa fa-lock p-2 mr-1 cursor text-warning" :title="'Bloquer ' + member.name " ></span>
                            <span v-if="member.user.confirmation_token && member.user.confirmation_token == 'locked'" style="font-size: 1.2rem;" @click="dislockMember(member.user)" class="fa fa-unlock p-2 mr-1 cursor text-success" :title="'Déverouiller ' + member.name " ></span>
                            <span style="font-size: 1.2rem;" @click="deleteMember(member.user)" class="p-2 fa fa-user-times  cursor text-danger" :title="'Supprimer ' + member.name "></span>
                            <span style="font-size: 1.2rem;" @click="sendEmail(member.user)" class="p-2 fa fa-envelope cursor text-primary" :title="'envoyez un mail à ' + member.name "></span>
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
           this.$store.dispatch('getMembers')
        },
        mounted(){
            
        },
        methods :{
           lockMember(user){
                this.lockedUser = user
               
                Swal.fire({
                  title: "Système de verrouillage utilisateur/membre",
                  text: "Voulez-vous vraiment verrouiller le membre " + user.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Verrouiller',
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
                                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
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
            dislockMember(user){
                this.dislockedUser = user
                Swal.fire({
                  title: "Système de déblocage utilisateur/membre",
                  text: "Voulez-vous vraiment débloquer l'utilisateur " + user.name + " ?",
                  icon: 'question',
                  showCancelButton: true,
                  confirmButtonColor: '#3085d6',
                  cancelButtonColor: '#d33',
                  confirmButtonText: 'Déverrouiller',
                  cancelButtonText: 'Avorter',
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: "Déblocage utilisateur : " + this.dislockedUser.name,
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
            deleteMember(user){
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
            'users', 'user', 'connected', 'member', 'active_member', 'token', 'members', 'isLoadedMembers'
        ])
	}
</script>

<style>
  
</style>