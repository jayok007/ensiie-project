import { user } from './user'
import { bar } from './bar'
import { keyword } from './keyword'
import { login } from './login'

const api = {
  ...user,
  ...bar,
  ...keyword,
  ...login,

  searchRequest () {
    return new Promise((resolve, reject) => {
      setTimeout(() => {
        bar.getBars()
          .then(resolve)
          .catch(reject)
      }, 1000)
    })
  }
}

export default {
  install (Vue) {
    Vue.prototype.$api = api
  }
}
