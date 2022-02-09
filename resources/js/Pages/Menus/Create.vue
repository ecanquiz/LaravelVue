<template>
  <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
    <div class="fixed inset-0 transition-opacity">
      <div class="absolute inset-0 bg-gray-500 opacity-75"></div>
    </div>
    <!-- This element is to trick the browser into centering the modal contents. -->
    <span class="hidden sm:inline-block sm:align-middle sm:h-screen"></span>​
    <div
      class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full"
      role="dialog"
      aria-modal="true"
      aria-labelledby="modal-headline">
      <form v-on:submit.prevent="submit">
        <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">

          <table style="width: 100%" id="main">                
            <tr>
              <th colspan="2" class="bg-gray-200 text-center font-bold py-2">Crear nueva opción del menú</th>
            </tr>
            <tr>
              <td colspan="2">
                <table id="id_table_padre" style="width: 100%">                       
                  <tr v-for="(selTex, index) in selTexs" class="font-bold">
                    <td width="50%" class="bg-gray-100 py-2">{{ selTex.title }}</td>
                    <td class="bg-gray-100 py-2">( nivel {{ selTex.nivel }} )</td>
                    <td class="bg-gray-100 py-2">
                      <span 
                        v-if="index==selTexs.length-1"
                        title="Retroceder un paso"
                        style="cursor:pointer"
                        class="glyphicon glyphicon-step-backward"
                        @click="stepBackward(selTex.id)">&lt;</span>
                      <span v-else >&nbsp;</span>
                    </td>
                    <td class="bg-gray-100 py-2">                                   
                      <span
                        v-if="index==selTexs.length-1 && index!=0"
                        title="Retroceder todos los pasos"
                        class="glyphicon glyphicon-fast-backward"
                        style="cursor:pointer"
                        @click="fastBackward()">&lt;&lt;</span>
                      <span v-else >&nbsp;</span>
                    </td>
                  </tr>
                </table>
              </td>                   
            </tr>
            <tr style="display:{DISPLAY}">
              <td id="id_td_seleccion" width="50%" class="bg-gray-100 py-2">Selección (nivel {{ nivel }})</td>
              <td class="bg-gray-100 py-2">
                <select
                  style="width: 100%;cursor:pointer;"
                  title="Seleccione una opción"
                  v-model="selVal" 
                  @change="stepFrontward(selVal)">
                  <option
                    v-for="(menu,index) in menus" 
                    :value="menu.id" 
                    :xlabel="menu.menu_id"
                    v-bind:selected="index === 0">{{ menu.title }}</option>
                </select>
              </td>
            </tr>
            <tr class="lospare"><td colspan="2"><hr/></td></tr>
            <tr class="lospare">
              <td colspan="2" >
                <!--form method="POST" v-on:submit.prevent="createMenu"-->
                <table width="100%">
                  <tr>
                    <td align="left" id="id_td_descripcion" width="50%">
                      Opción (nivel {{ nivel }})
                    </td>
                    <td>
                      <input
                        type="text"
                        name="menu"
                        class="form-control"
                        v-model="form.title"
                        placeholder="Opction..." />
                    </td>
                  </tr>
                  <tr>
                    <td align="left" width="50%">
                      Ruta (nivel {{ nivel }})
                    </td>
                    <td>
                      <input
                        type="text"
                        name="path"
                        class="form-control"
                        v-model="form.path"
                        placeholder="Path..." />
                    </td>
                  </tr>
                  <tr>
                    <td align="left" width="50%">
                      Icon (nivel {{ nivel }})
                    </td>
                    <td>
                      <input
                        type="text"
                        name="icon"
                        class="form-control"
                        v-model="form.icon"
                        placeholder="Icon..." />
                    </td>
                  </tr>
                  <tr>
                    <td align="left" width="50%">
                      Orden (nivel {{ nivel }})
                    </td>
                    <td>
                      <input
                        type="text"
                        name="sort"
                        class="form-control"
                        v-model="form.sort"
                        placeholder="Sort..." />
                    </td>
                  </tr>
                  <!--tr>
                    <td align="center" colspan="2">
                      <input type="submit" class="btn btn-primary" value="Guardar">
                      <span v-for="error in errors" class="text-danger">@{{ error }}</span>
                    </td>
                  </tr-->
                </table>
                <!--/form-->
              </td>
            </tr>
          </table>
        
        </div>
        <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
          <!--loading-button :loading="sending" class="btn-indigo ml-auto" type="submit">
	    Update Organization
	  </loading-button-->
          <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
            <button
              v-on:click.once="submit"              
              class="inline-flex justify-center w-full rounded-md border border-transparent px-4 py-2 bg-green-600 text-base leading-6 font-medium text-white shadow-sm hover:bg-green-500 focus:outline-none focus:border-green-700 focus:shadow-outline-green transition ease-in-out duration-150 sm:text-sm sm:leading-5">
              Create
            </button>
          </span>
          <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
            <button
	          @click="closeModal111"
	          type="button"
	          class="inline-flex justify-center w-full rounded-md border border-gray-300 px-4 py-2 bg-white text-base leading-6 font-medium text-gray-700 shadow-sm hover:text-gray-500 focus:outline-none focus:border-blue-300 focus:shadow-outline-blue transition ease-in-out duration-150 sm:text-sm sm:leading-5">Cancel</button>
          </span>
        </div>
      </form>
    </div>
  </div>
</template>

<script>
import LoadingButton from '@/Shared/LoadingButton'
export default {
  components: {    
    LoadingButton,
  }, 
  data() {
    return {
      menus: [],
      selVal : 0,
      selTexs : [],
      nivel: 0,
      isDisabled: false,
      form: {
        title: '',
        menu_id: 0,
        path: '#',
        icon: 'icon',
        sort: 0
      }   
    }
  },
  created: function() {
    this.stepFrontward(0);
  },    
  methods: {
    validateForm() {
      let element = document.querySelector("input:invalid");
      return element === null ? true : false;
    },         
    closeModal111: function () {
      this.$emit('closeModal0');        
    },
    showSelected: function () {
      let menu = (this.menus.find(element => element.id === this.selVal));
      this.selTexs.push({ 
        nivel: this.nivel,
        title: menu.title,
        id   : menu.menu_id 
      });
    },   
    stepFrontward: function (menuId = 0, step = true ) {
      menuId= !menuId ? 0 : menuId;      
      axios.get(`menus/children/${menuId}`,).then((res) => {
        if (step) {
            if (this.selVal) {                    
              this.showSelected();
              this.nivel++;
              this.form.menu_id = this.selVal;
            }
          } else {
            this.nivel--;
            this.form.menu_id = res.data[0].menu_id;
          }
          this.menus = [ {id:0 , title:'Seleccione...'} ].concat(res.data);
          this.selVal = 0;          
      })
    },
    stepBackward: function (id) {
      this.selTexs.pop();
      this.stepFrontward(id, false);
    },
    fastBackward: function (id) {
      this.nivel = 0;
      this.selTexs = [];
      this.stepFrontward(0);
    },
    submit() {
      if (this.isDisabled === false) {
        this.isDisabled = true;
        this.form._method = 'POST';           
        this.$inertia.post(this.route('menus.store'), this.form, {         
          onStart: () => this.sending = true,
          onFinish: () => {
            //this.sending = false;
            //this.isDisabled = false;
          },
          onSuccess: () => {
            if (Object.keys(this.$page.props.errors).length === 0) {
              //this.isDisabled = false;
              this.$emit('closeModal0');
            }
          },
        })
      }
    }, 
    createMenu: function () {
      /*let url = `${process.env.MIX_APP_URL}menu/store`;
      axios.post(url, {
        menu_id: this.form.menu_id,
        title  : this.form.title,
        path: this.form.path,
        icon: this.form.icon,
        sort: this.form.sort
      }).then(response => {
        gridViewModel.getMenus();
        this.form.title = '';
        this.errors = [];
        $('#create').modal('hide');
        Notification.success('Nueva tarea creada con éxito');
      }).catch(error => {
        this.errors = error.response.data;
      });*/
    }    
  }
}
</script>
