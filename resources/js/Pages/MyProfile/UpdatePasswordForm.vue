<template>
  <div class="">
    <div class="md:grid md:grid-cols-3 md:gap-6">
      <div class="p-4">
        <h3 class="text-lg font-medium text-gray-900">Actualiza contraseña</h3>
        <p class="mt-1 text-sm text-gray-600">
          Asegúrese de que su cuenta esté usando una contraseña larga y
          aleatoria para mantenerse seguro.
        </p>
      </div>
      <div class="mt-5 md:mt-0 md:col-span-2">
        <form class="" @submit.prevent="submit">
          <div
            class="px-4 py-5 bg-white sm:p-6 shadow sm:rounded-tl-md sm:rounded-tr-md"
          >
            <div class="grid gap-6">
              <!-- current_password -->
              <label class="block">
                <span class="text-gray-700">Contraseña actual</span>
                <input
                  v-model="form.current_password"
                  type="password"
                  class=""
                />
                <div v-if="errors.current_password" class="form-error">
                  {{ errors.current_password }}
                </div>
              </label>

              <!-- password -->
              <label class="block">
                <span class="text-gray-700">Contraseña</span>
                <input v-model="form.password" type="password" class="" />
                <div v-if="errors.password" class="form-error">
                  {{ errors.password }}
                </div>
              </label>

              <!-- password_confirmation -->
              <label class="block">
                <span class="text-gray-700">Contraseña (confirmación)</span>
                <input
                  v-model="form.password_confirmation"
                  type="password"
                  class=""
                />
                <div v-if="errors.password_confirmation" class="form-error">
                  {{ errors.password_confirmation }}
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
  data() {
    return {
      sending: false,
      form: {
        current_password: "",
        password: "",
        password_confirmation: "",
      },
      errors: [],
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        route("myprofile-password.update"),
        this.form,
        {
          onStart: () => (this.sending = true),
          onFinish: () => (this.sending = false),
          onSuccess: () => {
            this.form = null;
          },
          onError: () => {
            this.errors = this.$page.props.errors;
          },
        }
      );
    },
  },
};
</script>
