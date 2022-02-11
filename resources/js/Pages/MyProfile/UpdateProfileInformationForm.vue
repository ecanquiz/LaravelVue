<template>
  <div class="">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="p-4">
        <h3 class="text-lg font-medium text-gray-900">Información de su cuenta</h3>
        <p class="mt-1 text-sm text-gray-600">
          Actualice la información de perfil y la dirección de correo electrónico de su cuenta.
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form class="" @submit.prevent="submit">
          <div
            class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md"
          >
            <div class="grid gap-6">
            
              <!-- name -->
              <label class="block">
                <span class="text-gray-700">Nombre</span>
                <input v-model="form.name" type="text" class="" />
                <div v-if="errors.name" class="form-error">
                  {{ errors.name }}
                </div>
              </label>

              <!-- email -->
              <label class="block">
                <span class="text-gray-700">Correo electrónico</span>
                <input v-model="form.email" type="email" class="" />
                <div v-if="errors.email" class="form-error">
                  {{ errors.email }}
                </div>
              </label>
                            
            </div>
          </div>

          <div
            class="flex items-center justify-end px-4 py-3 bg-gray-50 text-right sm:px-6 shadow sm:rounded-bl-md sm:rounded-br-md"
          >
            <loading-button
              :loading="sending"
              class="btn btn-primary"
              type="submit"
            >
              Guardar
            </loading-button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script>
import LoadingButton from "@/Shared/LoadingButton";

export default {
  components: {
    LoadingButton,
  },
  props: ['user'],
  data() {
    return {
      sending: false,
      form: {        
        name: this.user.name,
        email: this.user.email
      },
      errors: [],
    }
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("myprofile.update"),
        this.form, {
          onStart: () => this.sending = true,
          onFinish: () => this.sending = false,
          //onSuccess: () => {
          //  this.form = null;
          //},
          onError: () => {
            this.errors = this.$page.props.errors;
          },
        }
      );
    },    
  }
}
</script>
