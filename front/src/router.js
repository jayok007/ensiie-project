import Vue from 'vue'
import Router from 'vue-router'
import TheHome from './views/TheHome.vue'
import store from './store'

Vue.use(Router)

const ifNotAuthenticated = (to, from, next) => {
  if (!store.getters.isAuthenticated) {
    return next()
  }
  next('/')
}

const ifAuthenticated = (to, from, next) => {
  if (store.getters.isAuthenticated) {
    return next()
  }
  next('/')
}

export default new Router({
  mode: 'history',
  routes: [
    {
      path: '*',
      redirect: '/'
    },
    {
      path: '/',
      name: 'home',
      component: TheHome
    },
    {
      path: '/search',
      name: 'search',
      props: route => ({ query: route.query }),
      component: () => import('./views/TheSearch.vue'),
      beforeEnter: (to, _, next) => {
        const query = to.query.q

        if (query && query.trim()) {
          next()
        } else {
          next('/')
        }
      }
    },
    {
      path: '/signin',
      name: 'signin',
      component: () => import('./views/TheSignIn.vue'),
      beforeEnter: ifNotAuthenticated
    },
    {
      path: '/signup',
      name: 'signup',
      component: () => import('./views/TheSignUp.vue'),
      beforeEnter: ifNotAuthenticated
    },
    {
      path: '/me',
      name: 'me',
      component: () => import('./views/TheMe.vue'),
      beforeEnter: ifAuthenticated
    }
  ]
})
