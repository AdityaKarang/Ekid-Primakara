<template>
  <div>
    <v-card class="mb-2">
      <div class="m-5 mt-2 p-5">
        <h5>Nama: {{ nama }}</h5>
        <h6>NIDN: {{ nidn }}</h6>
      </div>
    </v-card>
    <CustomCard
      title="Daftar Kegiatan Penunjang"
      deskripsi="List Daftar Kegiatan Penunjang Yang Telah Di Inputkan"
      :headers="headers"
      :contentTable="contentTables"
      :isTopAction="false"
      :isDelete="false"
      :isEdit="false"
      :isDetail="false"
    >
      <template v-slot:filter>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterTahunAkademikSemester"
            v-model="filterTahunAkademik"
            label="Tahun Ajaran dan semester"
          ></v-select>
        </div>
      </template>
    </CustomCard>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
export default {
  name: "Detailwaiting",
  components: {
    CustomCard,
  },
  data() {
    return {
      nama: "",
      nidn: "",
      tahunAkademik: "",
      filterTahunAkademik: "",
      filterProdi: "",
      dataFilterProdi: [
        { text: "tidak di filter", value: null },
        "Teknik Informatika",
        "Sistem Informasi",
        "Sistem Informasi Akuntansi",
      ],
      dataFilterTahunAkademikSemester: [
        { text: "tidak di filter", value: null },

        "2021/2022-Genap",
        "2021/2022-Ganjil",
        "2020/2021-Genap",
        "2020/2021-Ganjil",
        "2019/2020-Genap",
        "2019/2020-Ganjil",
      ],
      headers: [
        { text: "No", value: "no" },
        {
          text: "Tahun Akademik",
          value: "tahun_akademik",
          sortable: false,
          filter: (f) => {
            if (!this.filterTahunAkademik) return true;
            return (f + "")
              .toLowerCase()
              .includes(this["filterTahunAkademik"].toLowerCase());
          },
        },
        { text: "Nama Kegiatan", value: "namakegiatan" },
        { text: "Nilai", value: "nilai" },
        { text: "Status", value: "ket" },
        { text: "Keterangan", value: "keterangan" },
        { text: "Berkas", value: "berkas" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021-Genap",
          namakegiatan: "Seminar Literasi Digital",
          jenis:
            "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          nilai: 20,
          ket: "Waiting",
          keterangan: "",
          berkas: "example.pdf",
        },
        {
          no: "2",
          tahun_akademik: "2020/2021-Ganjil",
          namakegiatan: "Lomba Startup",
          jenis:
            "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          nilai: 20,

          ket: "Waiting",
          keterangan: "",
          berkas: "example.pdf",
        },

        {
          no: "3",
          tahun_akademik: "2020/2021-Genap",
          namakegiatan: "Pelatihan Pembuatan Jurnal International",
          jenis: "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          nilai: 20,

          ket: "Waiting",
          keterangan: "-",
          berkas: "example.pdf",
        },
      ],
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },

    checkStatusKet(ket) {
      if (!ket) return false;
      let ketr = ket.toLowerCase();
      if (ketr == "valid") {
        return true;
      }
      return false;
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Detail Laporan Penunjang" },
    ]);
    if (!this.$route.params.data) {
      this.contentTables = [];
      return;
    }

    let penunjangs = this.$route.params.data.penunjangs;
    this.nama = this.$route.params.data.nama;
    this.nidn = this.$route.params.data.nidn;
    this.tahunAkademik = this.$route.params.data.tahun_akademik;

    console.log("start detail penunjang laporan");
  },
};
</script>