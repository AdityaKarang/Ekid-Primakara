<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Sumber Dana">
        <Sumberdana></Sumberdana>
      </b-tab>
      <b-tab title="Bentuk Dana">
        <Bentukdana></Bentukdana>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import Sumberdana from "@/view/lppm/pages/com-master/Sumberdana.vue";
import Bentukdana from "@/view/lppm/pages/com-master/Bentukdana.vue";
export default {
  components: {
    Sumberdana,
    Bentukdana,
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user.data
    }
  },
  mounted() {
      console.log(this.currentUser);
  }
};
</script>
