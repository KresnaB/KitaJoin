<template>
  <button :type="nativeType" :disabled="loading" :class="{
    [`btn-${type}`]: true,
    'btn-block': block,
    'btn-lg': large,
    'btn-loading': loading,
  }" class="btn rounded-0 font-weight-bold"
  >
    <slot />
  </button>
</template>

<style scoped>
 button {
   color: black;
   font-size: 12pt;
 }
</style>

</style>

<script>
export default {
  name: 'VButton',

  props: {
    type: {
      type: String,
      default: 'light'
    },

    nativeType: {
      type: String,
      default: 'submit'
    },

    loading: {
      type: Boolean,
      default: false
    },

    block: {
      type: Boolean,
      default: true
    },

    large: {
      type: Boolean,
      default: true
    }
  }
}
</script>
