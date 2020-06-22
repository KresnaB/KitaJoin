<template>
  <div>
    <div id="not-available" class="d-none d-sm-block d-sm-none d-md-block">
      <div id="not-available-container" class="bg-white text-center pt-3 pb-3">
        <fa id="laptop" icon="laptop"></fa>
        <h1 id="oops" class="font-weight-normal">Oops!</h1>
        <p class="mt-4 font-weight-normal">Sorry, we're only available in mobile right now. We'll let you know as soon as we are!</p>
      </div>
    </div>
    <div id="home-card" class="d-block d-sm-none d-none d-sm-block d-md-none card-body my-28">  
      <div v-if="teams.length">
        <h5 id="person-heading-xs" class="d-block d-sm-none mb-23 text-black font-weight-bold">Teams</h5>
        <h6 id="person-heading" class="d-none d-sm-block">Teams</h6>
        <card v-for="team in teams" v-if="team.user_id !== user.id" v-bind:key="team.id" class="shadow-sm mb-2 mx-1 background-color-black">
          <div class="person-row my-4-5">
            <div class="my-auto">
              <router-link id="person-name" :to="{ name: 'team.details', params: {id: team.id, user_id: team.user_id}}" class="navbar-brand text-white font-weight-bold">
                {{ team.post_name }}
              </router-link>
            </div>
          </div>
        </card>
      </div>
      <div v-else class="text-center">
        <img class="w-284" src="svg/undraw_no_data_qbuo.svg" alt="No Teams Illustration">
        <div class="mt-5">
          <h4 class="font-weight-bold">No Team</h4>
        </div>
        <div class="mt-12">
          <p class="text-secondary">There is no team at the moment</p>
        </div>
        <div class="mt-44">
          <router-link class="btn btn-1 btn-circle btn-md" :to="{name: 'create.team'}" tag="button">
            <fa id="add-button-icon" class="text-white" icon="plus"></fa>
          </router-link>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>

  @media (min-width: 1025px) {
    #person-name, #person-interest {
      font-size: 3vw;
    }
  }

  @media (max-width: 1000px) {
    #person-name{
      font-size: 1.125rem;
    }

    #add-button-icon {
      font-size: 24px;
    }
  }

  #person-name {
    color: black;
    padding: 0;
  }

  .person-row {
    display: flex;
  }

  h6 {
    margin-bottom: 0;
  }

  p {
    margin-bottom: 0;
  }

  .card-body {
    padding: 12px;
  }

  .card {
    margin-top: 0;
    border-radius: 12px;
  }

  #home-card {
    padding: 0;
  }

  #person-heading, #person-heading-xs{
    margin-top: 3vh;
    margin-bottom: 4vh;
  }

  #person-heading-xs {
    text-align: center;
    
  }

  .text-black {
    color: black !important;
  }

  .w-284 {
    width: 284px;
  }

  .mt-12 {
    margin-top: 12px;
  }

  .btn-1 {
    background-color: #F38704;
  }

  .btn-circle.btn-md { 
    width: 50px; 
    height: 50px; 
    padding: 7px 10px; 
    border-radius: 25px; 
    font-size: 10px; 
    text-align: center; 
  }

  .mt-44 {
    margin-top: 44px;
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

  .my-28 {
    margin-top: 28px;
    margin-bottom: 28px;
  }

  .mb-23 {
    margin-bottom: 23px;
  }

  .my-4-5 {
    margin-top: 4.5px;
    margin-bottom: 4.5px;
  }

  .background-color-black {
    background-color: black;
  }
</style>

<script type="text/javascript">
  (sc_adv_out = window.sc_adv_out || []).push({
    id : "745311",
    domain : "n.ads1-adnow.com"
  });
</script>
<script type="text/javascript" src="//st-n.ads1-adnow.com/js/a.js"></script>

<script>
  import { mapGetters } from 'vuex';

  export default {
    middleware: 'auth',
    mounted() {
      this.$store.dispatch('fetchTeams'),
      this.$store.dispatch('fetchUser')
    },
    computed: {
      ...mapGetters([
        'teams',
        'user'
      ])
    },
    metaInfo () {
      return { title: this.$t('home') }
    }
  };
</script>
