<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penelitian" active>
        <PublikasiPenelitian></PublikasiPenelitian>
      </b-tab>
      <b-tab title="Pengabdian">
        <PublikasiPengabdian></PublikasiPengabdian>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import PublikasiPenelitian from "@/view/lppm/pages/Publikasi/PublikasiPenelitian.vue";
import PublikasiPengabdian from "@/view/lppm/pages/Publikasi/PublikasiPengabdian.vue";
export default {
  name: "LaporanKemajuan",
  components: {
    PublikasiPenelitian,
    PublikasiPengabdian,
  },
  mounted() {
    console.log("start");
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Laporan Kemajuan" }]);
  },
};
</script>