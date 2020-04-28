<template>
  <div id="register-container" class="row">
    <div class="col-sm col-md my-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <div id="register-card" v-else class="border-0 mx-auto card-body" style="background-color: black; max-width: 500px">
        <div class="d-block d-sm-none mb-5">
          <h1 class="text-white">KITA <br /> JOIN</h1>
          <p class="text-white font-weight-light">Help you find the right people</p>
        </div>
        <div class="d-none d-sm-block d-sm-none d-md-block mb-5">
          <h1 class="text-white">Register to KITAJOIN</h1>
          <p class="text-secondary font-weight-light">Join to KITAJOIN you will get the best people for your team.</p>
        </div>
        <hr class="mb-5">
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="input-card card-body mb-3">
            <div class="form-group row">
              <div class="col-md col-sm">
                <label for="fullName" class="card-title">Full Name</label>
                <input id="fullName" v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name">
                <has-error :form="form" field="name" />
              </div>
            </div>
          </div>

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
          <div class="input-card card-body mb-5">
            <div class="form-group row">
              <div class="col-md col-sm">
                <label for="password" class="card-title">Password</label>
                <input id="password" v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password">
                <has-error :form="form" field="password" />
              </div>
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md col-sm">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('REGISTER') }}
              </v-button>

              <!-- GitHub Register Button -->
              <login-with-github />
            </div>
          </div>
        </form>
        <ul id="already-have-an-account" class="list-inline">
          <li class="list-inline-item">
              <p class="text-white">Already have an account?</p>
          </li>
          <li class="list-inline-item">
            <router-link id="sign-in-here" :to="{ name: 'login' }" class="nav-link" active-class="active">
              {{ $t('Sign in here') }}
            </router-link>
          </li>
        </ul>
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

  #sign-in-here {
    color: #9E9E9E;
    padding-left: 0;
  }

  #already-have-an-account {
    font-size: 12px;
    font-weight: lighter;
  }

  hr {
    border-top: 1px solid #B1C1C8;
  }

  label {
    color: #B1C1C8;
    font-size: 12px;
    margin: 0;
  }

  .input-card {
    background-color: white;
    border-radius: 4px;
    padding-top: 4px;
    padding-bottom: 0;
  }

  #register-card {
    padding: 0;
  }

  #register-container {
    height: calc(100vh - 56px);
  }  

  #kita-join-header{
    font-size: 8vw;
  }

  #kita-join-paragraph {
    font-size: 3vw;
  }

  .list-inline-item {
    margin-right: 0;
  }
</style>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'
import axios from 'axios'

export default {
  middleware: 'guest',

  components: {
    LoginWithGithub
  },

  metaInfo () {
    return { title: this.$t('register') }
  },

  data: () => ({
    form: new Form({
      name: '',
      email: '',
      password: '',
      password_confirmation: ''
    }),
    mustVerifyEmail: false
  }),

  methods: {
    async register () {
      // Register the user.
      const { data } = await this.form.post('/api/register')

      // Must verify email fist.
      if (data.status) {
        this.mustVerifyEmail = true;
        const { user } = await axios.post('/api/registerid/get/' + this.form.email)
        this.$router.push({ name: 'email.confirmation' })
      } else {
        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
