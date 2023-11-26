<template>
  <div>
    <v-dialog v-model="showPublikasi" max-width="400px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon> mdi-format-list-bulleted</v-icon>
          <v-toolbar-title class="font-weight-light">
            List Publikasi
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showPublikasi = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <ListPublikasi :dataList="datalistPublikasi"></ListPublikasi>
        </v-card-text>
      </v-card>
    </v-dialog>

    <CustomCard
      title="Daftar Publikasi Penelitian"
      deskripsi="List Daftar Publikasi Penelitian Yang Telah Di Inputkan"
      :headers="headers"
      :contentTable="contentTables"
      :additionalData="additionalData"
      :isTopAction="false"
      :isEdit="false"
      :isDelete="false"
      :isDetail="false"
    >
      <template v-slot:filter>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterTahunAkademikSemester"
            v-model="filterTahunAkademik"
            label="Tahun Akademik dan semester"
          ></v-select>
        </div>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterProdi"
            label="Prodi"
            v-model="filterProdi"
          ></v-select>
        </div>
      </template>
      <template v-slot:Detail="{ item }">
        <v-tooltip left>
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="green"
              class="mr-2"
              v-bind="attrs"
              v-on="on"
              @click="btnListItem(item)"
            >
              mdi-format-list-bulleted
            </v-icon>
          </template>
          <span>List Publikasi</span>
        </v-tooltip>
      </template>
    </CustomCard>
  </div>
</template>
<script>
import CustomCard from "@/view/content/CustomCard";
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";

export default {
  name: "PublikasiPenelitian",
  components: {
    CustomCard,
    ListPublikasi,
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

        "2021/2022-genap",
        "2021/2022-ganjil",
        "2020/2021-genap",
        "2020/2021-ganjil",
        "2019/2020-genap",
        "2019/2020-ganjil",
      ],
      additionalData: {
        timReviewer: ["I Putu Satwika", "Eka Grana aristya dewi"],
      },

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
        {
          text: "Prodi",
          value: "prodi",
          sortable: false,
          filter: (f) => {
            if (!this.filterProdi) return true;
            return (f + "")
              .toLowerCase()
              .includes(this["filterProdi"].toLowerCase());
          },
        },
        { text: "Nama", value: "nama" },
        { text: "Judul", value: "judul" },
        { text: "Action", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021-Genap",
          prodi: "Teknik Informatika",

          nama: "i putu satwika",
          judul: "Perancangan Sistem Informasi Perpustakaan Digital ",
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },

        {
          no: "2",
          tahun_akademik: "2020/2021-Genap",
          prodi: "Sistem Informasi",

          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun ",
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },

        {
          no: "3",
          tahun_akademik: "2019/2020-Ganjil",
          prodi: "Sistem Informasi Akuntansi",
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },

        {
          no: "4",
          tahun_akademik: "2019/2020-Ganjil",
          judul: "Perancangan Sistem Informasi Kinerja Dosen ",
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },
      ],
    };
  },
  methods: {
    btnListItem(item) {
      this.showPublikasi = true;
      this.datalistPublikasi = item.publikasi ? item.publikasi : [];
    },
  },
};
</script>