<template>
  <div>

    <div>
      <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
        <div v-if="$page.props.jetstream.canUpdateProfileInformation">
          <UpdateProfileInformationForm :user="$page.props.user" />

          <!--SectionBorder-->
          <div class="hidden sm:block">
            <div class="py-8">
              <div class="border-t border-gray-200"></div>
            </div>
          </div>          
          
        </div>

        <div v-if="$page.props.jetstream.canUpdatePassword">
          <UpdatePasswordForm class="mt-10 sm:mt-0" :user="$page.props.user"/>

          <!--SectionBorder-->
          <div class="hidden sm:block">
            <div class="py-8">
              <div class="border-t border-gray-200"></div>
            </div>
          </div> 
          
        </div>

      </div>
    </div>
  </div>
</template>

<script>    
import Layout from "@/Layouts/AppLayout";
import UpdatePasswordForm from './UpdatePasswordForm'
import UpdateProfileInformationForm from './UpdateProfileInformationForm'
export default {
  layout: Layout,
  components: {    
    UpdatePasswordForm,
    UpdateProfileInformationForm,
  }/*,
  mounted () {
    console.log(this.$page.props.user)
  }*/
}
</script>
