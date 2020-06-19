<template>
  <div id="home-card" class="card-body">  
    <h6 id="person-heading-xs" class="d-block d-sm-none mb-3">Teams</h6>
    <h6 id="person-heading" class="d-none d-sm-block">Teams</h6>
    <card v-for="team in teams" v-if="team.user_id !== user.id" v-bind:key="team.id" class="shadow-sm mb-3">
      <div class="person-row">
        <div class="my-auto">
          <router-link id="person-name" :to="{ name: 'team.details', params: {id: team.id, user_id: team.user_id}}" class="navbar-brand font-weight-bold">
            {{ team.post_name }}
          </router-link>
        </div>
      </div>
    </card>
    <div id="SC_TBlock_745311" class="SC_TBlock text-white">loading...</div> 
  </div>
</template>

<style scoped>

  @media (min-width: 1025px) {
    #person-name, #person-interest {
      font-size: 3vw;
    }
  }

  @media (max-width: 1024px) {
    #person-name, #person-interest {
      font-size: 4.5vw;
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
    color: white;
    margin-top: 3vh;
    margin-bottom: 4vh;
    font-size: 5vw;
  }

  #person-heading-xs {
    text-align: center;
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
