<template>
  <div class="row">
    <div class="col-lg-8 m-auto">
      <card>
        <div id="container">
          <div id="jumbotron" class="jumbotron p-0 mb-0">
            <!-- Card content -->
            <div class="card-title mb-0">
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
import Form from 'vform'

export default {
  middleware: 'guest',

  metaInfo () {
    return { title: this.$t('verify_email') }
  },

  data: () => ({
    status: '',
    form: new Form({
      email: ''
    })
  }),

  created () {
    if (this.$route.query.email) {
      this.form.email = this.$route.query.email
    }
  },

  methods: {
    async send () {
      const { data } = await this.form.post('/api/email/resend')

      this.status = data.status

      this.form.reset()
    }
  }
}
</script>
