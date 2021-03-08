import Vue from 'vue'
import VueRouter from 'vue-router'


const routes = [
	
	{
		path: '/admin/director/master',
		component: admin_defaultDashboard,
		name: 'adminHome'
	},
	{
		path: '/admin/director/master/dashboards/emplois-du-temps',
		component: dashboard_plan,
		name: 'dashboard_plan',
	},

	{
		path: '/admin/director/pupilsm',
		component: pupils_home,
		name: 'pupilsIndex',
		children: [
			{
				path: '/admin/director/pupilsm',
				component: listing_pupils,
				name: 'pupilsListing',
			},
			{
				path: '/admin/director/pupilsm/redList',
				component: pupils_redList,
				name: 'pupilsRedList'

			},
			{
				path: '/admin/director/pupilsm/:id',
				component: pupils_profil,
				name: 'pupilsProfil',
				store
				
			},
		]
	},
	
]













export default new VueRouter({mode: 'history', routes})
