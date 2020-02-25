<template>
  <card class="shadow-sm mt-5">
    <div class="person-row">
      <img src="image.jpg" class="rounded-circle my-auto" alt="" />
      <div class="my-auto ml-3">
        <h6>Ivan Eka Putra</h6>
        <p>Competitive Programming</p>
      </div>
    </div>
  </card>
</template>

<style>
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
</style>

<script>
export default {
  middleware: 'auth',

  metaInfo () {
    return { title: this.$t('home') }
  }
}
</script>
