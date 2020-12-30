<template>
      <main role="main">
        <img src="../../public/img/theme.png" style="width: 35vw; min-width: 330px;" class="img-fluid rounded-circle" alt="Responsive image">
        <h1 class="cover-heading">Куда вы хотите поехать?</h1>
        <form class="form-travel"><div class="form-row row-travel">
          <div class="col-md-3 mb-3">
            <select class="form-control" v-bind:class="departure_status" id="select-from" v-model="departureId" v-on:change="fieldChanged(1)">
              <option disabled value="0">Откуда</option>
              <option v-for="option in departure_options" v-bind:value="option.id">
                {{option.name}}
              </option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <select class="form-control" v-bind:class="destination_status" id="select-to" v-model="destinationId" v-on:change="fieldChanged(2)">
                <option disabled value="0">Куда</option>
                <option v-for="option in destination_options" v-bind:value="option.id" >
                  {{option.name}}
                </option>
            </select>
          </div>
          <div class="col-md-3 mb-3">
            <input class="form-control" v-bind:class="date_status" type="date" id="travelDate" v-model="date" v-bind:min="minDate" v-on:change="fieldChanged(3)">
          </div>
          <div class="col-md-3 mb-3">
            <input type="button" v-on:click="btnClick()" class="btn btn-primary btn-block" value="Найти билеты" >
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
      departureId: "0",
      destinationId: "0",
      date: "",
      departure_options: [],
      destination_options: [],
      departure_status: "",
      destination_status: "",
      date_status: ""
    }
  },
  created() {
    this.minDate = new Date().toISOString().split("T")[0];
    this.$http.get('/stations/all_departures').then((response) => this.departure_options = response.data)
    this.$http.get('/stations/all_destinations').then((response) => this.destination_options = response.data)
  },
  methods: {
    btnClick(){
      if (this.departureId == "0")
        this.departure_status = "border-danger text-danger";
      else
        this.departure_status = "";
      if (this.destinationId == "0")
        this.destination_status = "border-danger text-danger";
      else
        this.destination_status = "";
      if (this.date == "")
        this.date_status = "border-danger text-danger";
      else
        this.date_status = "";
      if(this.departure_status == "" && this.destination_status == "" && this.date_status =="")
        this.$router.push({name: 'trips', query: {departureId: this.departureId, destinationId : this.destinationId, date: this.date}});
    },
    fieldChanged(field){
      switch (field){
        case 1: this.departure_status = "";
          break;
        case 2: this.destination_status = "";
          break;
        case 3: this.date_status = "";
      }
    }
  }
}
</script>