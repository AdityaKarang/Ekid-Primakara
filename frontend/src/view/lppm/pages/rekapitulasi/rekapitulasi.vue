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
          <v-card flat>
            <CustomWidget2 title="Proposal" descritpion="List Data Penilaian Proposal Dosen Yang Telah Diinputkan"
              :dataTabs="tabTable" :contentTable="contentTablesProposal" :isEdit="false">
              <template v-slot:filter>
                <div class="w-30 mr-2">
                  <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
                    label="Tahun Akademik dan semester"></v-select>
                </div>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Laporan Kemajuan"
              descritpion="List Data Penilaian Laporan Kemajuan Dosen Yang Telah Diinputkan" :dataTabs="tabTable"
              :contentTable="contentTablesLaporanKemajuan" :isEdit="false">
              <template v-slot:filter>
                <div class="w-30 mr-2">
                  <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
                    label="Tahun Akademik dan semester"></v-select>
                </div>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Laporan Akhir"
              descritpion="List Data Penilaian Laporan Akhir Dosen Yang Telah Diinputkan" :dataTabs="tabTable"
              :contentTable="contentTablesLaporanAkhir" :isEdit="false">
              <template v-slot:filter>
                <div class="w-30 mr-2">
                  <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
                    label="Tahun Akademik dan semester"></v-select>
                </div>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Publikasi" descritpion="data publikasi dosen" :dataTabs="tabTable"
              :contentTable="contentTablesPublikasi" :isEdit="false">
              <template v-slot:filter>
                <div class="w-30 mr-2">
                  <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
                    label="Tahun Akademik dan semester"></v-select>
                </div>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomWidget2 from "@/view/content/CustomWidget2";
import axios from "axios";

export default {
  name: "Rekapitulasi",
  components: {
    CustomWidget2,
  },
  data() {
    return {
      filterTahunAkademik: "",
      dataFilterTahunAkademikSemester: [
        { text: "tidak di filter", value: null },

        "2022/2023",
        "2023/2024",
        "2024/2025",
        "2025/2026",
      ],

      tab: "Proposal",
      itemTabs: ["Proposal", "Laporan Kemajuan", "Laporan Akhir", "Publikasi"],
      tabTable: ["penelitian", "pengabdian"],
      contentTablesProposal: [
        {
          name: "penelitian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Action", value: "aksi" },
            ],
            content: [
            ],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-proposal-penelitian-detail",
                params: { item: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-proposal",
                params: { data: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),
          },
        },
        {
          name: "pengabdian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
            ],
          },
          aksi: {
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-proposal",
                params: { data: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),

            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-proposal-pengabdian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
      contentTablesLaporanKemajuan: [
        {
          name: "penelitian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [

            ],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-kemajuan-penelitian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: { data: item, tabName: "Laporan Kemajuan Penelitan" },
              });
            }.bind(this),
          },
        },
        {
          name: "pengabdian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
            ],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-kemajuan-pengabdian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: { data: item, tabName: "Laporan Kemajuan Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
      contentTablesLaporanAkhir: [
        {
          name: "penelitian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
            ],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-akhir-penelitian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: { data: item, tabName: "Laporan Akhir Penelitan" },
              });
            }.bind(this),
          },
        },
        {
          name: "pengabdian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [

            ],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-akhir-pengabdian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: {
                  data: item,
                  tabName: "Laporan Akhir Pengabdian",
                },
              });
            }.bind(this),
          },
        },
      ],
      contentTablesPublikasi: [
        {
          name: "penelitian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
              {
                no: "1",
                nama: "I Putu Satwika, S.Kom, M.Kom",
                judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
                tahun_ajaran: "2020/2021-genap",
                berkas: "example.pdf",
                mitra: "ITB",
                bidangFokus: "Sistem Informasi",
                dana: [
                  {
                    sumberDana: "Luar Perguruan Tinggi",
                    bentukDana: "In-Cash",
                    jumlahDana: "5.000.000",
                  },
                ],
                anggotaDosen: [
                  {
                    nama: "I Putu Satwika, S.Kom, M.Kom",
                    nidn: "0801088891",
                    jabatanFungsional: "dosen",
                    programStudi: "Teknik Informatika",

                    noHPEmail: "satwika@primakara.ac.id",
                  },
                  {
                    nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
                    nidn: "0817028803",
                    jabatanFungsional: "Tenaga Pengajar",
                    programStudi: "Sistem Informasi Akuntansi",
                    noHPEmail: "aris@primakara.ac.id",
                  },
                ],
                anggotaMahasiswa: [
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Yurina Anggela Oktaviana",
                    nim: "1701010038",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Ni Luh Gede Devi Darnita",
                    nim: "17010100002",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_1.jpg",

                    nama: "Nur Rohman Ashiddiqi",
                    nim: "17010100003",
                    prodi: "Sistem Informasi ",
                  },
                ],

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

                status: "Waiting",
              },
              {
                no: "2",
                nama: "A.A. Istri Ita Paramitha, S.Pd., M.Kom",
                judul:
                  "Usability Testing Pada Sistem Informasi Akademik Stmik Primakara",
                tahun_ajaran: "2020/2021-genap",
                status: "Approved",
                berkas: "example.pdf",
                mitra: "ITB",
                bidangFokus: "Sistem Informasi",
                dana: [
                  {
                    sumberDana: "Luar Perguruan Tinggi",
                    bentukDana: "In-Cash",
                    jumlahDana: "5.000.000",
                  },
                ],
                anggotaDosen: [
                  {
                    nama: "A.A. Istri Ita Paramitha, S.Pd., M.Kom",
                    nidn: "0801088891",
                    jabatanFungsional: "dosen",
                    programStudi: "Teknik Informatika",

                    noHPEmail: "satwika@primakara.ac.id",
                  },
                  {
                    nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
                    nidn: "0817028803",
                    jabatanFungsional: "Tenaga Pengajar",
                    programStudi: "Sistem Informasi Akuntansi",
                    noHPEmail: "aris@primakara.ac.id",
                  },
                ],
                anggotaMahasiswa: [
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Yurina Anggela Oktaviana",
                    nim: "1701010038",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Ni Luh Gede Devi Darnita",
                    nim: "17010100002",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_1.jpg",

                    nama: "Nur Rohman Ashiddiqi",
                    nim: "17010100003",
                    prodi: "Sistem Informasi ",
                  },
                ],

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
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-publikasi-penelitian-detail",
                params: { item: item, tabName: "Proposal Penelitian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: { data: item, tabName: "Laporan Akhir Penelitan" },
              });
            }.bind(this),
          },
        },
        {
          name: "pengabdian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                filter: (f) => {
                  if (!this.filterTahunAkademik) return true;
                  return (f + "")
                    .toLowerCase()
                    .includes(this["filterTahunAkademik"].toLowerCase());
                },
              },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
              {
                no: "1",
                nama: "Nengah Widya Utami, S.Pd., M.Kom.",
                judul:
                  "Peningkatan Kopetensi Guru Melalui Pelatihan Pemanfaatan Teknologi",
                tahun_ajaran: "2020/2021-genap",
                semester: "Genap",
                status: "Approved",
                berkas: "example.pdf",
                mitra: "ITB",
                bidangFokus: "Sistem Informasi",
                dana: [
                  {
                    sumberDana: "Luar Perguruan Tinggi",
                    bentukDana: "In-Cash",
                    jumlahDana: "5.000.000",
                  },
                ],
                anggotaDosen: [
                  {
                    nama: "Nengah Widya Utami, S.Pd., M.Kom.",
                    nidn: "0801088891",
                    jabatanFungsional: "dosen",
                    programStudi: "Teknik Informatika",

                    noHPEmail: "satwika@primakara.ac.id",
                  },
                  {
                    nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
                    nidn: "0817028803",
                    jabatanFungsional: "Tenaga Pengajar",
                    programStudi: "Sistem Informasi Akuntansi",
                    noHPEmail: "aris@primakara.ac.id",
                  },
                ],
                anggotaMahasiswa: [
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Yurina Anggela Oktaviana",
                    nim: "1701010038",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_2.jpg",

                    nama: "Ni Luh Gede Devi Darnita",
                    nim: "17010100002",
                    prodi: "Sistem Informasi",
                  },
                  {
                    avatar: "http://localhost:8080/media/users/100_1.jpg",

                    nama: "Nur Rohman Ashiddiqi",
                    nim: "17010100003",
                    prodi: "Sistem Informasi ",
                  },
                ],

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
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-publikasi-pengabdian-detail",
                params: { item: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-review",
                params: { data: item, tabName: "Laporan Akhir Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
    };
  },
  mounted() {
    this.fetchProposalPenelitian();
    this.fetchProposalPengabdian();
    this.fetchKemajuanPenelitian();
    this.fetchKemajuanPengabdian();
    this.fetchAkhirPengabdian();
    this.fetchAkhirPenelitian();
    this.fetchPublikasiPenelitian();
    this.fetchPublikasiPengabdian();
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Rekapitulasi" }]);
  },
  methods: {
    fetchProposalPenelitian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/penelitian').then(res => {
        // console.log("API Response:", res.data.data); // Log the API response

        this.contentTablesProposal[0].data.content = res.data.data
          .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            // console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        // console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchProposalPengabdian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/pengabdian').then(res => {
        // console.log("API Response:", res.data.data); // Log the API response

        this.contentTablesProposal[1].data.content = res.data.data
          .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            // console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchKemajuanPenelitian() {
      this.loading = true;
      axios.get('http://localhost:8000/api/get-nilai-kemajuan').then(res => {

        this.contentTablesLaporanKemajuan[0].data.content = res.data
          .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchKemajuanPengabdian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/get-value-kemajuan').then(res => {

        this.contentTablesLaporanKemajuan[1].data.content = res.data
        .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchAkhirPenelitian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/get-nilai-akhir').then(res => {

        this.contentTablesLaporanAkhir[0].data.content = res.data
        .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchAkhirPengabdian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/get-value-akhir').then(res => {

        this.contentTablesLaporanAkhir[1].data.content = res.data
        .filter(item => item.status === "Aproved" || item.status === "Rejected")
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
              aksi: bf.id,
            };
          });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchPublikasiPenelitian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/get-nilai-publikasi').then(res => {

        this.contentTablesPublikasi[0].data.content = res.data
        .filter(item => item.status === "Aproved" || item.status === "Rejected")
        .map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          return {
            no: index + 1,
            nama: bf.name_user,
            judul: bf.judul,
            tahun_ajaran: bf.tahun_akademik,
            aksi: bf.id,
            publikasi: {
              jurnal: [
                {
                jenis: bf.publishcation ? bf.publishcation.jenis : "",
                tahunPublikasi: bf.publishcation ? bf.publishcation.tahun_publikasi : "",
                jenisPublikasi: bf.publishcation ? bf.publishcation.jenis_publikasi_jurnal : "",
                judulPublikasi: bf.publishcation ? bf.publishcation.judul_publikasi : "",
                namaJurnal: bf.publishcation ? bf.publishcation.nama_jurnal : "",
                issnJurnal: bf.publishcation ? bf.publishcation.issn_jurnal : "",
                volume: bf.publishcation ? bf.publishcation.volume : "",
                nomor: bf.publishcation ? bf.publishcation.nomor : "",
                halamanJurnal: bf.publishcation ? bf.publishcation.halaman : "",
                url: bf.publishcation ? bf.publishcation.url : "",
                },
              ]
            },
          };
        });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
    fetchPublikasiPengabdian() {

      this.loading = true;
      axios.get('http://localhost:8000/api/get-value-publikasi').then(res => {

        this.contentTablesPublikasi[1].data.content = res.data
        .filter(item => item.status === "Aproved" || item.status === "Rejected")
        .map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          return {
            no: index + 1,
            nama: bf.name_user,
            judul: bf.judul,
            tahun_ajaran: bf.tahun_akademik,
            aksi: bf.id,
            publikasi: {
              jurnal: [
                {
                jenis: bf.publishcation ? bf.publishcation.jenis : "",
                tahunPublikasi: bf.publishcation ? bf.publishcation.tahun_publikasi : "",
                jenisPublikasi: bf.publishcation ? bf.publishcation.jenis_publikasi_jurnal : "",
                judulPublikasi: bf.publishcation ? bf.publishcation.judul_publikasi : "",
                namaJurnal: bf.publishcation ? bf.publishcation.nama_jurnal : "",
                issnJurnal: bf.publishcation ? bf.publishcation.issn_jurnal : "",
                volume: bf.publishcation ? bf.publishcation.volume : "",
                nomor: bf.publishcation ? bf.publishcation.nomor : "",
                halamanJurnal: bf.publishcation ? bf.publishcation.halaman : "",
                url: bf.publishcation ? bf.publishcation.url : "",
                },
              ]
            }
          };
        });

        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });
    },
  }
};
</script>