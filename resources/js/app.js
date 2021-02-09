/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;
import Swal from 'sweetalert2'
import VueRouter from 'vue-router'
import store from './stores/store.js'
// import routes from './routes/routers.js'
Vue.use(VueRouter)

//HOME PAGES
let welcomes = Vue.component('welcomes', require('./components/Home/WelcomeComponent.vue').default)
let home_page = Vue.component('acceuil', require('./components/Home/HomeComponent.vue').default)
let nav_bar = Vue.component('navbar', require('./components/Home/NavbarComponent.vue').default)
let a_la_une = Vue.component('a-la-une', require('./components/Home/AlaUneContainer.vue').default)
let home_search_bar = Vue.component('home-search-bar', require('./components/Home/HomeSearchComponent.vue').default)
let home_counter = Vue.component('home-counter', require('./components/Home/HomeCounter.vue').default)
let home_footer = Vue.component('home-footer', require('./components/Home/HomeFooter.vue').default)

//ADMINISTRATION
let dashboard_admin = Vue.component('admin-dashboard', require('./components/Admin/Dashboard.vue').default)
let main_admin = Vue.component('main-admin', require('./components/Admin/Main.vue').default)
let admin_default = Vue.component('admin-default', require('./components/Admin/Default.vue').default)


//USERS
let users_listing = Vue.component('users-listing', require('./components/users/Listing.vue').default)



//MEMBERS
let members = Vue.component('member-options', require('./components/Members/ProfilOptions.vue').default)
let members_profil = Vue.component('members-profil', require('./components/Members/MainMemberProfil.vue').default)
let members_listing = Vue.component('members-listing', require('./components/Members/Listing.vue').default)
let members_profil_admin = Vue.component('members-profil-admin', require('./components/Admin/MemberProfil.vue').default)
let members_properties = Vue.component('members-properties', require('./components/Members/Properties.vue').default)


//ACTIONS
let actions_listing = Vue.component('actions-listing', require('./components/Actions/Listing.vue').default)
let action_profil = Vue.component('actions-profil', require('./components/Actions/Profil.vue').default)

//PRODUCTS
let products_listing = Vue.component('products-listing', require('./components/Products/Listing.vue').default)
let product_profil = Vue.component('products-profil', require('./components/Products/Profil.vue').default)

//CATEGORIES
let categories_listing = Vue.component('categories-listing', require('./components/Category/Listing.vue').default)
let categories_profil = Vue.component('categories-profil', require('./components/Category/Profil.vue').default)


//CAROUSSELS
let home_caroussel = Vue.component('home-caroussel', require('./components/Home/HomeCarousselComponent.vue').default)
let horizontal_home_caroussel = Vue.component('horizontal-home-caroussel', require('./components/Home/HorizontalHomeCaroussel.vue').default)


//Formulars
let edit_member_data = Vue.component('edit-member-data', require('./components/Formulars/Members/EditData.vue').default)
let edit_member_photo = Vue.component('edit-member-photo', require('./components/Formulars/Members/SetImage.vue').default)
let affiliation = Vue.component('affiliation', require('./components/Formulars/Members/Affiliations.vue').default)
let registration = Vue.component('registration', require('./components/Formulars/Users/Registration.vue').default)
let loginer = Vue.component('loginer', require('./components/Formulars/Connexions/Loginer.vue').default)
let registred = Vue.component('registred', require('./components/Formulars/Users/RegistredComponent.vue').default)
let formulars = Vue.component('formulars', require('./components/Home/Formulars.vue').default)
let edit_action = Vue.component('edit-action', require('./components/Formulars/Actions/EditAction.vue').default)

//NOTIFICATIONS
let notifications = Vue.component('notifications', require('./components/Notifications/Listing.vue').default)
let requests = Vue.component('requests', require('./components/Notifications/Requests.vue').default)

//MARKETS
let actions_shop_default = Vue.component('action-shop-default', require('./components/Market/Actions/Listing.vue').default)


//CONFIRMATIONS

let confirm_registration = Vue.component('confirm-registration', require('./components/confirmations/ConfirmationRegistration.vue').default)


//SUCCESS
let successConnected = Vue.component('success-connected', require('./components/confirmations/SuccessConnected.vue').default)





const routes = [
	
	{
		path: '/',
		store,
		component: home_page,
		children: [
				{
					path: '/',
					component: welcomes,
					name: 'welcomes',
				},
				{
					path: '/boutique/q=actions',
					component: actions_shop_default,
					name: 'actions_shop_default',
				},
		]
	},
	{
		path: '/Uvar/administration',
		store,
		component: main_admin,
		children: [
				{
					path: '/',
					component: admin_default,
					name: 'adminDefault',
				},
				{
					path: '/Uvar/administration/tag/utilisateur',
					component: users_listing,
					name: 'usersListing',
				},
				{
					path: '/Uvar/administration/tag/membres',
					component: members_listing,
					name: 'membersListing',

				},
				{
					path: '/Uvar/administration/tag/membres/:id',
					component: members_profil_admin,
					name: 'membersProfilOnAdmin',
					store
				},
				{
					path: '/Uvar/membres/:id',
					component: members_profil,
					name: 'membersProfil',
					store
				},
				{
					path: '/Uvar/administration/tag/actions',
					component: actions_listing,
					name: 'actionsListing',
				},
				{
					path: '/Uvar/administration/tag/produits',
					component: products_listing,
					name: 'productsListing',
				},
				{
					path: '/Uvar/administration/tag/categories',
					component: categories_listing,
					name: 'categoriesListing',
				},
				{
					path: '/Uvar/administration/tag/notifications',
					component: notifications,
					name: 'notifications',
				},
				{
					path: '/Uvar/administration/tag/demandes',
					component: requests,
					name: 'requests',
				},
		]
	},
]





const router = new VueRouter({mode: 'history', routes})
new Vue({
	store,
	file: '',
	router: router,
	el: ".app",
	components: {
		nav_bar,
		main_admin
		
	}
})

window._ = require('lodash');
window.Popper = require('popper.js').default;
try {
    window.$ = window.jQuery = require('jquery');
    require('bootstrap');
} catch (e) {}

