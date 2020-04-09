<template>
  <div>
    <navbar />

    <div class="d-block d-sm-none">
      <div class="p-3">
        <div>
          <h1 class="text-white font-weight-light">Welcome to your competitive community</h1>
        </div>
      </div>
      <div class="mb-4">
        <img src="updated-resume.svg" class="img-fluid" alt="">
      </div>
    </div>
    <div class="d-none d-sm-block d-sm-none d-md-block">
      <div class="container p-3">
        <div class="row">
          <div class="col my-auto">
            <h1 class="text-white font-weight-light">Welcome to your competitive community</h1>
          </div>
          <div class="col">
            <img src="updated-resume.svg" class="img-fluid" alt="">
          </div>
        </div>
      </div>
    </div>
    <div id="find-people-container" class="bg-light pb-5">
      <div class="p-3">
        <h2 class="text-dark h-text-white">Connect with people who can join</h2>
      </div>
      <div id="find-people-button" class="pl-3 pb-4 pr-3 mb-5">
        <router-link id="find-people-you-need-button" :to="{ name: 'login' }" tag="button" class="btn btn-dark btn-lg h-text-white mb-5">Find people you need</router-link>
      </div>
    </div>
    <div id="kita-join-users-container " class="bg-white pt-5 pb-5 mt-5">
      <div class="p-3 text-center">
        <h2 class="text-dark heading-text-white">Who is KITAJOIN for?</h2>
        <h3 class="font-weight-light text-dark">Any Bandung State Polytechnic student looking to navigate their life</h3>
      </div>
    </div>
    <div class="bg-white pt-5 pb-5">
      <div class="p-3 text-center">
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

h1 {
  font-size: 12vw;
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
