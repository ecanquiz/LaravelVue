<script setup>
import { Inertia } from "@inertiajs/inertia"
import TreeMenu from './TreeMenu'

const menus = Inertia.page.props.menu.data
</script>

<template>
  <nav class="py-2 px-6">
    <ul v-if="menus.length>0">
      <TreeMenu
        v-for="(menu, index) in menus"
        :key="index"
        :menu="menu"/>
      </ul>
    </nav>
</template>


