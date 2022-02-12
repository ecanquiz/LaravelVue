<template>
  <div>
    <h1>Count: {{ counter }}</h1>

    <button @click="counter++">+1</button>
  </div>
</template>
<script>
import { defineComponent, ref } from "vue";
export default defineComponent({
  setup() {
    const counter = ref(0);
    return {      
      counter  
    }    
  }
});
</script>
