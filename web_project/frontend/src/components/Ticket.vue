<template>
  <tr class = "ticket-table">
    <td >Место: {{ticket.seat}}</td>
    <td>Цена: {{ticket.trip.price}} р.</td>
    <td>
      <button class="btn btn-primary btn-block btn-center" v-on:click="buyTicket()" disabled="">Купить билет</button>
    </td>
  </tr>
</template>

<script>
export default {
  name: "Ticket",
  props: ["ticket"],
  data() {
    return {
    }
  },
  methods: {
    buyTicket(){
      //TODO!!!
    }
  }
}
</script>