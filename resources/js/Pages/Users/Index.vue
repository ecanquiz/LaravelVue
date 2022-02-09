<template>
  <div>
    <page-header> Usuarios </page-header>

    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('users.create')">
        <span>Crear</span>
      </Link>
    </div>

    <div class="overflow-hidden panel mt-6">
      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">
          <div class="flex w-full bg-white shadow rounded">
            <!-- Note: can't use v-model here, because search is a prop. -->
            <!-- Also, setSearch is debounced 300ms -->
            <input
              class=""
              type="text"
              :value="search"
              @input="setSearch"
              placeholder="Filtrar…"
            />
          </div>
        </div>
      </div>
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">
                <a href="#" @click.prevent="setSort('name')">Nombre</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('email')">Correo</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('role')">Role</a>
              </th>
              <th class="">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="user in rows.data" :key="user.id" class="">
              <td class="">
                <Link
                  class="text-indigo-600 hover:text-indigo-800 underline"
                  :href="route('users.show', user.id)"
                  tabindex="-1"
                >
                  {{ user.name }}
                </Link>
              </td>
              <td class="">
                {{ user.email }}
              </td>
              <td class="">
                {{ user.role.name }}
              </td>
              <td class="">
                <div class="flex items-center space-x-1">
                  <Link
                    :href="route('users.show', user.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-success btn-xs">Mostrar</button>
                  </Link>

                  <Link
                    :href="route('users.edit', user.id)"
                    tabindex="-1"
                  >
                    <button class="btn btn-primary btn-xs">Editar</button>
                  </Link>

                  <button
                    @click="deleteRow(user.id)"
                    class="btn btn-danger btn-xs"
                  >
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
            <tr v-if="rows.length === 0">
              <td class="" colspan="4">Usuarios no encontrados.</td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="rows.links" />
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import { useSearch } from "@/hooks/useTableGrid";

export default defineComponent({
  metaInfo: { title: "Users" },
  name: "Users",
  layout: Layout,
  components: {
    Link,
    PageHeader,
    Pagination,
  },
  props: ["rows", "errors", "search", "sort", "direction"],
  setup(props) {
    const load = (newParams) => {
      // mix defaults and new parameters
      const params = {
        search: props.search || "",
        sort: props.sort || "",
        direction: props.direction || "",
        ...newParams,
      };
      // convert obj into url
      const urlQuery = new URLSearchParams(params).toString();
      Inertia.get(`/users?${urlQuery}`, [], {
        preserveState: true,
      });
    };
    const deleteRow = (rowId) => {
      if (confirm("¿Estás seguro de que quieres eliminar?")) {
        Inertia.delete(route("users.destroy", rowId));
      }
    };

    return {
      deleteRow,
      ...useSearch(props, load),
    };
  },
});
</script>
