<template>
  <div>
    <div class="card card-custom card-transparent">
      <Tree
        title="JADWAL PENELITIAN DAN PENGABDIAN MASYARAKAT"
        deskripsi="Jadwal Pengajuan atau Pengumpulan Penelitian dan Pengabdian"
        :dataTimeLine="listJadwal"
      ></Tree>
    </div>
  </div>
</template>
<style lang="scss">
@import "@/assets/sass/pages/wizard/wizard-4.scss";
</style>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
// import CountDashboard from "@/view/content/CountDashboard";
import Tree from "@/view/content/CustomTree";
import axios from "axios";

export default {
  name: "Dashboard",
  components: {
    // CountDashboard,
    Tree,
  },
  data() {
    return {
      listJadwal: []
    };
  },
  computed: {
    currentUser(){
      return this.$store.state.auth.user
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Dashboard" }]);
    this.fetchData();
    console.log(this.currentUser);
  },
  methods: {
 async fetchData() {
   await axios
      .get("/penjadwalan")
      .then((response) => {
        const data = response.data.data;
        const listJadwal = [];
        
        data.forEach((item) => {
          let customTitle = "";
          
          // Menentukan custom title berdasarkan jenis dan type jadwal
          if (item.type === "proposal" && item.jenis === "penerimaan") {
            customTitle = "Jadwal Proposal";
          } else if (item.type === "Proposal" && item.jenis === "penilaian") {
            customTitle = "Penilaian Proposal";
          } else if (item.type === "Laporan Kemajuan" && item.jenis === "penerimaan") {
            customTitle = "Jadwal Laporan Kemajuan";
          } else if (item.type === "Laporan Kemajuan" && item.jenis === "penilaian") {
            customTitle = "Penilaian Laporan Kemajuan";
          // } else if (item.type === "Monev" && item.jenis === "penerimaan") {
          //   customTitle = "Jadwal Monev";
          // } else if (item.type === "Monev" && item.jenis === "penilaian") {
          //   customTitle = "Jadwal Monev Penilaian";
          } else if (item.type === "Laporan Akhir" && item.jenis === "penerimaan") {
            customTitle = "Jadwal Laporan Akhir";
          } else if (item.type === "Laporan Akhir" && item.jenis === "penilaian") {
            customTitle = "Penilaian Laporan Akhir";
          }
          
          // Menambahkan data penjadwalan beserta custom title
          listJadwal.push({
            title: customTitle !== "" ? customTitle : item.type,
            description: item.jenis,
            waktu_mulai: {
              label: "Waktu Mulai",
              text: item.waktu_buka,
            },
            waktu_akhir: {
              label: "Waktu Akhir",
              text: item.waktu_tutup,
            },
            template: true,
          });
        });
        
        this.listJadwal = listJadwal;
      })
      .catch((error) => {
        console.log(error);
      });
  },
}
};
</script>
