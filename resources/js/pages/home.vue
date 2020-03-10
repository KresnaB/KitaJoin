<template>
  <div id="home-card" class="card-body">
    <h6 id="person-heading-xs" class="d-block d-sm-none">People</h6>
    <h6 id="person-heading" class="d-none d-sm-block">People</h6>
    <card v-for="person in people" v-bind:key="person.id" class="shadow-sm mb-2">
      <div class="person-row">
        <img class="rounded-circle my-auto" src="https://www.gravatar.com/avatar/'.md5(strtolower($this->email)).'.jpg?s=200&d=mm" alt=""/>
        <div class="my-auto ml-3">
          <router-link id="person-name" :to="{ name: 'profile.details', params: {id: person.id}}" class="navbar-brand font-weight-bold">
            {{ person.name }}
          </router-link>
          <p id="person-interest">{{ person.interest }}</p>
        </div>
      </div>
    </card>
  </div>
</template>

<style scoped>
    img {
      width: 15%;
      height: auto;
    }

  @media (min-width: 1025px) {
    img {
      width: 135px;
      height: 135px;
    }

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

<script>
import { mapGetters } from 'vuex';

export default {
  middleware: 'auth',
  mounted() {
    this.$store.dispatch('fetchPeople')
  },
  computed: {
    ...mapGetters([
      'people'
    ])
  },
  metaInfo () {
    return { title: this.$t('home') }
  }
};
</script>
