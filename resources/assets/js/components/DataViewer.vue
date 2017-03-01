<template>
    <div class="col-lg-12">
        <div class="col-md-2">
          <h5> {{title}} </h5>
        </div>
        <div class="col-md-6 pull-right">
          <div class="form-inline">
            <div class="form-group">
                <label class="label-search">search</label>
                <select class="form-control" v-model="query.search_column">
                    <option v-for="column in columns" :value="column">{{ column }}</option>
                </select>
                <select class="form-control" v-model="query.search_operator">
                    <option v-for="(value, key) in operators" :value="key">{{ value }}</option>
                </select>
                <input type="text" class="form-control" placeholder="search" v-model="query.search_input" @keyup.enter="fetchIndexData()"/>
            </div>
          </div>
        </div>
        <table class="table">
            <thead>
                <tr>
                  <th v-for="column in columns" @click="toggleOrder(column)">
                    <span>{{ column }}</span>
                    <div class="table-column" v-if="column === query.column">
                        <span class="glyphicon glyphicon-menu-down" aria-hidden="true"  v-if="query.direction === 'desc'">
                        </span>
                        <span class="glyphicon glyphicon-menu-up" aria-hidden="true" v-else></span>
                    </div>
                  </th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="row in model.data">
                    <td v-for="(value, key) in row"> {{ value }} </td>
                </tr>
            </tbody>
        </table>
        <div class="table-footer">
            <span> Displaying {{model.from}} - {{model.to}} of {{model.total}} rows </span>
            <div class="table-footer-sub">
                <span>Rows per page</span>
                <input type="text" v-model="query.per_page"
                  class="dv-footer-input"
                  @keyup.enter="fetchIndexData()">
            </div>
            <div class="pull-right">
              <button class="btn btn-primary btn-sm" @click="prev()">
                <span class="glyphicon glyphicon-backward"></span>
              </button>
              <button class="btn btn-primary btn-sm" @click="next()">
                <span class="glyphicon glyphicon-forward"></span>
              </button>
            </div>
        </div>
    </div>
</template>

<script>

  import Vue from 'vue'
  import axios from 'axios'

  export default {
      props: ['source', 'title'],
      data(){
        return{
          model:{},
          columns:{},
          query:{
            page: 1,
            column: 'id',
            direction: 'asc',
            per_page: 10,
            search_column: 'id',
            search_operator: 'equal',
            search_input: ''
          },
          operators: {
            equal: '=',
            not_equal: '<>',
            less_than: '<',
            greater_than: '>',
            less_than_or_equal_to: '<=',
            greater_than_or_equal_to: '>=',
            in: 'IN',
            like: 'LIKE'
          }
        }
      },
      created() {
          this.fetchIndexData()
      },
      methods: {
        next() {
          if(this.model.next_page_url){
            this.query.page++
            this.fetchIndexData()
            console.log(this.query)
          }
        },
        prev(){
          if(this.model.prev_page_url){
            this.query.page--
            this.fetchIndexData()
            console.log(this.query)
          }
        },
        toggleOrder(column) {
         if(column === this.query.column) {
           // only change direction
           if(this.query.direction === 'desc') {
             this.query.direction = 'asc'
           } else {
             this.query.direction = 'desc'
           }
         } else {
           this.query.column = column
           this.query.direction = 'asc'
         }
         this.fetchIndexData()
        },
        fetchIndexData() {
          var vm = this
          axios.get(`${this.source}?column=${this.query.column}&direction=${this.query.direction}&page=${this.query.page}&per_page=${this.query.per_page}&search_column=${this.query.search_column}&search_operator=${this.query.search_operator}&search_input=${this.query.search_input}`)
            .then(function(response){
              Vue.set(vm.$data, 'model', response.data.model)
              Vue.set(vm.$data, 'columns', response.data.columns)
            })
            .catch(function(response){
              console.log(response)
            })
        }
      }
  }
</script>

<style>
  .label-search {
      margin-right: 20px;
  }

  .table{
      margin-top: 80px;
  }

  .table-column{
    display: inline;
    margin-left: 10px;
    cursor: pointer;
  }
</style>
