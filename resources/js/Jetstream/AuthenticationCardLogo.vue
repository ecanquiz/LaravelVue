<template>
<div class="max-w-md">
  <Link :href="'/'">
    <IconLogo class="h-40 w-40 text-green-900"/>
  </Link>    
</div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import IconLogo from '../Shared/Icons/Logo'

export default {
  components: { Link, IconLogo }
};
</script>
