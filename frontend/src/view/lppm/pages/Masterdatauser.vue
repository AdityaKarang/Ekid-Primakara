<template>
    <div>
      <b-tabs content-class="mt-3">
        <b-tab title="Users">
          <Users></Users>
        </b-tab>
        <!-- <b-tab title="Roles">
          <Roles></Roles>
        </b-tab> -->
      </b-tabs>
    </div>
  </template>
  
  <script>
  import Users from "@/view/lppm/pages/com-master/Users.vue";
  import Roles from "@/view/lppm/pages/com-master/Roles.vue";
  export default {
    components: {
        Users,
        Roles
    },
  };
  </script>
  