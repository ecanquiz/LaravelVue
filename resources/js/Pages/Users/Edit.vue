/* https://tailwindcss-forms.vercel.app/ */
<template>
  <div>
    <page-header> Editar usuario </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('users')">
        Ver todos
      </Link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
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
            <span class="text-gray-700">Correo</span>
            <input v-model="form.email" type="email" class="" />
            <div v-if="errors.email" class="form-error">
              {{ errors.email }}
            </div>
          </label>
          <!-- password -->
          <label class="block">
            <span class="text-gray-700">Password</span>
            <input v-model="form.password" type="password" class="" />
            <div v-if="errors.password" class="form-error">
              {{ errors.password }}
            </div>
          </label>
          <!-- role -->
          <label class="block">
            <span class="text-gray-700">Rol</span>
            <select v-model="form.role_id" class="">
              <option v-for="role in roles" :value="role.id" :key="role">
                {{ role.name }}
              </option>
            </select>
          </label>
        </div>

        <div class="mt-4 px-2 border-gray-100 flex justify-end space-x-2">
          <loading-button
            :loading="sending"
            class="btn btn-primary ml-auto"
            type="submit"
          >
            Guardar
          </loading-button>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import LoadingButton from "@/Shared/LoadingButton";
import PageHeader from "@/Shared/PageHeader";

export default {
  metaInfo() {
    return {
      title: `${this.form.name}`,
    };
  },
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    user: Object,
    roles: Array,
  },
  data() {
    return {
      sending: false,
      form: {
        name: this.user.name,
        email: this.user.email,
        password: null,
        role_id: this.user.role_id,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.put(this.route("users.update", this.user.id), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {},
      });
    },
  },
};
</script>
