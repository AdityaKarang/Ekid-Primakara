<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Penelitian" active>
        <KemajuanPenelitian></KemajuanPenelitian>
      </b-tab>
      <b-tab title="Pengabdian">
        <KemajuanPengabdian></KemajuanPengabdian>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import KemajuanPengabdian from "@/view/lppm/pages/LaporanKemajuan/kemajuan/KemajuanPengabdian.vue";
import KemajuanPenelitian from "@/view/lppm/pages/LaporanKemajuan/kemajuan/KemajuanPenelitian.vue";
export default {
  name: "LaporanKemajuan",
  components: {
    KemajuanPenelitian,
    KemajuanPengabdian,
  },
  mounted() {
    console.log("start");
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Laporan Kemajuan" }]);
  },
};
</script>