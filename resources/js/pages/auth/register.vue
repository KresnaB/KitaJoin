<template>
  <div class="row" style="height: 100vh">
    <div class="col-sm col-md my-auto">
      <card v-if="mustVerifyEmail" :title="$t('register')">
        <div class="alert alert-success" role="alert">
          {{ $t('verify_email_address') }}
        </div>
      </card>
      <card v-else class="border-0 mx-auto" style="background-color: black; max-width: 500px">
        <h1 class="text-white">KITA <br /> JOIN</h1>
      <p class="text-white font-weight-light">Help you find the right people</p>
        <form @submit.prevent="register" @keydown="form.onKeydown($event)">
          <!-- Name -->
          <div class="form-group row">
            <div class="col-md col-sm">
              <input v-model="form.name" :class="{ 'is-invalid': form.errors.has('name') }" class="form-control" type="text" name="name" placeholder="Full Name">
              <has-error :form="form" field="name" />
            </div>
          </div>

          <!-- Email -->
          <div class="form-group row">
            <div class="col-md col-sm">
              <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control" type="email" name="email" placeholder="Email">
              <has-error :form="form" field="email" />
            </div>
          </div>

          <!-- Password -->
          <div class="form-group row mb-5">
            <div class="col-md col-sm">
              <input v-model="form.password" :class="{ 'is-invalid': form.errors.has('password') }" class="form-control" type="password" name="password" placeholder="Password">
              <has-error :form="form" field="password" />
            </div>
          </div>

          <div class="form-group row">
            <div class="col-md col-sm">
              <!-- Submit Button -->
              <v-button :loading="form.busy">
                {{ $t('Register') }}
              </v-button>

              <!-- GitHub Register Button -->
              <login-with-github />
            </div>
          </div>
        </form>
        <p id="already-have-an-account" class="text-white">Already have an account? <span id="sign-in-here">Sign in here</span></p>
      </card>
    </div>
  </div>
</template>

<style scoped>
  input {
    outline: 0;
    border-width: 0 0 1px;
    border-color: white;
    background-color: black;
    padding-left: 0;
    -webkit-text-fill-color: white
  }

  ::placeholder {
    color: #9E9E9E;
    font-weight: lighter;
  }

  #sign-in-here {
    color: #9E9E9E;
  }

  #already-have-an-account {
    font-size: 12px;
    font-weight: lighter;
  }
</style>

<script>
import Form from 'vform'
import LoginWithGithub from '~/components/LoginWithGithub'

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
        this.mustVerifyEmail = true
      } else {
        // Log in the user.
        const { data: { token } } = await this.form.post('/api/login')

        // Save the token.
        this.$store.dispatch('auth/saveToken', { token })

        // Update the user.
        await this.$store.dispatch('auth/updateUser', { user: data })

        // Redirect home.
        this.$router.push({ name: 'home' })
      }
    }
  }
}
</script>
