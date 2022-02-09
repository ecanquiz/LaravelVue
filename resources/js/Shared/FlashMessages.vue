<template>
  <div class="bg-gray-200">
    <div
      v-if="$page.props.flash.success && show"
      class="mb-0 flex items-center justify-between bg-green-500 rounded max-w-full my-1 m-10"
    >
      <div class="flex items-center">
        <FlashMessagesIcon name="success" />
        <div class="py-4 text-white text-base font-medium">
          {{ $page.props.flash.success }}
        </div>
      </div>
      <button type="button" class="group mr-2 p-2" @click="close">
        <FlashMessagesIcon name="close-x" />
      </button>
    </div>

    <div
      v-else-if="$page.props.flash.error && show"
      class="mb-8 flex items-center justify-between bg-red-500 rounded max-w-full my-1 m-10"
    >
      <div class="flex items-center">
        <FlashMessagesIcon name="error" />
        <div class="py-4 text-white text-base font-medium">
          {{ $page.props.flash.error }}
        </div>
      </div>
      <button type="button" class="group mr-2 p-2" @click="close">
        <FlashMessagesIcon name="close-x" />
      </button>
    </div>
  </div>
</template>

<script>
import FlashMessagesIcon from "@/Shared/FlashMessagesIcon";

export default {
  components: { FlashMessagesIcon },
  data() {
    return {
      show: true
    };
  },
  watch: {
    '$page.props.flash': {
      handler() {
        this.show = true
      },
      deep: true
    }
  },
  methods: {
    close(){
      this.show = false;
      this.$page.props.flash.success= null;
      this.$page.props.flash.error = null;
      this.show = true;
    }
  }
};
</script>
