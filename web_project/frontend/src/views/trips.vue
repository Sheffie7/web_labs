<template>
  <div class = "">
    <h1>{{departure.name}} - {{destination.name}} {{query.date}}</h1>
    <table class="table table-striped my-5" style ="border: 2px solid silver">
      <thead>
      <tr>
        <th scope="col">Отправление</th>
        <th scope="col">Прибытие</th>
        <th scope="col">Рейс</th>
        <th scope="col">Цены</th>
        <th scope="col"></th>
      </tr>
      </thead>
      <tbody v-for="item in items">
      <TripFormation v-bind:trip="item"></TripFormation>
      </tbody>
    </table>
  </div>
</template>

<script>
import TripFormation from "@/components/TripFormation";
export default {
  name: "trips",
  components: {TripFormation},
  data() {
    return {
      query: this.$route.query,
      items: [],
      departure: null,
      destination: null
    }
  },
  created: function () {
    this.$http.get('/stations/station', {params: {id: this.query.departureId}})
        .then((response) => { this.departure = response.data })
    this.$http.get('/stations/station', {params: {id: this.query.destinationId}})
        .then((response) => { this.destination = response.data })
    this.$http.get('/trips/trips',
        {params: {  departureId: this.query.departureId,
               destinationId: this.query.destinationId,
               departureTime: this.query.date}})
        .then((response) => { this.items = response.data })
  }
}
</script>