<template>
  <header
    class="bg-green-700 border-b-2 border-red-700 flex items-center justify-between px-6 py-4"
  >
    <div class="flex items-center">
      <button
        @click="isOpen = true"
        class="text-gray-500 focus:outline-none lg:hidden"
      >
        <IconBurguer class="h-7 w-7 text-white"/>
      </button>

      <div class="px-1 py-1 mx-2">
        <Link :href="route('dashboard')">          
          <IconLogo class="h-7 w-7 text-white"/>
        </Link>
      </div>

      <Search/>
    </div>

    <div class="flex items-center">
      <button class="flex mx-4 text-white focus:outline-none">
        <IconBell class="h-6 w-6"/>                                                                                                
       </button>

       <div class="relative">
         <button
           @click="dropdownOpen = !dropdownOpen"
           class="relative z-10 block h-8 w-8 rounded-full overflow-hidden focus:outline-none"
         >
           <IconUser class="w-8 h-10 text-white rounded-full"/>
         </button>
 
         <div
           v-show="dropdownOpen"
           @click="dropdownOpen = false"
           class="fixed inset-0 h-full w-full z-10"
         ></div>
 
         <div
           v-show="dropdownOpen"
           class="absolute right-0 mt-2 py-2 w-48 bg-green-500 rounded-md shadow-xl z-20"
           @click="dropdownOpen=false"
         >
           <Link
             :href="route('myprofile.edit')"
             class="block px-4 py-2 text-sm text-white hover:bg-gray-400"
           >
             {{ $page.props.username}}
           </Link>
 
           <Link
             :href="route('logout')"
             class="block px-4 py-2 text-sm text-white hover:bg-gray-400"                             
             method="post"
             as="button"
           >
             <Logout />
           </Link>        
         </div>        
       </div>

</div>
  </header>
</template>

<script>
import { defineComponent, ref, onMounted } from "vue";
import { Link } from '@inertiajs/inertia-vue3';
import { useSidebar } from "../hooks/useSidebar";
import IconBell from "../Shared/Icons/Bell";
import IconBurguer from "../Shared/Icons/Burguer";
import IconLogo from "../Shared/Icons/Logo";
import IconUser from "../Shared/Icons/User";
import Search from "./Search";
import Logout from "./Logout";

export default defineComponent({
  components: {
    Search,
    IconBell,
    IconBurguer,
    IconLogo,
    IconUser,
    Logout,
    Link    
  },

  setup(_, { emit }) {
    const dropdownOpen = ref(false);
    const { isOpen } = useSidebar();

    return {
      isOpen,
      dropdownOpen,
    };
  },
});
</script>

