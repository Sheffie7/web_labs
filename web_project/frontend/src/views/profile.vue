<template>
    <div align = "left">
      <h2 class="cover-heading">Информация о пользователе</h2>
      <p>
        <font size="5">
      Имя: {{user.name}} <br> Номер телефона: {{user.phone}}
      </font>
      </p>
<!--    выдать инфу о билетах-->
      <h2 class="cover-heading mt-5">Информация о билетах</h2>
    <div align = "right"> <button class="btn btn-primary btn-block col-md-2 mt-5" v-on:click="logoutClick">Выйти</button> </div>
  </div>
</template>

<script>
import User from "@/components/User";
import router from "@/router";
export default {
  name: "Profile",
  data() {
    return {
      user: User
    }
  },
  methods: {
    logoutClick(){
      User.logout()
      router.push({name: 'login'})
    },
  }
}
</script>