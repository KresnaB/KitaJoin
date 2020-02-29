<template>
  <div id="home-card" class="card-body">
    <h6 id="person-heading-xs" class="d-block d-sm-none">People</h6>
    <h6 id="person-heading" class="d-none d-sm-block">People</h6>
    <card class="shadow-sm">
      <div class="person-row">
        <img class="rounded-circle my-auto" src="person.jpg" alt=""/>
        <div class="my-auto ml-3">
          <h6 id="person-name">Ivan Eka Putra</h6>
          <p id="person-interest">Competitive Programming</p>
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
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
