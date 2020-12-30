<template>
  <div class="ticket mx-auto" style="width: 80%">
    <h1 class="text-center">Свободные места {{trip.name}}</h1>
    <div class="mx-auto" style="width: 50%">
    <table class="table table-striped my-5">
      <nobr v-on="tickets.price"></nobr>
      <tbody v-for="ticket in tickets">
      <Ticket v-bind:ticket="ticket"></Ticket>
      </tbody>
    </table>
    </div>
  </div>
</template>

<script>
import Ticket from "@/components/Ticket";
export default {
  name: "showtickets",
  components: {Ticket},
  data() {
    return {
      tripId: this.$route.query.tripId,
      tickets: [],
      trip: null
    }
  },
  created: function () {
    console.log('hello')
    console.log(this.tripId)
    this.$http.get('/trips/trip_from_id', {params: { id: this.tripId}})
        .then((response) => { this.trip = response.data })
    this.$http.get('/tickets/trip_empty_seats', {params: { tripId: this.tripId}})
        .then((response) => this.tickets = response.data)
  },
  methods :{}
}
</script>