<template>
  <div class="w-100">
    <navbar />
    <div id="not-available" class="d-none d-sm-block d-sm-none d-md-block">
      <div id="not-available-container" class="bg-white text-center pt-3 pb-3">
        <fa id="laptop" icon="laptop"></fa>
        <h1 id="oops" class="font-weight-normal">Oops!</h1>
        <p class="mt-4 font-weight-normal">Sorry, we're only available in mobile right now. We'll let you know as soon as we are!</p>
      </div>
    </div>
    <div class="d-block d-sm-none d-none d-sm-block d-md-none">
        <div class="d-block d-sm-none">
          <div class="p-3">
            <div>
              <h1 class="text-black">Welcome to your competitive community</h1>
            </div>
          </div>
          <div>
            <img src="/svg/Team building importance in business success.svg" class="img-fluid" alt="illustration">
          </div>
        </div>
        <div class="d-none d-sm-block d-sm-none d-md-block">
          <div class="container p-3">
            <div class="row">
              <div class="col my-auto">
                <h1 class="text-white font-weight-light">Welcome to your competitive community</h1>
              </div>
              <div class="col">
                <img src="updated-resume.svg" class="img-fluid" alt="illustration">
              </div>
            </div>
          </div>
        </div>
        <div id="find-people-container" class="bg-light">
          <div id="find-people-button" class="text-center">
            <router-link id="find-people-you-need-button" :to="{ name: 'login' }" tag="button" class="btn btn-dark btn-lg h-text-white">Find team you need</router-link>
          </div>
        </div>
        <div id="kita-join-users-container" class="bg-white">
          <div class="text-center">
            <h2 class="text-dark heading-text-white">Who is KITAJOIN for?</h2>
            <h3 class="font-weight-light text-dark">Any Bandung State Polytechnic student looking to navigate their life</h3>
          </div>
        </div>
        <div id="get-started" class="bg-light">
          <div class="text-center">
            <h2 id="join-teams-text" class="font-weight-light mb-4">Join your colleagues, classmates, and friends teams on KITAJOIN.</h2>
            <router-link id="get-started-button" :to="{ name: 'login' }" tag="button" class="btn btn-lg text-white">Get started</router-link>
          </div>
        </div>
        <div id="kita-join-users-container " class="bg-black">
          <div class="p-3">
            <p id="footer-copy-text" class="text-white font-weight-light text-center mb-0">KITAJOIN © 2020</p>
          </div>
        </div>
    </div>
  </div>
</template>

<script>
import { mapGetters } from 'vuex'
import Navbar from '~/components/Navbar'

export default {
  layout: 'basic',

  metaInfo () {
    return { title: this.$t('home') }
  },

  data: () => ({
    title: window.config.appName
  }),

  computed: mapGetters({
    authenticated: 'auth/check'
  }),

  components: {
    Navbar
  }
}
</script>

<style scoped>
.top-right {
  position: absolute;
  right: 10px;
  top: 18px;
}

.title {
  font-size: 85px;
}

#find-people-you-need-button {
  border-radius: 28px !important;
}

h2 {
  font-size: 9vw;
}

h3 {
  font-size: 8vw;
}

#copyright {
  height: auto;
}

#footer-copy-text {
  font-size: 0.75rem;
}

#join-teams-text {
  color: black
}

#get-started-button {
  border-radius: 28px !important;
  background-color: black;
}

#find-people-container {
  padding: 0 16px 152px 16px;
}

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

.text-black {
  color: black;
}

@media (max-width: 1000px) {
  #find-people-container {
    margin: 40px 0 0 0;
    padding: 0;
  }

  #kita-join-users-container {
    margin: 40px 0 0 0;
  }

  #get-started {
    margin: 100px 0 24px 0;
  }
}

@media (min-width: 768px) {
  h1 {
    font-size: 7vw;
  }

  .h-text-white {
    text-align: center;
    color: white !important;
  }

  #find-people-container, #kita-join-users-container {
    background-color: black !important;
  }

  #find-people-button, #kita-join-users-container {
    text-align: center;
  }

  img {
    width: auto;
    height: 100%;
  }

  h3 {
    font-size: 6vw;
  }

  #get-started-button {
    font-size: 4vw;
  }
}
</style>
