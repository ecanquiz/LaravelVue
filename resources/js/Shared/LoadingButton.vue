<template>
  <button :disabled="loading" class="flex items-center">
    <div v-if="loading" class="animate-ping" />
    <slot />
  </button>
</template>

<script>
export default {
  props: {
    loading: Boolean,
  },
}
</script>
