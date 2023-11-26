<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penelitian" active>
        <MonevPenelitian></MonevPenelitian>
      </b-tab>
      <b-tab title="Pengabdian">
        <MonevPengabdian></MonevPengabdian>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import MonevPengabdian from "@/view/lppm/pages/LaporanMonev/monev/MonevPengabdian.vue";
import MonevPenelitian from "@/view/lppm/pages/LaporanMonev/monev/MonevPenelitian.vue";
export default {
  name: "LaporanMonev",
  components: {
    MonevPenelitian,
    MonevPengabdian,
  },
  mounted() {
    console.log("start");
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Laporan Monev" }]);
  },
};
</script>