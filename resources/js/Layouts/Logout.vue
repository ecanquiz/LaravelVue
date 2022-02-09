<template>
  <div class="inline-flex items-center space-x-2">
    <span class="hidden sm:inline">Logout</span>
    <IconLogout class="w-6 h-6 text-white" />
  </div>
</template>

<script>
import IconLogout from "../Shared/Icons/Logout";
export default {
  components: { IconLogout },
  name: "Logout",
  /*methods: {
    logout() {
      this.$store.dispatch("auth/logout");
    },
  },*/
};
</script>
