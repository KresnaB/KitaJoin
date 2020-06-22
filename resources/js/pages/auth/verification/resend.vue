<template>
  <div class="w-100">
    <div id="not-available" class="d-none d-sm-block d-sm-none d-md-block">
      <div id="not-available-container" class="bg-white text-center pt-3 pb-3">
        <fa id="laptop" icon="laptop"></fa>
        <h1 id="oops" class="font-weight-normal">Oops!</h1>
        <p class="mt-4 font-weight-normal">Sorry, we're only available in mobile right now. We'll let you know as soon as we are!</p>
      </div>
    </div>
    <div class="d-block d-sm-none d-none d-sm-block d-md-none">
      <div class="row">
        <div class="col-lg-8 m-auto">
          <card class="background-color-black">
            <div id="container">
              <div id="jumbotron" class="jumbotron p-0 mb-0 background-color-black">

                <!-- Card image -->
                <div class="view overlay text-center">
                  <img src="/storage/emailconfirmationhint.svg" id="illustrator" class="img-fluid" alt="Email Confirmation Hint Illustration">
                </div>

                <h1 class="text-center text-white font-weight-bold">Email Verification</h1>

                <!-- Text -->
                <p id="verification-link-text" class="card-text text-white text-center mt-3 mb-5">We will send you an <span class="text-1">Activation Link</span> to get you started with kitajoin.</p>

                <!-- Card content -->
                <div class="card-title mb-0">
                  <form @submit.prevent="send" @keydown="form.onKeydown($event)">

                    <!-- Email -->
                    <div id="form-email" class="form-group">
                      <label id="enter-email-label" class="col-md-3 col-form-label text-md-right text-center text-white font-weight-bold p-0">Enter Email</label>
                      <div>
                        <input id="email-input" v-model="form.email" :class="{ 'is-invalid': form.errors.has('email') }" class="form-control font-weight-bold background-color-black" type="email" name="email">
                        <hr class="mt-0 border-white">
                        <has-error :form="form" field="email" />
                      </div>
                    </div>

                    <!-- Submit Button -->
                    <div id="form-button">
                      <!-- Button -->
                      <button id="resend" class="btn btn-secondary btn-block btn-lg mb-4 font-weight-bold" type="submit">
                          GET LINK
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
    </div>
  </div>
</template>

<style scoped>
  #not-available {
    padding: 120px;
  }

  #not-available p {
    margin-bottom: 36px;
    font-size: 1.125em;
    color: #A7A7A7;
  }

  #not-available-container {
    padding-left: 80px;
    padding-right: 80px;
  }

  #laptop {
    width: 180px;
    height: 216px;
  }

  #laptop, #oops {
    color: black;
  }

  .background-color-black {
    background-color: black !important;
  }

  .text-1 {
    color: #F38704 !important;
  }

  .border-white {
    border-color: white;
  }

  .card {
    border-radius: 4px;
  }

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
      margin: 21px 17px;
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
      -webkit-text-fill-color: white;
      background-color: black !important;
    }

    input:focus{
      box-shadow: none !important;
    }

    input:-webkit-autofill,
    input:-webkit-autofill:hover, 
    input:-webkit-autofill:focus, 
    input:-webkit-autofill:active  {
        -webkit-box-shadow: 0 0 0 30px black inset !important;
        border-radius: 0;
    }

    hr {
      border: 1px solid #6c757d;
    }

    #form-email {
      margin-right: 32px;
      margin-left: 32px;
      margin-bottom: 46px;
    }

    h1 {
      font-size: 1.25rem;
      margin: 76px 0 0 0;
    }

    img {
      width: 154px;
    }

    #verification-link-text {
      font-size: 0.825rem;
    }

    #verification-link-text span {
      color: black;
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
