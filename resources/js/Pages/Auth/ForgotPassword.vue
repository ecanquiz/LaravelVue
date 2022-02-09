<template>
  <jet-authentication-card>
    <template #logo>
      <jet-authentication-card-logo />
    </template>

    <div class="mb-4 text-sm text-gray-600">
      Para restaurar tu contraseña escribe tu email. <br />
      Te enviaremos un enlace para que generes una nueva.
    </div>

    <div v-if="status" class="mb-4 font-medium text-sm text-green-600">
      {{ status }}
    </div>

    <jet-validation-errors class="mb-4" />

    <form @submit.prevent="submit">
      <div>
        <jet-label for="email" value="Email" />
        <jet-input
          id="email"
          type="email"
          class="mt-1 block w-full"
          v-model="form.email"
          required
          autofocus
        />
      </div>

      <div class="flex items-center justify-end mt-4">
        <jet-button
          class="btn btn-primary"
          :class="{ 'opacity-25': form.processing }"
          :disabled="form.processing"
        >
          Enviar contraseña
        </jet-button>
      </div>
    </form>
  </jet-authentication-card>
</template>

<script>
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo";
import JetButton from "@/Jetstream/Button";
import JetInput from "@/Jetstream/Input";
import JetLabel from "@/Jetstream/Label";
import JetValidationErrors from "@/Jetstream/ValidationErrors";

export default {
  components: {
    JetAuthenticationCard,
    JetAuthenticationCardLogo,
    JetButton,
    JetInput,
    JetLabel,
    JetValidationErrors,
  },

  props: {
    status: String,
  },

  data() {
    return {
      form: this.$inertia.form({
        email: "",
      }),
    };
  },

  methods: {
    submit() {
      this.form.post(this.route("password.email"));
    },
  },
};
</script>
