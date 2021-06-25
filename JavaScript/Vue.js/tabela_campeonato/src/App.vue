<template>
  <div id="app" class="container">
    <a class="btn btn-primary" @click.prevent="createNovoJogo">Novo Jogo</a>
    <input type="text" class="form-control" v-model="filter">
    <div class="row">
      <h3>Campeonato Brasileiro - Série A - 2016</h3>
      <div v-if="view == 'tabela'">
        <table class="table table-striped">
          <thead>
          <tr>
            <th v-for="coluna in colunas">
              <a href="#" @click.prevent="sortBy(coluna)">{{coluna | ucwords}}</a> <!-- Primeiro o parametro e depois o nome do filtro -->
            </th>
          </tr>
          </thead>
          <tbody>
            <tr v-for="time in timesFiltered"> <!-- Variável que vem do computed -->
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
      </div> <!-- tabela -->
      <div v-if="view == 'novoJogo'">
        <form class="form-inline">
            <div class="form-group">
              <label class="control-label">
                {{novoJogo.casa.time.nome}}
                <img :src="novoJogo.casa.time.escudo" style="height: 30px; width: 30px;">
              </label>
              <input type="text" class="form-control" v-model="novoJogo.casa.gols"> 
            </div>
            <span>X</span>
            <div class="form-group">
                <label class="control-label">
                  <img :src="novoJogo.fora.time.escudo" style="height: 30px; width: 30px;">
                  {{novoJogo.fora.time.nome}}
                </label>
                <input type="text" class="form-control" v-model="novoJogo.fora.gols">
            </div>
            <button type="button" class="btn btn-primary" @click="fimJogo">Fim de jogo</button>
        </form>
      </div> <!-- novoJogo -->
    </div><!-- div row -->

  </div>
</template>

<script>
import {Time} from './time';
import _ from 'lodash';

export default {
  name: 'app',
  data () {
    return {
      times: [
        new Time('Palmeiras', require('./assets/palmeiras_60x60.png')),
        new Time('Flamengo', require('./assets/flamengo_60x60.png')),
        new Time('Atlético-MG', require('./assets/atletico_mg_60x60.png')),
        new Time('Santos', require('./assets/santos_60x60.png')),
        new Time('Botafogo', require('./assets/botafogo_60x60.png')),
        new Time('Atlético-PR', require('./assets/atletico-pr_60x60.png')),
        new Time('Corinthians', require('./assets/corinthians_60x60.png')),
        new Time('Grêmio', require('./assets/gremio_60x60.png')),
        new Time('Fluminense', require('./assets/fluminense_60x60.png')),
        new Time('Ponte Preta', require('./assets/ponte_preta_60x60.png')),
        new Time('Chapecoense', require('./assets/chapecoense_60x60.png')),
        new Time('São Paulo', require('./assets/sao_paulo_60x60.png')),
        new Time('Cruzeiro', require('./assets/cruzeiro_60x60.png')),
        new Time('Sport', require('./assets/sport_60x60.png')),
        new Time('Coritiba', require('./assets/coritiba_60x60.png')),
        new Time('Internacional', require('./assets/internacional_60x60.png')),
        new Time('Vitória', require('./assets/vitoria_60x60.png')),
        new Time('Figueirense', require('./assets/figueirense_60x60.png')),
        new Time('Santa Cruz', require('./assets/santa_cruz_60x60.png')),
        new Time('América-MG', require('./assets/america_mg_60x60.png')),
      ],
      novoJogo: {
        casa: {
            time: null,
            gols: 0
        },
        fora: {
            time: null,
            gols: 0
        },
      },
      colunas: [ 'nome', 'pontos', 'gm', 'gs', 'saldo'],
      view: 'tabela',
      order: {
        keys: ['pontos', 'gm', 'gs'],
        sort: ['desc', 'desc', 'asc']
      },
      filter: '',
    }
  },
  created() {
    
  },
  methods: {
    fimJogo(){
      let timeAdversario = this.novoJogo.fora.time;
      let gols = +this.novoJogo.casa.gols;
      let golsAdversario = +this.novoJogo.fora.gols;
      this.novoJogo.casa.time.fimJogo(timeAdversario, gols, golsAdversario);
      this.showView('tabela');
    },
    createNovoJogo(){
      let indexCasa = Math.floor(Math.random()*20),
          indexFora = Math.floor(Math.random()*20);

      while(indexCasa == indexFora) {
        indexFora = Math.floor(Math.random() * 20);            
      }

      this.novoJogo.casa.time = this.times[indexCasa];
      this.novoJogo.casa.gols = 0;
      this.novoJogo.fora.time = this.times[indexFora];
      this.novoJogo.fora.gols = 0;
      this.showView('novoJogo');
    },
    showView(view){
      this.view = view;
    },
    sortBy(coluna){
      this.order.keys = coluna;
      this.order.sort = this.order.sort == 'desc' ? 'asc': 'desc';
    }
  },
  filters: {
    saldo(time){
      return time.gm - time.gs;
    },
    ucwords(value){
     return value.charAt(0).toUpperCase() + value.slice(1);
    }
  },
  computed: {
    timesFiltered(){
      let colecao = _.orderBy(this.times, this.order.keys, this.order.sort);

      return _.filter(colecao , item => {
          return item.nome.indexOf(this.filter) >= 0;
      })
    }
  },
}
</script>


