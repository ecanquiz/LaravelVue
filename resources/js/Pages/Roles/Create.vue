<template>
  <div>
    <page-header> Crear rol </page-header>
    <div class="flex space-x-2">
      <Link class="btn btn-primary" :href="route('roles')">
        Ver todos
      </Link>
    </div>

    <div class="panel mt-6">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">          
          <label class="block">
            <span class="text-gray-700">Nombre del rol</span>
            <input v-model="form.name" type="text" class="" />
            <div v-if="errors.name" class="form-error">
              {{ errors.name }}
            </div>
          </label>          
          
          <label class="block">
            <span class="text-gray-700">Descripción del rol</span>
            <input v-model="form.description" type="text" class="" />
            <div v-if="errors.description" class="form-error">
              {{ errors.description }}
            </div>
          </label>          
        </div><br/>
        <div class="table-data__wrapper">
          <table class="table-data">
            <thead>
              <tr class=""> 
                <th class="">Opciones del Menú</th>                             
                <th><input type="checkbox"  v-model="allSelected" @click="selectAll" title="Seleccionar todos"></th>
              </tr>
            </thead>
            <tbody>              
              <tr
	            v-for="menu in menus"
	            :key="menu.id"
	            :class="menu.path==='#'?'bg-gray-50 uppercase text-gray-500 text-xs':'hover:bg-gray-100 focus-within:bg-gray-100'"
	          > 
                <td>
	              {{ menu.alias }}
	            </td> 
                <td>              
                  <div v-if="menu.path !== '#'" class="flex items-center space-x-1">                                
                    <input type="checkbox" v-model="form.menu_ids" @click="select" :value="menu.id">
                  </div>
                </td>               
              </tr>                
            </tbody>            
          </table>      
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
import { Link } from "@inertiajs/inertia-vue3";
import Layout from "@/Layouts/AppLayout.vue";
import LoadingButton from "@/Shared/LoadingButton.vue";
import PageHeader from "@/Shared/PageHeader.vue";

export default {
  metaInfo: { title: "Create Role" },
  name: "Create Role",
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: {
    errors: Object,
    menus: Array,
  },
  data() {
    return {
      sending: false,           
      allSelected: false,
      selected: [],        
      form: {
        name: null,
        description: null,
        menu_ids: []
      }
    };
  },
  methods: {
    selectAll: function() {      
      if (!this.allSelected) {        
        let temp = [];
        this.menus.forEach(function (menu) {
          if (menu.path !== '#')
              temp.push(menu.id);
        });
        this.form.menu_ids=[];
        this.form.menu_ids=temp;
        this.allSelected=true;
      } else {
        this.form.menu_ids=[];
        this.allSelected=false;
      }      
    },
    select: function() {
      this.allSelected = false;
    },
    submit() {
      this.$inertia.post(this.route("roles.store"), this.form, {
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
