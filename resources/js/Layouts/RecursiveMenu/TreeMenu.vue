<script setup>
  import { ref } from "vue"
  import { Link } from '@inertiajs/inertia-vue3'
  
  const props = defineProps({ menu: Object })
  const urlImg = `${process.env.MIX_APP_URL}/menu/`
  const showChildren = ref(true)
  const toggleChildren = ()=> showChildren.value = !showChildren.value
</script>

<template>
  <li>
    <div v-if="menu.path==='#'" class="mb-2">
      <a href="#" @click="toggleChildren" style="color:white" class="flex items-center group py-0">
        {{ menu.title }}
      </a>
    </div>
    <div v-else
      class="mb-2"
      :class="[$page.url.startsWith('/' + menu.path) ? 'activeClass' : 'inactiveClass']"
    >  
      <Link :href="route(menu.path)">
        <span class="flex items-center group py-0">
          <img :src="urlImg + menu.icon" class="w-5 h-5 mr-2"/>
          {{ menu.title }}
        </span>
      </Link>
    </div>  
    <ul v-if="menu.children_menus.length>0" style="padding-left: 21px">
      <TreeMenu
        v-if="showChildren"
        v-for="(menu, index) in menu.children_menus"
        :key="index"
        :menu="menu"/>
    </ul>
  </li>    
</template>

