<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penelitian" active>
        <AkhirPenelitian></AkhirPenelitian>
      </b-tab>
      <b-tab title="Pengabdian">
        <AkhirPengabdian></AkhirPengabdian>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import AkhirPengabdian from "@/view/lppm/pages/LaporanAkhir/akhir/AkhirPengabdian.vue";
import AkhirPenelitian from "@/view/lppm/pages/LaporanAkhir/akhir/AkhirPenelitian.vue";
export default {
  name: "LaporanAkhir",
  components: {
    AkhirPenelitian,
    AkhirPengabdian,
  },
  mounted() {
    console.log("start");
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Laporan Akhir" }]);
  },
};
</script>