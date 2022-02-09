<template>
  <div>
    <page-header> Mostrar usuario </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('users')">
        Ver todos
      </Link>
    </div>
    <div class="panel mt-6 p-4">      
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="w-2/5">Dato</th>
              <th class="w-3/5">Valor</th>
            </tr>
          </thead>      
          <tbody>
            <tr class="">
              <th class="">Nombre</th>
              <td class="">{{ user.name }}</td>
            </tr>
            <tr class="">
              <th class="">Correo</th>
              <td class="">{{ user.email }}</td>
            </tr>
            <tr class="">
              <th class="">Role</th>
              <td class="">{{ user.role }}</td>              
            </tr>        
          </tbody>
        </table>
      </div>
     </div>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";

export default {
  layout: Layout,
  components: {
    Link,
    PageHeader
  },
  props: { user: Object }
};
</script>
