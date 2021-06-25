import Vue from 'vue'
//import App from './App.vue'

new Vue({
  el: '#app',
  //render: h => h(App)
  data: {
    título: "Minha primeira aplicação Vue.js 2",
    bool: true,
    numeroInteiro: 10,
    numeroFloat: 20.10,
    objeto: {
        name: "Luiz Carlos"
      },
    link: "http://localhost:8080"
  } 
})
