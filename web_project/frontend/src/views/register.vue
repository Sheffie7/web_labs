<template>
  <div class="text-center">
  <form class="form-login" @submit="register">
    <h1 class="h3 mb-3 font-weight-normal">Регистрация</h1>
    <input type="text" id="inputPhone" class="form-control mb-1" v-bind:class="phone_status" placeholder="Номер телефона" required="" autofocus=""
           v-model="phone" v-on:change="fieldChanged()">
    <div v-bind:class="phone_status" v-if="warning==1||warning==3">К сожалению, номер телефона занят.</div>
    <input type="password" id="inputPassword" class="form-control mb-1" v-bind:class="passwords_status" placeholder="Пароль" required=""
           v-model="password" v-on:change="fieldChanged()">
    <input type="password" id="inputPasswordRepeat" class="form-control mb-1" v-bind:class="passwords_status" placeholder="Повторите пароль" required=""
           v-model="rep_password" v-on:change="fieldChanged()">
    <div v-bind:class="passwords_status" v-if="warning==2||warning==3">Пароли не совпадают.</div>
    <button class="btn btn-lg btn-success btn-block mt-3" type="submit">Регистрация</button>
  </form>
  </div>
</template>

<script>
import User from "@/components/User";
import router from "@/router";
import MD5 from "crypto-js/md5";
export default {
  name: "register",
  data(){
    return {
      phone: "",
      password: "",
      rep_password: "",
      phone_status: "",
      passwords_status: "",
      warning: 0,
    }
  },
  methods: {
    register(event){
      this.warning = 0
      if (this.password != this.rep_password){
        this.passwords_status = "border-danger text-danger";
        this.warning += 2
      }
      this.$http.post('/users/register', {
        phone: this.phone,
        password: MD5(this.password).toString()
      }).then((response) => { if (this.warning == 0) {
                            User.login(response.data)
                            router.push({name: 'Home'})}})
          .catch((errors) => {console.log(errors)
                            this.warning += 1
                            this.phone_status = "border-danger text-danger"})
      event.preventDefault()
    },
    fieldChanged(){
      this.warning = 0
      this.phone_status = "";
      this.passwords_status = "";
    }
  }
}
</script>