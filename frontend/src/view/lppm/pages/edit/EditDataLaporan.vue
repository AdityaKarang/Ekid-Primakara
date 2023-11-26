<template>
  <div>
    <CustomCard
      title="Daftar Dosen"
      deskripsi="List Daftar Dosen Yang Terdaftar pada sistem"
      :headers="headers"
      :contentTable="contentTables"
      :additionalData="additionalData"
      :isTopAction="false"
      :isEdit="false"
      :isDelete="false"
      @detailItem="detailData"
    />
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";

export default {
  name: "EditDataLaporan",
  components: {
    CustomCard,
  },
  data() {
    return {
      showPublikasi: false,
      datalistPublikasi: [],
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
      additionalData: {
        timReviewer: ["I Putu Satwika", "Eka Grana aristya dewi"],
      },

      headers: [
        { text: "No", value: "no" },
        { text: "NIDN", value: "nidn" },
        { text: "Nama", value: "nama" },
        { text: "Action", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021-Genap",
          nidn: "0801088901",
          waiting: "3",
          invalid: "4",
          valid: "10",
          nama: "I Putu Satwika, M.Kom",
          penunjangs: [
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
            {
              tahun_akademik: "2020/2021-Ganjil",
              namakegiatan: "Lomba Startup",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "25",
              keterangan:
                "Bukti Kegiatan tidak sama dengan nama kegiatan yang diinputkan",
              berkas: "example.pdf",
            },
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Pelatihan Pembuatan Jurnal International",
              jenis:
                "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "30",
              keterangan: "-",
              berkas: "example.pdf",
            },
          ],
        },

        {
          no: "2",
          tahun_akademik: "2020/2021-Genap",
          nidn: "0811078902",
          waiting: "2",
          invalid: "2",
          valid: "8",
          nama: "I Nyoman Yudi Anggara Wijaya, S.Kom., M.T",
          penunjangs: [
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
          ],
        },

        {
          no: "3",
          tahun_akademik: "2019/2020-Ganjil",
          nidn: "0802078402",
          waiting: "5",
          invalid: "1",
          valid: "8",
          nama: "I Gede Juliana Eka Putra, S.T., M.T",
          penunjangs: [
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
          ],
        },

        {
          no: "4",
          tahun_akademik: "2019/2020-Ganjil",
          nidn: "0817028803",
          waiting: "2",
          invalid: "3",
          valid: "10",
          nama: "Eka Grana Aristyana Dewi, M.Pd",
          penunjangs: [
            {
              tahun_akademik: "2020/2021-Genap",
              namakegiatan: "Seminar Literasi Digital",
              jenis:
                "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
              ket: "Waiting",
              nilai: "20",
              keterangan: "",
              berkas: "example.pdf",
            },
          ],
        },
      ],
    };
  },
  methods: {
    detailData(item) {
      this.$router.push({
        name: "edit-data-laporan-detail",
        params: { data: item },
      });
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Edit Data Laporan Dosen" },
    ]);
  },
};
</script>