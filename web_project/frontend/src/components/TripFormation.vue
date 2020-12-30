<template>
  <tr style = "border: 1px solid silver">
    <td>{{trip.departure}}<br>{{trip.departureTime}}</td>
    <td>{{trip.destination}}<br>{{trip.destinationTime}}</td>
    <td>{{trip.name}}</td>
    <td>Цена: {{trip.price}} р.<br>Осталось {{trip.emptySeats}} мест </td>
    <td>
      <router-link class="btn-lg btn-primary btn-block" v-bind:to="{name: 'showtickets', query: {tripId: trip.id}}">Купить билеты</router-link>
    </td>
  </tr>
</template>

<script>
export default {
  name: "TripFormation",
  props: ["trip"],
  methods: {
  }
}
</script>