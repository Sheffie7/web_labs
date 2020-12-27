<template>
      <main role="main">
        <img src="img/theme.png" style="width: 35vw; min-width: 330px;" class="img-fluid rounded-circle" alt="Responsive image">
        <h1 class="cover-heading">Куда вы хотите поехать?</h1>
        <form class="form-travel"><div class="form-row row-travel">
          <div class="col-md-3 mb-3">
            <select class="form-control" id="select-from" v-model="departure">
              <option disabled value="">Откуда</option>
              <option v-for="option in departure_options" v-bind:value="option.value">
                {{ option.text }}
              </option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
              <select class="form-control" id="select-to" v-model="destination">
                <option disabled value="">Куда</option>
                <option v-for="option in destination_options" v-bind:value="option.value">
                  {{ option.text }}
                </option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <input class="form-control" type="date" id="travelDate" v-model="date">
          </div>
          <div class="col-md-3 mb-3">
            <router-link class="btn btn-primary btn-block"  v-bind:to="{name: 'Routes', params: {departure: departure, destination: destination, date: date}}">Найти билеты</router-link>
          </div>
        </div>
        </form>
      </main>
</template>

<script>
import Axios from 'axios';
export default {
  name: 'Home',
  components: {},
  data() {
    return {
      departure: "",
      destination: "",
      date: "",
      departure_options: [],
      destination_options: []
    }
  },
  created() {
    const instance = Axios.create({
      baseURL: 'http://localhost:8000/v1'
    });
    instance.get('/tickets/departure_stations').then((response) => this.departure_options = response.data)
    instance.get('/tickets/destination_stations').then((response) => this.destination_options = response.data)
  },
  methods: {
    btnClick() {
    }
  }
}
</script>
