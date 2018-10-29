import axios from 'axios'

export const user = {
  getUserInfo (id) {
    return axios.get(`/api/users/${id}`)
      .then(res => res.data)
  },
  signup (user) {
    return axios.post('/api/users', user)
  }
}
