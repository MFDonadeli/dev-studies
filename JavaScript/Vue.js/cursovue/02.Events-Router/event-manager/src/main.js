import Vue from "vue";
import App from "./App.vue";
import router from "./router";
import store from "./store";
/*
This is how to import one component globally, but when we want to add lots of components this will be a pain
import BaseIcon from '@/components/BaseIcon.vue';
Vue.component('BaseIcon', BaseIcon); //name and imported var. Now BaseIcon is global */

import upperFirst from 'lodash/upperFirst'
import camelCase from 'lodash/camelCase'

//This will find files on components directory
const requireComponent = require.context(
  './components',
  false,
  /Base[A-Z]\w+\.(vue|js)$/
)

//will iterate through files found on that components directory
requireComponent.keys().forEach(fileName => {
  const componentConfig = requireComponent(fileName)

  const componentName = upperFirst(
    camelCase(fileName.replace(/^\.\/(.*)\.\w+$/, '$1'))
  )

  Vue.component(componentName, componentConfig.default || componentConfig)
})

Vue.config.productionTip = false;

new Vue({
  router,
  store,
  render: h => h(App)
}).$mount("#app");
