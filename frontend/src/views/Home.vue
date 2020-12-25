<template>
      <main role="main">
        <img src="img/theme.png" style="width: 35vw; min-width: 330px;" class="img-fluid rounded-circle" alt="Responsive image">
        <h1 class="cover-heading">Куда вы хотите поехать?</h1>
        <form class="form-travel"><div class="form-row row-travel">
          <div class="col-md-3 mb-3">
            <select class="form-control" id="select-from" v-model="departure">
              <option value="">Откуда</option>
              <option class="slctBlg">Белгород</option>
              <option class="slctMsc">Москва</option>
              <option class="slctGbk">Губкин</option>
              <option class="slctOsk">Старый Оскол</option>
              <option class="slctVrn">Воронеж</option>
              <option class="slctKrsk">Курск</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
              <select class="form-control" id="select-to" v-model="destination">
              <option value="">Куда</option>
              <option class="slctBlg">Белгород</option>
              <option class="slctMsc">Москва</option>
              <option class="slctGbk">Губкин</option>
              <option class="slctOsk">Старый Оскол</option>
              <option class="slctVrn">Воронеж</option>
              <option class="slctKrsk">Курск</option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <input class="form-control" type="date" id="travelDate" v-model="date">
          </div>
          <div class="col-md-3 mb-3">
            <router-link class="btn btn-primary btn-block"  v-bind:to="{name: 'Routes'}">Найти билеты</router-link>
          </div>
        </div>
        </form>
      </main>
</template>

<script>
export default {
  name: 'Home',
  components: {},
  data() {
    return {
      departure: "",
      destination: "",
      date: ""
    }
  },
  methods: {}
}
</script>
