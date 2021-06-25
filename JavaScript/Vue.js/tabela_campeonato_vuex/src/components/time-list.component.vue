<template>
<div>
    <input type="text" class="form-control" v-model="filter">
    <table class="table table-striped">
        <thead>
        <tr>
        <th v-for="coluna in colunas">
            <a href="#" @click.prevent="sortBy(coluna)">{{coluna | ucwords}}</a> <!-- Primeiro o parametro e depois o nome do filtro -->
        </th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="(time,index) in timesFiltered" :class="{'success': index < 3, 'warning': index > 2 && index <6, 'danger': index > 15}"> <!-- Variável que vem do computed -->
            <td>
            <img :src="time.escudo" :alt="time.nome" style="height: 30px; width: 30px;">
            <strong>{{ time.nome }}</strong>
            </td>
            <td class="text-center">{{ time.pontos }}</td>
            <td class="text-center">{{ time.gm }}</td>
            <td class="text-center">{{ time.gs }}</td>
            <td class="text-center">{{ time | saldo }}</td> <!-- Primeiro o parametro do filtro depois o nome do filtro -->
        </tr>
        </tbody>
    </table>
</div>    
</template>

<script>
import _ from 'lodash';
import '../filter';
import store from '../store';

export default {
  data () {
    return {
      colunas: [ 'nome', 'pontos', 'gm', 'gs', 'saldo'],
      order: {
        keys: ['pontos', 'gm', 'gs'],
        sort: ['desc', 'desc', 'asc']
      },
      filter: '',
    }
  },
  created() {
    store.dispatch('load-times');  
  },
  methods: {
    showNovoJogo(){
      store.commit('show-time-novojogo');
    },
    sortBy(coluna){
      this.order.keys = coluna;
      this.order.sort = this.order.sort == 'desc' ? 'asc': 'desc';
    }
  },
  computed: {
    times(){
      return store.state.times;
    },
    timesFiltered(){
      let colecao = _.orderBy(this.times, this.order.keys, this.order.sort);

      return _.filter(colecao , item => {
          return item.nome.indexOf(this.filter) >= 0;
      })
    }
  },
}
</script>