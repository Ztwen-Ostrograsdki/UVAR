<template>
	<div class="w-100 mx-auto d-flex justify-content-center flex-column" v-if="isLoadedMember" >
		<div class="w-95 mx-auto oneProperty" v-if="active == 'referies'">
			<div class="d-inline float-right">
				<span data-toggle="modal" data-target="#affiliations" class="mr-4 fa fa-plus fa-2x text-official"></span>
				<h5 class="text-official d-inline mx-2 fa-2x text-right">{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} Affiliés </h5>
			</div>
			<div class="row w-100 mx-auto">
				<div class="col-12 border my-1 row p-0 m-0" v-for="referee in myReferies">
					<div class="w-100 mx-auto d-flex justify-content-between p-0">
						<div class="p-0 float-left" style="height: auto !important; width:30%;">
							<div class="w-100 p-0 m-0 float-left h-100">
								<img class="p-0 m-0 float-left w-100 h-100" src="/photo/ph1.jpg">
							</div>
						</div>
						<div style="width:70%;">
							<div class="w-100 mx-auto">
								<table class="table table-borderless ml-3 text-white-50 mt-2 table-propertises">
                                    <tr>
                                        <td>Nom :</td>
                                        <td> {{ referee.name }} </td>
                                    </tr>
                                    <tr>
                                        <td>Sexe :</td>
                                        <td>{{ referee.sexe == 'female' ? 'Féminin' : 'Masculin'}}</td>
                                    </tr>
                                    <tr>
                                        <td>Inscrit le :</td>
                                        <td>{{ getCreatedAt(referee.created_at) }}</td>
                                    </tr>
                                     <tr>
                                        <td>Email :</td>
                                        <td>{{ referee.email }}</td>
                                    </tr>
                                    <tr>
                                        <td>Pays :</td>
                                        <td>{{ referee.country}}</td>
                                    </tr>
                                    <tr>
                                        <td>No Tél :</td>
                                        <td>{{ referee.phone }}</td>
                                    </tr>
                                    <tr>
                                        <td>Level :</td>
                                        <td>{{ referee.level }}</td>
                                    </tr>
                                </table>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="w-95 mx-auto oneProperty" v-if="active == 'actions'">
			<div class="w-100 d-flex justify-content-end">
			<router-link title="Acheter plus d'actions" class="mr-4 fa fa-plus fa-2x text-official" :to="{name: 'shop_home_actions'}"></router-link>
				<h5 class="text-official fa-2x">{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} Actions </h5>
			</div>
			<div class="row w-100 mx-auto">
				<div class="col-12 border my-1 row m-0 p-0" v-if="action.shop !== undefined" v-for="action in myActions">
                    <div class="w-100 mx-auto d-none d-sm-flex justify-content-between p-0">
                        <div class="w-25 p-0 float-left" style="height: auto !important;">
                            <div class="w-100 p-0 m-0 float-left h-100">
                                <img v-if="action.images.length < 1" class="p-0 m-0 w-100 h-100" src="/photo/ph2.jpg">
                                <img v-if="action.images.length > 0" class="p-0 m-0 w-100 h-100" :src="'/images/'+ getProfilPath(action.images)">
                            </div>
                        </div>
                        <div class="w-75">
                            <div class="w-100 mx-auto">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official d-inline-block p-0 m-0 mb-1">
                                            <router-link v-if="user && member && active_member && user.role =='admin'" :to="{name: 'actionProfil', params: {id: action.action.id}}"   class="card-link d-inline-block w-100 text-official" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{action.action.name}}
                                                </span>
                                            </router-link>
                                            <span v-if="user && user.role !== 'admin'">
                                                {{action.action.name}}
                                            </span>
                                        </h4> 
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(action.action.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(action.action.price).toAr }}</span>
                                            
                                        </h4>
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{action.action.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                            Achetée le : {{ getCreatedAt(action.shop.created_at) }}
                                        </span>
                                        <span class="d-inline-block text-white-50 float-right text-white-50">
                                            <span class="float-right mr-2">
                                                <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editAction" @click="setEditingAction(action.action)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                                <span class="d-inline-block text-white-50 float-right text-white-50">
                                                    Actionnaire : {{ action.action.actionnary == null ? 'UVAR' : action.action.actionnary }}
                                                </span>
                                            </span>
                                            
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>

                    <div class="w-100 mx-auto d-flex d-sm-none justify-content-between p-0">
                        <div class="w-100 m-0 p-0">
                        <transition name="scalefade" appear>
                            <div title="Double cliquer pour masquer l'image" @dblclick="hideActionImage()" v-if="showActionImage && profilActionID  && profilActionID == action.action.id" class="w-100 p-0 m-0 float-left h-100">
                              <img v-if="action.images.length < 1" class="p-0 m-0 w-100 h-100" src="/photo/ph2.jpg">
                                <img v-if="action.images.length > 0" class="p-0 m-0 w-100 h-100" :src="'/images/'+ getProfilPath(action.images)">
                            </div>
                        </transition>
                        <div class="w-100" v-if="profilActionID !== action.action.id">
                            <div class="w-100 mx-auto">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official d-inline-block p-0 m-0 mb-1">
                                            <router-link v-if="user && member && active_member && user.role =='admin'" :to="{name: 'actionProfil', params: {id: action.action.id}}"   class="card-link d-inline-block w-100 text-official" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{action.action.name}}
                                                </span>
                                            </router-link>
                                            <span v-if="user && user.role !== 'admin'">
                                                {{action.action.name}}
                                            </span>
                                        </h4> 
                                        <h5 class="text-white d-inline-block float-right" title="Afficher l'action">
                                            <span @click="displayActionImage(action.action)" v-if="!showProductImage || (showActionImage && profilActiontID !== action.action.id)" class="fa cursor fa-chevron-down"></span>
                                        </h5>  
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(action.action.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(action.action.price).toAr }}</span>
                                        </h4>
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{action.action.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                           Achetée le : {{ getCreatedAt(action.shop.created_at) }}
                                        </span>
                                        <span class="d-inline-block text-white-50 float-right text-white-50">
                                            <span class="float-right mr-2">
                                                <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editAction" @click="setEditingAction(action.action)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                                <span class="d-inline-block text-white-50 float-right text-white-50">
                                                    Actionnaire : {{ action.action.actionnary == null ? 'UVAR' : action.action.actionnary }}
                                                </span>
                                            </span>
                                            
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>
                </div>
				</div>
			</div>
		</div>
		<div class="w-95 mx-auto oneProperty" v-if="active == 'products'">
			<div class="w-100 d-flex justify-content-end m-0">
				<router-link title="Acheter plus d'articles" class="mr-4 fa fa-plus fa-2x text-official" :to="{name: 'shop_home_products'}"></router-link>
				<h5 class="text-official fa-2x">{{ user.id == member.user_id ? 'Mes ' : ' Ses '}} Achats </h5>
			</div>
			<div class="row w-100 mx-auto m-0">
				<div class="col-12 border my-1 row m-0 p-0" v-if="product.shop !== undefined" v-for="product in myProducts">
                    <div class="w-100 mx-auto d-none d-sm-flex justify-content-between p-0">
                        <div class="w-25 p-0 float-left" style="height: auto !important;">
                            <div class="w-100 p-0 m-0 float-left h-100">
                               <img v-if="product.images.length < 1" class="p-0 m-0 float-left w-100 h-100" src="/photo/ph2.jpg">
                                <img v-if="product.images.length > 0" class="p-0 m-0 float-left w-100 h-100" :src="'/images/'+ getProfilPath(product.images)">
                            </div>
                        </div>
                        <div class="w-75">
                            <div class="w-100 mx-auto">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official p-0 m-0 mb-1">
                                            <router-link v-if="user && member && active_member && user.role =='admin'" :to="{name: 'productProfil', params: {id: product.product.id}}"   class="card-link d-inline-block w-100 text-official" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{product.product.name}}
                                                </span>
                                            </router-link>
                                            <span v-if="user && user.role !== 'admin'">
                                                {{product.product.name}}
                                            </span>
                                        </h4>  
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(product.product.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(product.product.price).toAr }}</span>
                                        </h4>
                                        
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{product.product.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                            Acheté le : {{ getCreatedAt(product.shop.created_at) }}
                                        </span>
                                        <span class="float-right mr-2">
                                            <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editProduct" @click="setEditingProduct(product.product)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                            <span class="d-inline-block text-white-50 float-right text-white-50">
                                             Actionnaire : UVAR
                                            </span>
                                        </span>
                                    </div>
                                </div>                                    
                            </div>
                        </div>
                    </div>


                    <div class="w-100 mx-auto d-flex d-sm-none justify-content-between p-0">
                        <div class="w-100">
                            <transition name="scalefade" appear>
                                <div title="Double cliquer pour masquer l'image" @dblclick="hideProductImage()" v-if="showProductImage && profilProductID  && profilProductID == product.product.id" class="w-100 p-0 m-0 float-left h-100">
                                   <img v-if="product.images.length < 1" class="p-0 m-0 float-left w-100 h-100" src="/photo/ph2.jpg">
                                <img v-if="product.images.length > 0" class="p-0 m-0 float-left w-100 h-100" :src="'/images/'+ getProfilPath(product.images)">
                                </div>
                            </transition>
                            <div class="w-100 mx-auto" v-if="profilProductID !== product.product.id">
                                <div class="w-100 d-flex justify-content-between flex-column">
                                    <div class="w-100 p-2">
                                        <h4 class="text-official d-inline-block p-0 m-0 mb-1">
                                            <router-link v-if="user && member && active_member && user.role =='admin'" :to="{name: 'productProfil', params: {id: product.product.id}}"   class="card-link d-inline-block w-100 text-official" >
                                                <span  class="w-100 d-inline-block link-profiler">
                                                    {{product.product.name}}
                                                </span>
                                            </router-link>
                                            <span v-if="user && user.role !== 'admin'">
                                                {{product.product.name}}
                                            </span>
                                            
                                        </h4> 
                                        <h5 class="text-white d-inline-block float-right" title="Afficher l'article">
                                            <span @click="displayProductImage(product.product)" v-if="!showProductImage || (showProductImage && profilProductID !== product.product.id)" class="fa cursor fa-chevron-down"></span>
                                        </h5> 
                                        <h4 class="fa-1x p-0 m-0">
                                            <span class="text-secondary">{{ getPrice(product.product.price).toFrancs }}</span>
                                            <span class="text-official">||</span>
                                            <span class="text-warning">{{ getPrice(product.product.price).toAr }}</span>
                                            
                                        </h4>
                                        <hr class="w-100 bg-official p-0 m-0">
                                    </div>
                                    <div class="w-90">
                                        <p class="text-white p-2">
                                            {{product.product.description}}
                                        </p>
                                        <span class="d-inline-block ml-2 text-white-50 float-left text-secondary">
                                            Acheté le : {{ getCreatedAt(product.shop.created_at) }}
                                        </span>
                                        <span class="float-right mr-2">
                                            <span v-if="user.role == 'admin'" style="font-size: 19px;" data-toggle="modal" data-target="#editProduct" @click="setEditingProduct(product.product)" class="d-inline-block text-white-50 float-right mx-2 cursor text-white-50 fa fa-edit"></span>
                                            <span class="d-inline-block text-white-50 float-right text-white-50">
                                             Actionnaire : UVAR
                                            </span>
                                        </span>
                                    </div>
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
		props : ['active'],
        data() {
            return {
            	options : false,
                actions : true,
                shop : true,
                showProductImage : false,
                showActionImage : false,
                profilProductID: null,
                profilActionID: null,
                referies : true,
                selfMonths : [
                    "Janvier",
                    "Février",
                    "Mars",
                    "Avril",
                    "Mai",
                    "Juin",
                    "Juillet",
                    "Août",
                    "Septembre",
                    "Octobre",
                    "Novembre",
                    "Décembre"

                ],
                levels : {
                    level_1: 'First',
                    level_2: 'Better',
                    level_3: 'Third',
                    level_4: 'Master',
                    beginner: 'Amateur',
                }
            }
                
        },
		
        created(){
        },
        mounted(){
            
        },
        methods :{
        	getProfilPath(images){
                let path = ''
                if (images.length > 0) {
                    let name = images[0].name
                    path = name
                }

                return path

            },
        	displayProductImage(product){
                this.showProductImage = true
                this.profilProductID = product.id
            },
            hideProductImage(){
                this.showProductImage = false
                this.profilProductID = null
            },
             displayActionImage(action){
                this.showActionImage = true
                this.profilActionID = action.id
            },
            hideActionImage(){
                this.showActionImage = false
                this.profilActionID = null
            },

        	getCreatedAt(created_at){
                if (created_at !== null) {
                    let date = created_at
                        let parts = (date.split("-"))
                        let year = parts[0]
                        let month = parts[1]
                        let day = parts[2].substring(0, 2)
                        let times = ((parts[2].split('T'))[1]).split(':')
                        let hour = times[0] + 'H'
                        let min = times[1] + "'"

                        
                        month = Number(month) - 1

                        return day + " " + this.selfMonths[month] + " " + year + " à " + hour +  " " + min
                }
                else{
                    return "inconnue"
                }

            },
            getLeveler(level){
                level = level.replace('-', '_')
                return this.levels[level]
            },
            getPrice(price){
                let solde = Number(price)
                return {toFrancs: new Intl.NumberFormat().format(solde) + " FCFA", toAr: new Intl.NumberFormat().format(this.toARcoins(solde)) + " AR"}
            },
            toARcoins(price){
                let ar = 0.00
                ar = Number.parseFloat(price/1000).toFixed(2)
                return ar
            },
            
        },

        computed: mapState([
            'member', 'connected', 'user', 'myActions', 'active_member', 'myAccount', 'myReferer', 'myReferies', 'myProducts', 'myBonuses', 'memberReady', 'isLoadedMember'
        ])
	}
</script>
<style>
	.table-propertises table tr td{
        margin: 2px 0px 2px 0px;
        padding: 3px 0 3px 0px;
    }

    .table-propertises table tr{
        padding: 2px !important;
    }
</style>