<template>
  <div>  
    <page-header> Menús </page-header>
    
    <div class="flex space-x-2">
      <button
        @click="openModalCreate()"
        class="btn btn-primary"
      >
        Crear
      </button>
    </div>
    
    <div class="overflow-hidden panel mt-6">
      <div class="table-data__wrapper">
        <table class="table-data">
          <thead>
            <tr class=""> 
              <th class="">Menu Options</th>                                                      
              <th class="">Path</th>
              <th class="">Icon</th>
              <th class="">Sort</th>               
              <th class="">Atcion(s)</th>               
            </tr>
          </thead>
        <tbody>              
          <tr v-for="menu in menus.data" :key="menu.id" class="hover:bg-gray-100 focus-within:bg-gray-100">               
            <td class="">{{ menu.alias }}</td>                                
            <td class="">{{ menu.path }}</td>
            <td class="">{{ menu.icon }}</td>  
            <td class="">{{ menu.sort }}</td>                          
            <td class="">              
              <div class="flex items-center space-x-1">
                <button @click="edit(menu)" class="btn btn-primary btn-xs">
                  Editar
                </button>
                <button @click="remove(menu.id)" class="btn btn-danger btn-xs">
                  Eliminar
                </button>
              </div>
            </td>               
          </tr>                
        </tbody>            
      </table>
        
      
      <Pagination :links="menus.links" />
      
      <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpenCreate">
        <Create @closeModal0="closeModalCreate"/>
      </div>
      <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400" v-if="isOpen">
        <Edit :menu="menu" @closeModal1="closeModal"/>
      </div>
      
    </div>
  </div>
  </div>
</template>

<script>
import Layout from "@/Layouts/AppLayout";
import PageHeader from "@/Shared/PageHeader";
import Pagination from "@/Shared/Pagination";
import Create from './Create'
import Edit from './Edit'
export default {
  metaInfo: { title: 'Menus' },
  layout: Layout,
  components: {
    PageHeader,
    Pagination,
    Create,
    Edit,    
  },
  props: {
    menus: Object    
  },
  data() {
    return {
      // editMode: false,
      isOpenCreate: false,
      isOpen: false,
      menu:{}
    }
  },
  mounted(){console.log(this.menus)},
  
  methods: {
    openModalCreate: function () {
      this.isOpenCreate = true;
    },
    openModal: function () {
      this.isOpen = true;
    },
    closeModalCreate: function () {
      this.isOpenCreate = false;
    },
    closeModal: function () {
      this.isOpen = false;
      //this.reset();
      //this.editMode=false;
    },
    closeModalCreate: function () {
      this.isOpenCreate = false;
    },
    edit: function (data) {      
      //this.editMode = true;
      this.menu=data;
      this.openModal();
    },
    remove(id) {
      Notification.confirm(() => {       
        this.$inertia.delete(this.route('menus.destroy', id));
      });
    }
  }
}
</script>
