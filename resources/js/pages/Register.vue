<template>
  <div class="container">
    <div class="card">
      <div class="card-header">
        Register
      </div>

      <div class="card-body">
        <div class="col-md-6 offset-md-3">
          <form v-on:submit.prevent="onSubmit">
              <div class="alert alert-danger" v-if="errors.length">
                <ul class="mb-0">
                  <li v-for="(error, index) in errors" :key="index">{{ error }}</li>
                </ul>
              </div>
              <div class="form-group">
                <label>Nama</label>
                <input type="text" class="form-control" placeholder="Nama..." v-model="name">
              </div>
              <div class="form-group">
                <label>Username</label>
                <input type="text" class="form-control" placeholder="Username..." v-model="username">
              </div>
              <div class="form-group">
                <label>Password</label>
                <input :type="type" class="form-control" placeholder="Password..." v-model="password" id="myInput">
              </div>
              <div class="form-group">
                <label>Password Again</label>
                <input :type="type" class="form-control" placeholder="Password Again..." v-model="passwordAgain" id="myInput">
                <input type="checkbox" @click="showPassword"> Show Password
              </div>
              <button class="btn btn-success">Register</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'register',
  props: ['app'],
  data(){
    return {
      name: '',
      username: '',
      password: '',
      passwordAgain: '',
      errors: [],
      type: 'password'
    }
  },
  methods: {
    onSubmit()
    {
        this.errors = [];

        if (!this.name) {
          this.errors.push('Nama harus di isi')
        }
        if (!this.username) {
          this.errors.push('Username harus di isi')
        }
        if (!this.password) {
          this.errors.push('Password harus di isi')
        }
        if (!this.passwordAgain) {
          this.errors.push('Password comfirmasi harus di isi')
        }
        if (this.password !== this.passwordAgain) {
          this.errors.push('Password tidak sama!')
        }
        if (!this.errors.length) {
          const data = {
            name: this.name,
            username: this.username,
            password: this.password
          };

          this.app.req.post('auth/register', data).then(response => {
            this.app.user = response.data;
            this.$router.push('/');
          }).catch(error => {
            this.errors.push(error.response.data.error);
          })
        }
    },
    showPassword() {
       if(this.type === 'password') {
          this.type = 'text'
       } else {
          this.type = 'password'
       }
     }
  }
}
</script>

<style lang="css" scoped>
</style>
