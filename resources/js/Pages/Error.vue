<template>
  <div class="container mx-auto px-4">
    <section class="py-12 px-4 text-center">
      <div class="max-w-auto mx-auto">
        <div class="md:max-w-lg mx-auto">
          <span class="text-gray-300 text-9xl font-black">
            {{ cod }}
          </span>
        </div>
        <h2 class="mt-8 text-xl lg:text-5xl text-gray-100">
          {{ msg }}
        </h2>
        <a href="/" class="btn btn-primary mt-12 inline-block uppercase shadow-md">
          Volver a la página de inicio
        </a>
      </div>
    </section>
  </div> 
</template>

<script>
import Layout from "@/Layouts/ErrorsLayout";
export default {
  layout: Layout,
  props: {
      msg: String,
      cod: Number
  },
}
</script>
