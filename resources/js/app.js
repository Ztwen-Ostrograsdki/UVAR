/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

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
let members_listing_tables = Vue.component('listing-tables', require('./components/Admin/ListingTables.vue').default)





//MEMBERS
let members = Vue.component('member-options', require('./components/Members/ProfilOptions.vue').default)
let members_profil = Vue.component('members-profil', require('./components/Members/MainMemberProfil.vue').default)


//CAROUSSELS
let home_caroussel = Vue.component('home-caroussel', require('./components/Home/HomeCarousselComponent.vue').default)
let horizontal_home_caroussel = Vue.component('horizontal-home-caroussel', require('./components/Home/HorizontalHomeCaroussel.vue').default)


//Formulars
let registred = Vue.component('registred', require('./components/Formulars/RegistredComponent.vue').default)
let exemple = Vue.component('exemple', require('./components/ExampleComponent.vue').default)
let formulars = Vue.component('formulars', require('./components/Home/Formulars.vue').default)

//CONFIRMATIONS

let confirm_registration = Vue.component('confirm-registration', require('./components/confirmations/ConfirmationRegistration.vue').default)


//SUCCESS
let successConnected = Vue.component('success-connected', require('./components/confirmations/SuccessConnected.vue').default)





const routes = [
	
	{
		path: '/',
		component: home_page,
		children: [
				{
					path: '/',
					component: welcomes,
					name: 'welcomes',
				},
				{
					path: '/profil',
					component: members_profil,
					name: 'members-profil',
				},
		]
	},
	{
		path: '/Uvar/administration',
		component: main_admin,
		children: [
				{
					path: '/',
					component: admin_default,
					name: 'adminDefault',
				},
				{
					path: '/Uvar/administration/tag/membres',
					component: members_listing_tables,
					name: 'membersListing',
				},
		]
	},

	
]





const router = new VueRouter({mode: 'history', routes})
new Vue({
	store,
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

