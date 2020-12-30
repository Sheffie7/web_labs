<template>
  <form class="form-login" @submit="login">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <label for="inputPhone" class="sr-only">Номер телефона</label>
    <input type="text" id="inputPhone" class="form-control" v-bind:class="edits_status" placeholder="Номер телефона" required autofocus v-model="phone" v-on:change="fieldChanged()">
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" v-bind:class="edits_status" placeholder="Пароль" required v-model="password" v-on:change="fieldChanged()">
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    <a class="btn btn-lg btn-success btn-block" href="register">Регистрация</a>
    <div class="mt-3" v-bind:class="edits_status" v-if="edits_status != ''">Пожалуйста, проверьте правильность написания логина и пароля.</div>
  </form>
</template>

<script>
import User from "@/components/User";
import router from "@/router";
import MD5 from "crypto-js/md5";
export default {
  name: "login",
  data() {
    return {
      phone: '',
      password: '',
      edits_status: ""
    }
  },
  methods: {
    login(event){
      this.edits_status = ""
      this.$http.get('/users/login', {params: {
          phone: this.phone,
          password: MD5(this.password).toString()
        }}).then((response) => {User.login(response.data)
                                router.push({name: 'Home'})})
          .catch((errors) => {console.log(errors)
                              this.edits_status = "border-danger text-danger"})
      event.preventDefault()
    },
    fieldChanged(){
      this.edits_status = "";
    }
  }
}
</script>