<template>
  <div>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container-fluid">
        <a class="navbar-brand">Laravel And Vue</a>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <router-link to="/" class="nav-link">Home</router-link>
            </li>
          </ul>
          <ul class="navbar-nav ml-auto">
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                {{ app.user ? app.user.name : "Account" }}
              </a>
              <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                <div v-if="!app.user">
                  <router-link to="/login" class="dropdown-item">Login</router-link>
                  <router-link to="/register" class="dropdown-item">Register</router-link>
                </div>
                <a v-else @click="logout" href="javascript:;" class="dropdown-item">Logout</a>
              </ul>
            </li>
          </ul>
        </div>
      </div>
    </nav>
  </div>
</template>

<script>
export default {
  name: "navbar",
  props: ["app"],
  data(){
    return {}
  },
  methods: {
    logout(){
       this.app.req.post("auth/logout").then(() => {
         this.app.user = null;
         this.$router.push("/login");
       })
    }
  }
}
</script>

<style lang="css" scoped>
</style>
