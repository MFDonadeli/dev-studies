import axios from 'axios'
//import NProgress from 'nprogress' // <--- progressbar library

const apiClient = axios.create({
  baseURL: `http://localhost:3000`,
  withCredentials: false, // This is the default
  headers: {
    Accept: 'application/json',
    'Content-Type': 'application/json'
  },
  timeout: 15000
})
/*
apiClient.interceptors.request.use(config => { // Intercepts on request
  NProgress.start()
  return config
})
apiClient.interceptors.response.use(response => { // Intercepts on response
  NProgress.done()
  return response
})*/

export default {
  getEvents(perPage, page) {
    return apiClient.get('/events?_limit=' + perPage + '&_page=' + page)
  },
  getEvent(id) {
    return apiClient.get('/events/' + id)
  },
  postEvent(event) {
    return apiClient.post('/events', event)
  }
}
