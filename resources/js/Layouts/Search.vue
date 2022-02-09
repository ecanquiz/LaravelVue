/* based on: https://www.digitalocean.com/community/tutorials/vuejs-vue-autocomplete-component */
<template>
  <div class="autocomplete relative mx-4 lg:mx-0">
    <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
      <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
        <path
          d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z"
          stroke="currentColor"
          stroke-width="2"
          stroke-linecap="round"
          stroke-linejoin="round"
        />
      </svg>
    </span>
    <input
      @input="onChange"
      v-model="search"
      @keydown.down="onArrowDown"
      @keydown.up="onArrowUp"
      @keydown.enter="onEnter"
      type="text"
      class="w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600"
      placeholder="Buscar"
    />
    <ul id="autocomplete-results" v-show="isOpen" class="z-40 autocomplete-results">
      <li class="loading" v-if="isLoading">Cargando...</li>
      <li
        v-else
        v-for="(result, i) in results"
        :key="i"
        @click="setResult(result)"
        class="autocomplete-result"
        :class="{ 'is-active': i === arrowCounter }"
      >
        {{ result.text }}
      </li>
    </ul>
  </div>
</template>

<script>
import { Inertia } from "@inertiajs/inertia";
export default {
  name: "SearchAutocomplete",
  data() {
    return {
      isOpen: false,
      results: [],
      search: "",
      isLoading: false,
      arrowCounter: -1,
      timeout: null,
    };
  },
  mounted() {
    document.addEventListener("click", this.handleClickOutside);
  },
  destroyed() {
    document.removeEventListener("click", this.handleClickOutside);
  },
  methods: {
    onChange() {
      // clear debounce
      clearTimeout(this.timeout);

      // if no text, abort
      if (!this.search) {
        this.results = [];
        this.isLoading = false;
        this.isOpen = false;
        return;
      }

      // get results
      this.isLoading = true;
      this.timeout = setTimeout(() => {
        fetch(route("search", { s: this.search }))
          .then((r) => r.json())
          .then((r) => {
            this.results = r;
            this.isLoading = false;
            this.isOpen = true;
          });
      }, 500);
    },
    setResult(result) {
      Inertia.visit(result.url);
      this.isOpen = false;
    },
    handleClickOutside(event) {
      if (!this.$el.contains(event.target)) {
        this.isOpen = false;
        this.arrowCounter = -1;
      }
    },
    onArrowDown() {
      if (this.arrowCounter < this.results.length) {
        this.arrowCounter = this.arrowCounter + 1;
      }
    },
    onArrowUp() {
      if (this.arrowCounter > 0) {
        this.arrowCounter = this.arrowCounter - 1;
      }
    },
    onEnter() {
      this.setResult(this.results[this.arrowCounter]);
      this.isOpen = false;
      this.arrowCounter = -1;
    },
  },
};
</script>

<style>
.autocomplete {
  position: relative;
}

.autocomplete-results {
  background-color: white;
  width: 100%;
  position: absolute;
  padding: 0;
  margin: 0;
  border: 1px solid #ccc;
}

.autocomplete-result {
  list-style: none;
  text-align: left;
  padding: 4px 2px;
  cursor: pointer;
}

.autocomplete-result.is-active,
.autocomplete-result:hover {
  background-color: #4aae9b;
  color: white;
}
</style>
