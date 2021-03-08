<template>
	<div class="setMemberImage">
	<div class="modal fade" id="setMemberImage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
      <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content bg-linear-official-50 border border-white">
            <div class="modal-header tit-up">
                <div class="w-100 d-flex justify-content-between pr-3">
                    <button type="button" class="close mt-2 mr-2 text-white-50" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 v-if="connected && active_member && active_member.id !== null" class="modal-title text-white">Edition de la photo de profil de {{active_member.name}}</h4>
                </div>
            </div>
            <div class="modal-body">
                <form role="form" class="form-horizontal" enctype="multipart/form-data">
                    <div class="form-group">
                        <div class="col-sm-12">
                            <input @change="imageChanged" class="form-control custom-file" type="file">
                        </div>
                    </div>
                    <div class="row px-3">                           
                        <div class="col-sm-9">
                            <button type="button"class="btn btn-primary border border-white py-2 px-3 btn-radius w-25" @click="updateMemberPhoto()">
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
                photo: {
                    member: '',
                    image: '',
                }
            }
        },
        
        created(){
           // this.$store.dispatch('getMember', this.$route.params.id)
        },
        methods :{

            imageChanged(e){
                let fileReader = new FileReader()

                fileReader.readAsDataURL(e.target.files[0])

                fileReader.onload = (e) =>{
                    this.photo.image = e.target.result
                }
            },
            
           updateMemberPhoto(){
                this.photo.member = this.active_member
                this.$store.commit('RESET_INVALIDS_MEMBER_EDIT', {})
                this.$store.dispatch('updateMemberPhoto', {data: this.photo})
           }
            
        },

        computed: mapState([
            'invalids', 'user', 'memberPhoto', 'member', 'active_member', 'connected', 'invalidsEditMember', 'editingMember'
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