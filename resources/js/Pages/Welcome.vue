<template>
  <div
    class="relative flex items-top justify-center min-h-screen sm:items-center sm:pt-0 bg-gray-100"
  >
    <div class="lg:px-8 max-w-md mx-auto sm:px-6">
      <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">      
        <IconLogo class="h-50 w-50 text-green-900"/>
      </div>

      <div v-if="canLogin" class="flex justify-center text-lg mt-10 space-x-5">
        <Link
          v-if="$page.props.user"
          href="/dashboard"
          class="block border border-gray-300 hover:bg-gray-300 px-4 py-1 rounded"
        >
          Dashboard
        </Link>

        <template v-else>
          <Link
            :href="route('login')"
            class="btn btn-primary"
          >
            Iniciar sesión
          </Link>

          <Link
            v-if="canRegister"
            :href="route('register')"
            class="btn btn-default"
          >
            Registrarse
          </Link>
        </template>
      </div>
    </div>
  </div>
</template>

<script>
import { Link } from '@inertiajs/inertia-vue3';
import IconLogo from '../Shared/Icons/Logo'

export default {
  components: { Link, IconLogo },
  props: {
    canLogin: Boolean,
    canRegister: Boolean,
    //laravelVersion: String,
    //phpVersion: String,
  },
};
</script>
