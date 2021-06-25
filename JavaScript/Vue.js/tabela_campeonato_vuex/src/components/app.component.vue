<template>
  <div id="app" class="container">
    <div class="row">
      <h3>Campeonato Brasileiro - Série A - 2016</h3>
      <a class="btn btn-primary" @click="showTabela">Ver tabela</a>
      <a class="btn btn-primary" @click="showNovoJogo">Novo jogo</a>
      <a class="btn btn-primary" @click="showZona">Ver zonas</a>
      <div v-show="view == 'tabela'">
          <timelist></timelist>
      </div>
      <div v-if="view == 'novojogo'">
          <timejogo></timejogo>
      </div>
      <div v-if="view == 'zona'">
          <timezona></timezona>
      </div>
      </div> <!-- novoJogo -->
    </div><!-- div row -->

  </div>
</template>

<script>
import timelist from './time-list.component.vue';
import timejogo from './time-jogo.component.vue';
import timezona from './time-zona.component.vue';
import store from '../store';

export default {
  components: {
        timelist,
        timejogo,
        timezona
    },
  computed: {
    view(){
        return store.state.view;
    }
  },
  methods: {
    showNovoJogo(){
        store.commit('show-time-novojogo');
    },
    showTabela(){
        store.commit('show-time-list');
    },
    showZona(){
        store.commit('show-time-zona');
    },
  },
}
</script>


