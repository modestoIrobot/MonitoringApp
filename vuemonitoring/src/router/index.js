import Vue from 'vue'
import VueRouter from 'vue-router'
import Home from '../views/Home.vue'
import { RedirectChoice } from '../control/RedirectChoice'
import store from '../store/index.js'

Vue.use(VueRouter)

const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'about',
    meta: {
      auth: true
    },
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/signup',
    name: 'SignUp',
    component: () => import('../views/SignUp.vue')
  },
  {
    path: '/signin',
    name: 'SignIn',
    component: () => import('../views/SignIn.vue')
  },
  {
    path: '/ForgotPassword',
    name: 'ForgotPassword',
    component: () => import('../views/ForgotPassword.vue')
  },
  {
    path: '/AuthorisedRights',
    name: 'Nonauthorised',
    component: () => import('../views/Rights.vue')
  },
  {
    path: "*",
    name: 'pagenotfound',
    component: () => import('../views/404.vue')
  },
  {
    path: '/UserBoard', 
    name: 'UserBoard',
    component: () => import('../views/UserBoard.vue'),
    beforeEnter:RedirectChoice,
    meta: {
      auth: true, 
      permission: route => { return store.getters.getPermission; }
    },
    children: [
      {
        path: 'Projects', 
        name: 'projects',
        component: () => import('../views/ProjectsUser.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        } 
      },
      {
        path: 'ProjectsDev', 
        name: 'devs',
        component: () => import('../views/UserProjects.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        }
      },
      {
        path: 'Projects/:id(\\d+)/:id2(\\d+)',
        name: 'projectuser',
        component: () => import('../views/ProjectUser.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; },
          rights: route => { return store.getters.getRights; }
        }
      },
      {
        path: 'Projects/create',
        name: 'createProject',
        component: () => import('../views/CreateProject.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        }
      },
      {
        path: 'Projects/:id(\\d+)/Pages/:id2(\\d+)',
        name: 'pageuser',
        component: () => import('../views/PageUser.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        }
      },
      {
        path: 'Projects/:id(\\d+)/Interfaces/:id2(\\d+)',
        name: 'interfaceuser',
        component: () => import('../views/InterfaceUser.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        } 
      },
      {
        path: 'Projects/:id(\\d+)/Pages/:id2(\\d+)/widget/:id4(\\d+)',
        name: 'widgetuser',
        component: () => import('../views/WidgetUser.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        }
      }
    ]
  },
  {
    path: '/AdminBoard',
    name: 'AdminBoard',
    component: () => import('../views/AdminBoard.vue'),
    beforeEnter:RedirectChoice,
    meta: {
      auth: true, 
      permission: route => { return store.getters.getPermission; } 
    },
    children: [
      {
        path: 'ProjectsUsers', 
        name: 'listprojects',
        component: () => import('../views/AllProjects.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        } 
      },
      {
        path: 'Project/:id(\\d+)/:id2(\\d+)', 
        name: 'projectDev',
        component: () => import('../views/ManageProject.vue'),
        meta: {
          auth: true,
          permission: route => { return store.getters.getPermission; }
        } 
      }
    ]
  }
]

const router = new VueRouter({
  mode: 'history',
  base: process.env.BASE_URL,
  routes
})

router.beforeEach((to, from, next) => {
  const loggedIn = localStorage.getItem('user');
  if (to.matched.some(record => record.meta.auth) && !loggedIn) {
    next('/SignIn')
    return
  }
  next()
})

export default router
