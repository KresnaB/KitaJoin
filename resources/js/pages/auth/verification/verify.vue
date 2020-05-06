<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card>
        <template v-if="success">
          <div id="container">
            <div id="jumbotron" class="jumbotron p-0 mb-0">
              
              <!-- Card content -->
              <div class="card-title mb-0">

                <!-- Title -->
                <h3 class="card-title h3 my-4 text-center"><strong>Verified!</strong></h3>
                
                <!-- Text -->
                <p class="card-text text-secondary text-center my-4">Yahoo! You have successfully verified the account.</p>
                
                <div class="pl-4 pr-4">
                  <!-- Button -->
                  <router-link id="login" class="btn btn-dark btn-block btn-lg mb-4" :to="{ name: 'login' }">
                      Log In
                  </router-link>
                </div>
              </div>
            </div>
          </div>
        </template>
        <template v-else>
          <div id="container">
            <div id="jumbotron" class="jumbotron p-0 mb-0">
              
              <!-- Card content -->
              <div class="card-title mb-0">

                <!-- Title -->
                <h3 class="card-title h3 my-4 text-center"><strong>Expired!</strong></h3>
                
                <!-- Text -->
                <p class="card-text text-secondary text-center mt-4 mb-5">Sorry! The verification link is invalid. We will send you a <span id="verification-link-text">verification link</span> on this email</p>
                
                <form @submit.prevent="send" @keydown="form.onKeydown($event)">

                  <!-- Email -->
                  <div id="form-email" class="form-group">
                    <label id="enter-email-label" class="col-md-3 col-form-label text-md-right text-center text-secondary p-0">Enter Email</label>
                    <div>
                      <input v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control font-weight-bold" type="email" name="email">
                      <hr class="mt-0">
                      <has-error :form="form" field="email" />
                    </div>
                  </div>

                  <!-- Submit Button -->
                  <div id="form-button">
                    <!-- Button -->
                    <button id="resend" class="btn btn-dark btn-block btn-lg mb-4 font-weight-bold" type="submit">
                        SEND
                    </button>
                  </div>
                  <alert-success class="alert-dark" :form="form" message="We have sent your verification link!" />
                </form>
              </div>
            </div>
          </div>
        </template>
      </card>
    </div>
  </div>
</template>

<style scoped>
  @media screen and (max-width: 1000px) {
    card {
      padding: 86px 27px;
    }

    #jumbotron {
        background-color: white;
    }

    #gotologin {
        border-radius: 4px;
        font-size: 1rem;
    }

    .card-title p {
        font-size: 1rem
    }

    .row {
      margin-top: 36px;
      margin-bottom: 36px;
    }

    .row > div {
      padding: 0 36px;
    }

    #container {
      margin: 21px;
    }

    .btn {
      font-size: 1rem;
      padding: 10px 16px;
    }

    #enter-email-label {
      font-size: 0.875rem;
    }

    input {
      outline: 0;
      border-width: 0 0 0px;
      padding: 0;
      -webkit-text-fill-color: black;
    }

    input:focus{
      box-shadow: none !important;
    }

    hr {
      border: 1px solid #6c757d;
    }

    #form-email {
      margin-bottom: 46px;
    }
  }
</style>

<script>
import axios from 'axios'
import Form from 'vform'

const qs = (params) => Object.keys(params).map(key => `${key}=${params[key]}`).join('&')

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  async beforeRouteEnter (to, from, next) {
    try {
      const { data } = await axios.post(`/api/email/verify/${to.params.id}?${qs(to.query)}`)

      next(vm => { vm.success = data.status })
    } catch (e) {
      next(vm => { vm.error = e.response.data.status })
    }
  },

  data: () => ({
    error: '',
    success: '',
    status: false,
    form: new Form({
      email: ''
    })
  }),

  methods: {
    async send() {
      const { data } = await this.form.post('/api/email/resend')

      this.status = data.status

      this.form.reset()
    }
  },

  created() {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  }
}
</script>
