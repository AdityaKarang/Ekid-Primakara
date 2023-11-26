<template>
  <div>
    <v-card>
      <v-tabs v-model="tab" background-color="accent-4" grow>
        <v-tab v-for="itemTab in itemTabs" :key="itemTab">
          {{ itemTab }}
        </v-tab>
      </v-tabs>

      <v-tabs-items v-model="tab">
        <v-tab-item>
          <div class="p-3 mt-2">
            <DetailEditDataLaporanPenelitian />
          </div>
        </v-tab-item>
        <v-tab-item>
          <div class="p-3 mt-2">
            <DetailEditDataLaporanPengabdian />
          </div>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import DetailEditDataLaporanPenelitian from "@/view/lppm/pages/edit/DetailEditDataLaporanPenelitian";
import DetailEditDataLaporanPengabdian from "@/view/lppm/pages/edit/DetailEditDataLaporanPengabdian";

export default {
  name: "DetailEditLaporan",
  components: {
    DetailEditDataLaporanPenelitian,
    DetailEditDataLaporanPengabdian,
  },
  data() {
    return {
      tab: "Proposal",
      itemTabs: ["Penelitian", "Pengabdian"],
    };
  },

  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Detail Edit Laporan Dosen" },
    ]);
  },
};
</script>