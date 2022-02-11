<template>
  <div class="fixed z-10 inset-0 overflow-y-auto ease-out duration-400">
    <div>
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
          aria-labelledby="modal-headline"
        >
          <form>
            <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
              <div class="">
                <div class="mb-4">
                  <label
                    for="exampleFormControlInput1"
                    class="block text-gray-700 text-sm font-bold mb-2"
                  >
                    Título:
                  </label>
                  <input
                    type="text"
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput1"
                    placeholder="Enter Title"
                    v-model="form.title"
                  />
                  <div
                    v-if="$page.props.errors.title"
                    class="text-red-500"
                  >
                    {{ $page.props.errors.title[0] }}
                  </div>
                </div>
                <div class="mb-4">
                  <label
                    for="exampleFormControlInput2"
                    class="block text-gray-700 text-sm font-bold mb-2"
                  >
                    Cuerpo:
                  </label>
                  <textarea
                    class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"
                    id="exampleFormControlInput2"
                    v-model="form.body"
                    placeholder="Enter Body"
                  >
                  </textarea>
                  <div
                    v-if="$page.props.errors.body"
                    class="text-red-500"
                  >
                    {{ $page.props.errors.body[0] }}
                  </div>
                </div>
              </div>
            </div>
            <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
              <span class="flex w-full rounded-md shadow-sm sm:ml-3 sm:w-auto">
                <button 
                  wire:click.prevent="store()"
                  type="button"
                  class="btn btn-primary"                        
                  @click="update(form)"
                >
                  Guardar
                </button>
              </span>
              <span class="mt-3 flex w-full rounded-md shadow-sm sm:mt-0 sm:w-auto">
                <button
                  @click="closeModal()"
                  type="button"
                  class="btn btn-default">
                  Cancelar
                </button>
              </span>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "Forms",
  props: ["post", "editMode"],
  data() {
    return {      
      form: {
	      id: this.post.id,
        title: this.post.title,
        body: this.post.body,
      },
    }
  },
  methods: {
    reset: function () {
      this.form = {
	      id: this.post.id,
        title: this.post.title,
        body: this.post.body,
      };
    },
    update: function (data) {
      data._method = "PUT";
      this.$inertia.post("/posts/" + data.id, data);   
      this.closeModal();
    },
    closeModal: function () {
      this.reset();
      this.$emit('closeModal'); 
    }
  }
}
</script>
