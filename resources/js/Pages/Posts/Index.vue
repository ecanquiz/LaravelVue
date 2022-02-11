<template>
  <div>
    <page-header> Publicaciones </page-header>
        
    <div class="flex space-x-2">
      <button
        @click="createRow()"
        class="btn btn-primary"
      >
        Crear
      </button>
    </div>

    <div class="overflow-hidden panel mt-6"> 

      <div class="mb-6 flex justify-between items-center">
        <div class="flex items-center">
          <div class="flex w-full bg-white shadow rounded">
            <!-- Note: can't use v-model here, because search is a prop. -->
            <!-- Also, setSearch is debounced 300ms -->
            <input
              class="relative w-full px-6 py-3 rounded focus:shadow-outline"
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
              <th class="">No.</th>
              <th class="">
                <a href="#" @click.prevent="setSort('title')">Título</a>
              </th>
              <th class="">
                <a href="#" @click.prevent="setSort('body')">Cuerpo</a>
              </th>
              <th class="">Acción</th>
            </tr>
          </thead>
          <tbody>
            <tr v-for="row in rows.data">
              <td class="">{{ row.id }}</td>
              <td class="">{{ row.title }}</td>
              <td class="">{{ row.body }}</td>
              <td class="">
                <div class="flex items-center space-x-1">
                  <button @click="editRow(row)" class="btn btn-primary btn-xs">
                    Editar
                  </button>
                  <button @click="deleteRow(row)" class="btn btn-danger btn-xs">
                    Eliminar
                  </button>
                </div>
              </td>
            </tr>
          </tbody>
        </table>
      </div>
      <Pagination :links="rows.links" />          
      <Create @closeModal="closeModal" v-if="isCreate" />
      <Edit @closeModal="closeModal" v-if="isEdit" :post="post" />          
    </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import Create from "./Create.vue";
import Edit from "./Edit.vue";
import { Inertia } from "@inertiajs/inertia";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import { useSearch } from "@/hooks/useTableGrid";
import { defineComponent, ref } from "vue";

export default defineComponent({
  metaInfo: { title: "Posts" },
  name: "Index",
  layout: Layout,
  components: {
    Create,
    Edit,
    PageHeader,
    Pagination,
  },
  props: ["rows", "errors", "search", "sort", "direction"],

  setup(props) {
  
    const isCreate = ref(false);
    const isEdit = ref(false);    
    const post = ref({
      id: null,
      title: null,
      body: null,
    });   
   
    const createRow = () => {            
      isCreate.value = true;
    };
    
    const editRow = (data) => {      
      post.value = Object.assign({}, data);      
      isEdit.value = true;
    };
    
    const deleteRow = (data) => {
      if (!confirm("¿Estás seguro de que quieres eliminar?")) return;
      data._method = "DELETE";
      Inertia.post("/posts/" + data.id, data);
      closeModal();
    };
    
    const closeModal = () => {
      isEdit.value = false;
      isCreate.value = false;
    };

    return {       
       post,
       isCreate,
       isEdit,
       createRow,
       editRow,       
       deleteRow,
       closeModal,
      ...useSearch(props, 'posts') 
    }
  
  }
});
</script>
