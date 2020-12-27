<template>
  <div id="app" class="wrapper text-center p-3 mx-auto mb-auto" style="width: 60vw; min-width: 330px; height: 10px;">
    <header class = "masthead">
                  <h3 class="masthead-brand">Автовокзал</h3>
                  <nav class="nav nav-masthead justify-content-center">
                    <router-link class="nav-link" to="/">Главная</router-link>
                    <router-link class="nav-link" to="/schedule">Расписание</router-link>
                    <router-link class="nav-link" to="/contacts">Контакты</router-link>
                    <router-link class="nav-link" to="/login">Вход</router-link>
                  </nav>
    </header>

    <main class="content">
      <router-view/>
    </main>

    <footer class="mastfoot container footer mt-5">
      <p>Сделано студентом ВТ-41, Шевченко Константином, БГТУ им. В.Г. Шухова, 2020 год.</p>
    </footer>
  </div>
</template>