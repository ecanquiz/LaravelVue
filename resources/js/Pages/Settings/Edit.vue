/* https://tailwindcss-forms.vercel.app/ */
<template>
  <div>    
    <page-header>Ajustes</page-header>
    <div class="panel mt-4">
      <form class="p-4" @submit.prevent="submit">
        <div class="grid gap-4">

          <!-- default_pagination -->
          <label class="block">
            <span class="text-gray-700">Paginación default</span>
            <input v-model="default_pagination" type="text" class="" />
            <div v-if="errors.default_pagination" class="form-error">
              {{ errors.default_pagination }}
            </div>
          </label>

          <!-- footer_message -->
          <label class="block">
            <span class="text-gray-700">Mensaje pie de página</span>
            <input v-model="footer_message" type="text" class="" />
            <div v-if="errors.footer_message" class="form-error">
              {{ errors.footer_message }}
            </div>
          </label>
        </div>

        <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
          <input
            type="submit"
            class="btn btn-primary"
            :value="sending ? 'Guardando...' : 'Guardar'"
          />
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    };
  },
  layout: Layout,
  components: {
    PageHeader,
  },
  props: {
    default_pagination: Number,
    footer_message: String,
    errors: Object,
  },
  data() {
    return {
      sending: false,
      form: this.user,
    };
  },
  methods: {
    submit() {
      this.$inertia.put(
        this.route("settings.update"),
        {
          default_pagination: this.default_pagination,
          footer_message: this.footer_message,
        },
        {
          onStart: () => (this.sending = true),
          onFinish: () => (this.sending = false),
        }
      );
    },
  },
};
</script>
