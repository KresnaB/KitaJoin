<template>
  <div id="home-card" class="card-body">
    <h6 id="person-heading-xs" class="d-block d-sm-none">People</h6>
    <h6 id="person-heading" class="d-none d-sm-block">People</h6>
    <card class="shadow-sm">
      <div class="person-row">
        <img src="person.jpg" class="rounded-circle my-auto" alt="" />
        <div class="my-auto ml-3">
          <h6>Ivan Eka Putra</h6>
          <p class="d-block d-sm-none">Competitive Programming</p>
          <p class="d-none d-sm-block">0858********</p>
        </div>
        <h6 class="d-none d-sm-block my-auto ml-auto">Competitive Programming</h6>
      </div>
    </card>
  </div>
</template>

<style scoped>
  img {
    width: 44px;
    height: 44px;
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
  }

  #home-card {
    padding: 0;
  }

  #person-heading, #person-heading-xs{
    color: white;
    margin-top: 12px;
    margin-bottom: 12px;
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
