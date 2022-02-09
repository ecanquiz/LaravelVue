<template>
  <div>
    <page-header> Crear usuario </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('users')"
        >Ver todos</Link
      >
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
            <input
              v-model="form.email"
              type="email"
              class=""
              autocomplete="nope"
            />
            <div v-if="errors.email" class="form-error">
              {{ errors.email }}
            </div>
          </label>
          <!-- password -->
          <label class="block">
            <span class="text-gray-700">Password</span>
            <input
              v-model="form.password"
              type="password"
              class=""
              autocomplete="new-password"
            />
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
            <div v-if="errors.role_id" class="form-error">
              {{ errors.role_id }}
            </div>
          </label>
        </div>

        <div class="mt-6 px-2 border-gray-100 flex justify-end space-x-2">
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
  metaInfo: { title: "Create User" },
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    roles: Array,
  },
  data() {
    return {
      sending: false,
      form: {
        name: null,
        email: null,
        password: null,
        role_id: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("users.store"), this.form, {
        onStart: () => (this.sending = true),
        onFinish: () => (this.sending = false),
        onSuccess: () => {
          if (Object.keys(this.$page.props.errors).length === 0) {
            this.form.password = null;
          }
        },
        onError: () => {
          this.errors = this.$page.props.errors;
        },
      });
    },
  },
};
</script>
