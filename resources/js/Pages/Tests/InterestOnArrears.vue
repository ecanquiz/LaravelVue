<template>
  <div>
    <page-header> Formula de Intereses de Mora </page-header>

    <div class="panel mt-2">
      <form @submit.prevent="submit" class="p-4">
        <div class="grid lg:grid-cols-2 gap-4">
          <label class="block">
            <span class="text-gray-700">Capital</span>
            <input v-model="form.capital" type="text" class="" />
            <div v-if="errors.capital" class="form-error">
              {{ errors.capital }}
            </div>
          </label>
          
          <label class="block">
            <span class="text-gray-700">Meses</span>
            <input v-model="form.numberOfMonths" type="text" class="" />
            <div v-if="errors.numberOfMonths" class="form-error">
              {{ errors.numberOfMonths }}
            </div>
          </label>
        </div>
      <div class="mt-6 px-2 border-gray-100 flex justify-end space-x-2">
        <loading-button
          :loading="sending"
          class="btn btn-primary ml-auto"
          type="submit"
        >
          Probar
        </loading-button>
      </div>
    </form>
    
    <div class="table-data__wrapper mt-4" v-if="interests">
        <table class="table-data">
          <thead>
            <tr class="">
              <th class="">Més</th>
              <th class="">Capital</th>
              <th class="">Tasa</th>
              <th class="">Interes</th>
              <th class="">Acumulado</th>              
            </tr>
          </thead>
          <tbody>
            <tr v-for="({interest, total}, index) in interests" :key="index" class="">
              <td class="">{{ index + 1 }}</td>
              <td class="">{{ form.capital }}</td>
              <td class="">3%</td>
              <td class="">{{ interest }}</td>
              <td class="">{{ total }}</td>              
            </tr>
            <tr>
              <td class="text-right" colspan="4">Total acumulado</td>
              <td class="" colspan="5">{{ totalInterest }}</td>
            </tr>
          </tbody>
        </table>
      </div>
      
      <div class="mt-4 text-gray-500">
        <p>InteresesDeMora = ( (Capital * TasaDeInteresesDeMora ) / 360 ) * 30</p>
        <p>TasaDeInteresesDeMora = 3% </p>
        <p>AcumuladoDeInteresesDeMora = InteresesDeMora * NumeroDeMeses</p>              
      </div>
      
      
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
  metaInfo: { title: "InterestOnArrears" },
  layout: Layout,
  components: {
    Link,
    LoadingButton,
    PageHeader,
  },
  props: [ "errors" ],
  data() {
    return {
      sending: false,
      totalInterest: null,
      interests: null,      
      form: {
        capital: null,
        numberOfMonths: null        
      },
    };
  },
  methods: {
    submit() {
      this.sending = true;

      axios.interceptors.response.use(
        (res) => res,
        (err) => Promise.reject(err)
      );

      axios.post(
          "../../tests/interest-on-arrears/test",
          this.form
        ).then((res) => {                    
            this.interests = res.data.interests; 
            this.totalInterest = res.data.totalInterest;        
            this.$page.props.flash.success = res.data.success;
        }).catch((err) => {
          if (err.response.data.errors) {
            this.errors = err.response.data.errors;
            this.$page.props.flash.error = err.response.data.message;
          }
        }).finally(() => (this.sending = false));
    },
  },
};
</script>
