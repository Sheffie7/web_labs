<template>
  <div id="app" class="wrapper text-center p-3 mx-auto" style="width: 60vw; min-width: 330px;">
    <header class = "masthead">
                  <h3 class="masthead-brand">Автовокзал</h3>
                  <nav class="nav nav-masthead justify-content-center">
                    <router-link class="nav-link" to="/">Главная</router-link>
<!--                    <router-link class="nav-link" to="/schedule">Расписание</router-link>-->
                    <router-link class="nav-link" to="/contacts">Контакты</router-link>
                    <router-link class="nav-link" to="/profile" v-if="user.isAuth()">Мои билеты</router-link>
                    <router-link class="nav-link" to="/login" v-else>Вход</router-link>
                  </nav>
    </header>

    <main class="content mt-3">
      <router-view/>
    </main>

    <footer class="mastfoot container footer mt-5">
      <p>Сделано студентом ВТ-41, Шевченко Константином, БГТУ им. В.Г. Шухова, 2020 год.</p>
    </footer>
  </div>
</template>

<script>
import User from '@/components/User'
export default {
  data() {
    return {
      user: User
    }
  }
}
</script>