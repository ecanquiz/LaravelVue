<template>
  <Header />
  <div class="flex justify-center min-h-screen bg-green-100">
    <Sidebar />
    <div class="flex-1 flex flex-col overflow-hidden">
      <FlashMessages />
      <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
        <div class="mx-auto px-2 lg:px-4 xl:px-6 py-2">
          <slot />
        </div>
      </main>

    </div>
  </div>
      <footer
        v-if="$page.props.settings.footer_message"
        class="footer text-right p-2 text-sm bg-green-500"
        v-html="$page.props.settings.footer_message"
      ></footer>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import FlashMessages from "@/Shared/FlashMessages";
import Header from "./Header.vue";
import Sidebar from "./Sidebar.vue";

export default defineComponent({
  components: {
    FlashMessages,
    Header,
    Sidebar,
  },
  setup(_) {
    //onMounted(() => console.log(window));

    return {};
  },
});
</script>
