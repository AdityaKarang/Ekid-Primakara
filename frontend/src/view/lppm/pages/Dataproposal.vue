<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penelitian" active>
        <Proposalpenelitian></Proposalpenelitian>
      </b-tab>
      <b-tab title="Pengabdian">
        <Proposalpengabdian></Proposalpengabdian>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import Proposalpenelitian from "@/view/lppm/pages/Comp-plotting/Proposalpenelitian.vue";
import Proposalpengabdian from "@/view/lppm/pages/Comp-plotting/Proposalpengabdian.vue";
export default {
  components: {
    Proposalpenelitian,
    Proposalpengabdian,
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user
    }
  },
  mounted(){
    console.log(this.currentUser)
  }
};
</script>
