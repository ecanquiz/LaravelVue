<template>
  <div class="mt-6 -mb-1 flex flex-wrap">
    <template v-for="(link, key) in links" :key="key">
      <div
        v-if="link.url === null"        
        class="mr-1 mb-1 px-4 py-3 text-sm border rounded text-gray-400"
        :class="{ 'ml-auto': link.label === 'Next' }" v-html=link.label>          
      </div>
      <Link
        v-if="link.url !== null"        
        class="mr-1 mb-1 px-4 py-3 text-sm border rounded hover:bg-white focus:border-indigo-500 focus:text-indigo-500"
        :class="{ 'bg-white': link.active, 'ml-auto': link.label === 'Next' }" :href="link.url" v-html=link.label></Link>
    </template>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3'

export default {
  components: {
    Link,
  },
  props: {
    links: Array,
  },
  mounted() {
    //console.log(this.links);
  }
}
</script>
