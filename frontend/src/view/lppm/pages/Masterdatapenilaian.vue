<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penilaian Proposal" active>
        <Kriteriaproposal></Kriteriaproposal>
      </b-tab>
      <b-tab title="Penilaian Kemajuan">
        <Kriteriakemajuan></Kriteriakemajuan>
      </b-tab>
      <b-tab title="Penilaian Monev">
        <Kriteriamonev></Kriteriamonev>
      </b-tab>
      <b-tab title="Penilaian Akhir">
        <Kriteriaakhir></Kriteriaakhir>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import Kriteriaproposal from "@/view/lppm/pages/com-master/Kriteriaproposal.vue";
import Kriteriakemajuan from "@/view/lppm/pages/com-master/Kriteriakemajuan.vue";
import Kriteriamonev from "@/view/lppm/pages/com-master/Kriteriamonev.vue";
import Kriteriaakhir from "@/view/lppm/pages/com-master/Kriteriaakhir.vue";
export default {
  components: {
    Kriteriaproposal,
    Kriteriakemajuan,
    Kriteriamonev,
    Kriteriaakhir,
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user.data
    }
  },
  mounted() {
    console.log(this.currentUser)
  },
};
</script>
