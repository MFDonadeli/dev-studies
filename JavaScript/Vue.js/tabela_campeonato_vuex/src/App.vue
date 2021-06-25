<template>
  <div id="app" class="container">
    <app></app>
  </div>
</template>

<script>
import app from './components/app.component.vue';
import store from './store';

export default {
  components: {
        app
    },
    data () {
    return {
      times: [
        require('./assets/palmeiras_60x60.png'),
        require('./assets/flamengo_60x60.png'),
        require('./assets/atletico_mg_60x60.png'),
        require('./assets/santos_60x60.png'),
        require('./assets/botafogo_60x60.png'),
        require('./assets/atletico-pr_60x60.png'),
        require('./assets/corinthians_60x60.png'),
        require('./assets/gremio_60x60.png'),
        require('./assets/fluminense_60x60.png'),
        require('./assets/ponte_preta_60x60.png'),
        require('./assets/chapecoense_60x60.png'),
        require('./assets/sao_paulo_60x60.png'),
        require('./assets/cruzeiro_60x60.png'),
        require('./assets/sport_60x60.png'),
        require('./assets/coritiba_60x60.png'),
        require('./assets/internacional_60x60.png'),
        require('./assets/vitoria_60x60.png'),
        require('./assets/figueirense_60x60.png'),
        require('./assets/santa_cruz_60x60.png'),
        require('./assets/america_mg_60x60.png'),
        require('./times.json')
      ],
    }
  },
}
</script>


