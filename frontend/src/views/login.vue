<template>
  <div class="login">
  <form class="form-signin">
    <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
    <label for="inputTel" class="sr-only">Номер телефона</label>
    <input type="tel" id="inputTel" class="form-control" placeholder="Номер телефона" required autofocus>
    <label for="inputPassword" class="sr-only">Пароль</label>
    <input type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
    <div class="checkbox mb-3">
      <label>
        <input type="checkbox" value="remember-me"> Запомнить меня
      </label>
    </div>
    <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
  </form>
  </div>
</template>

<script>
export default {
    name: "signin"
  }
</script>
