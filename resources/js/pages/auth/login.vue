<template>
  <div id="login-container" class="row">
    <div class="col-sm col-md my-auto">
      <div id="login-card" class="border-0 mx-auto card-body" style="background-color: black; max-width: 500px; margin:">
        <div class="mb-5">
          <h1 class="text-white">Log In</h1>
        </div>
        <form @submit.prevent="login" @keydown="form.onKeydown($event)">
          <!-- Email -->
          <div class="input-card card-body mb-3">
            <div class="form-group row">
              <div class="col-md col-sm">
                <label for="email" class="card-title">Email</label>
                <input id="email" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email">
                <has-error :form="form" field="email" />
              </div>
            </div>
          </div>

          <!-- Password -->
          <div class="input-card card-body">
            <div class="form-group row">
              <div class="col-md col-sm">
                <label for="password" >Password</label>
                <input id="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                <has-error :form="form" field="password" />
              </div>
            </div>
          </div>
          
          <div class="form-group row">
            <div class="col-md col-sm">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                Let's find!
              </v-button>
              
              <!-- GitHub Login Button -->
              <login-with-github />
            </div>
          </div>
        </form>
        <button @click="AuthProvider('google')">auth Google</button>
      </div>
    </div>
    <div class="col-sm col-md my-auto d-none d-xl-block">
      <div style="text-align: right">
        <h1 id="kita-join-header" class="text-white">KITA <br /> JOIN</h1>
        <p id="kita-join-paragraph" class="text-white font-weight-light">Help you find the right people</p>
      </div>
    </div>
  </div>
</template>

<style scoped>
  input {
    outline: 0;
    border-width: 0 0 0px;
    padding: 0;
    -webkit-text-fill-color: black;
    font-weight: bold;
  }

  input:focus {
    box-shadow: none !important;
  }

  #login-card {
    padding: 0;
  }

  label {
    color: #B1C1C8;
    font-size: 12px;
    margin: 0;
  }

  .input-card {
    background-color: white;border-radius: 4px;
    padding-top: 4px;
    padding-bottom: 0;
  }

  #login-container {
    height: calc(100vh - 56px);
  }  

  #forgot-password {
    color: #9e9e9e;
  }
  
  #kita-join-header{
    font-size: 8vw;
  }

  #kita-join-paragraph {
    font-size: 3vw;
  }
</style>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'
import VueSocialAuth from 'vue-social-auth'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('login') }
  },

  data: () => ({
    form: new Form({
      email: '',
      password: ''
    }),
    remember: false
  }),

  methods: {
    async login () {
      // Submit the form.
      const { data } = await this.form.post('/api/login')

      // Save the token.
      this.$store.dispatch('auth/saveToken', {
        token: data.token,
        remember: this.remember
      })

      // Fetch the user.
      await this.$store.dispatch('auth/fetchUser')

      // Redirect home.
      this.$router.push({ name: 'home' })
    },
    AuthProvider(provide) {
      var self = this
      this.$auth.authenticate(provider).then(response => {
        self.SocialLogin(provider, response)
      }).catch(err => {
        console.log({err:err})
      })
    },
    SocialLogin(provide, response) {
      this.$http.post('/sociallogin/' + provider, response).then(response => {
        console.log(response.data)
      }).catch(err => {
        console.log({err:err})
      })
    }
  }
}
</script>
