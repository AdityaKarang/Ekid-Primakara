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

    <v-card flat>
      <CustomCard title="Daftar Penelitian" deskripsi="List Daftar Penelitian Yang Telah Di Inputkan" :isTopAction="false"
        :isEdit="false" :isDelete="false" :headers="headers" :contentTable="contentTablesPenelitian"
        @detailItem="btnDetailPenelitian">
        <template v-slot:filter>
          <div class="w-30 mr-2">
            <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
              label="Tahun Akademik dan semester"></v-select>
          </div>
        </template>
        <template v-slot:toolbar>
          <div class="card-toolbar">
            <ul class="nav nav-pills nav-pills-sm nav-dark-75">
              <li class="nav-item">
                <button class="btn btn-primary" @click="btnPrintPenelitian()">
                  <i class="menu-icon flaticon2-print"></i> Print
                </button>
              </li>
            </ul>
          </div>
        </template>

        <template v-slot:customAksi="{ item }">
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <v-icon color="green" class="mr-2" v-bind="attrs" v-on="on" @click="btnListItem(item)">
                mdi-format-list-bulleted
              </v-icon>
            </template>
            <span>List Publikasi</span>
          </v-tooltip>
        </template>
      </CustomCard>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";
import axios from "axios";

export default {
  name: "Kaprodi-Penelitian",
  components: {
    CustomCard,
    ListPublikasi,
  },
  data() {
    return {
      filterTahunAkademik: "",
      dataFilterTahunAkademikSemester: [
        { text: "tidak di filter", value: null },

        "2021/2022-genap",
        "2021/2022-ganjil",
        "2020/2021-genap",
        "2020/2021-ganjil",
        "2019/2020-genap",
        "2019/2020-ganjil",
      ],

      showPublikasi: false,
      datalistPublikasi: [],
      tab: "Proposal",
      itemTabs: ["Penelitian", "Pengabdian"],
      headers: [
        { text: "No", value: "no" },
        { text: "NIDN", value: "nidn" },
        { text: "Nama", value: "nama" },
        { text: "Judul", value: "judul" },
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

        { text: "Proposal", value: "proposal" },
        { text: "Laporan Kemajuan", value: "kemajuan" },
        { text: "Laporan Akhir", value: "akhir" },
        { text: "Publikasi", value: "customAksi" },
        { text: "Aksi", value: "detail" },
      ],
      contentTablesPenelitian: [
        // {
        //   no: "1",
        //   nidn: "000012341",
        //   nama: "I Putu Satwika",
        //   judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
        //   tahun_akademik: "2019/2020-Ganjil",
        //   proses: "InProgress",
        //   mitra: "ITB",
        //   bidangFokus: "Sistem Informasi",
        //   dana: [
        //     {
        //       sumberDana: "Luar Perguruan Tinggi",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "5.000.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "Nengah Widya Utami, S.Pd., M.Kom.",
        //       nidn: "0801088891",
        //       jabatanFungsional: "dosen",
        //       programStudi: "Teknik Informatika",

        //       noHPEmail: "satwika@primakara.ac.id",
        //     },
        //     {
        //       nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        //       nidn: "0817028803",
        //       jabatanFungsional: "Tenaga Pengajar",
        //       programStudi: "Sistem Informasi Akuntansi",
        //       noHPEmail: "aris@primakara.ac.id",
        //     },
        //   ],
        //   anggotaMahasiswa: [
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Yurina Anggela Oktaviana",
        //       nim: "1701010038",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Ni Luh Gede Devi Darnita",
        //       nim: "17010100002",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_1.jpg",

        //       nama: "Nur Rohman Ashiddiqi",
        //       nim: "17010100003",
        //       prodi: "Sistem Informasi ",
        //     },
        //   ],

        //   proposal: {
        //     fileName: new File(["example.pdf"], "example.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },
        //   kemajuan: {
        //     fileName: new File(["example.pdf"], "example.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },
        //   akhir: {
        //     fileName: new File(["example.pdf"], "./berkas/example.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },
        //   publikasi: [
        //     {
        //       jenis: "buku",
        //       tahunTerbit: "2011",
        //       judulBuku: "Gerak dan Gerik",
        //       jumlahHalaman: "205",
        //       isbn: "12345",
        //       penerbit: "Tidak di ketahui",
        //     },
        //     {
        //       jenis: "buku",
        //       tahunTerbit: "2011",
        //       judulBuku: "Gerak dan Gerik",
        //       jumlahHalaman: "205",
        //       isbn: "12345",
        //       penerbit: "Tidak di ketahui",
        //     },
        //     {
        //       jenis: "jurnal",
        //       tahunPublikasi: "2011",
        //       jenisPublikasi: "Nasional",
        //       judulPublikasi: "grak gerk",
        //       namaJurnal: "grak",
        //       issnJurnal: "1234",
        //       volume: "20",
        //       nomor: "30",
        //       halamanJurnal: "20",
        //       url: "https://hahhahaha",
        //     },
        //   ],
        // },

        // {
        //   no: "2",
        //   nidn: "000012341",
        //   nama: "I Putu Satwika",

        //   judul: "Pelatihan Digitalisasi Koperasi Di Kota Denpasar",
        //   proses: "InProgress",
        //   tahun_akademik: "2020/2021-Genap",
        //   proses: "InProgress",
        //   mitra: "ITB",
        //   bidangFokus: "Sistem Informasi",
        //   dana: [
        //     {
        //       sumberDana: "Luar Perguruan Tinggi",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "5.000.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "Nengah Widya Utami, S.Pd., M.Kom.",
        //       nidn: "0801088891",
        //       jabatanFungsional: "dosen",
        //       programStudi: "Teknik Informatika",

        //       noHPEmail: "satwika@primakara.ac.id",
        //     },
        //     {
        //       nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        //       nidn: "0817028803",
        //       jabatanFungsional: "Tenaga Pengajar",
        //       programStudi: "Sistem Informasi Akuntansi",
        //       noHPEmail: "aris@primakara.ac.id",
        //     },
        //   ],
        //   anggotaMahasiswa: [
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Yurina Anggela Oktaviana",
        //       nim: "1701010038",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Ni Luh Gede Devi Darnita",
        //       nim: "17010100002",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_1.jpg",

        //       nama: "Nur Rohman Ashiddiqi",
        //       nim: "17010100003",
        //       prodi: "Sistem Informasi ",
        //     },
        //   ],

        //   proposal: {
        //     fileName: new File(["example.pdf"], "example.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },

        //   kemajuan: {
        //     fileName: null,
        //     keterangan: "",
        //     status: "rejected",
        //   },
        //   akhir: {
        //     fileName: null,
        //     keterangan: "",
        //     status: "rejected",
        //   },
        //   publikasi: [
        //     {
        //       jenis: "buku",
        //       tahunTerbit: "2011",
        //       judulBuku: "Gerak dan Gerik",
        //       jumlahHalaman: "205",
        //       isbn: "12345",
        //       penerbit: "Tidak di ketahui",
        //     },
        //     {
        //       jenis: "buku",
        //       tahunTerbit: "2011",
        //       judulBuku: "Gerak dan Gerik",
        //       jumlahHalaman: "205",
        //       isbn: "12345",
        //       penerbit: "Tidak di ketahui",
        //     },
        //     {
        //       jenis: "jurnal",
        //       tahunPublikasi: "2011",
        //       jenisPublikasi: "Nasional",
        //       judulPublikasi: "grak gerk",
        //       namaJurnal: "grak",
        //       issnJurnal: "1234",
        //       volume: "20",
        //       nomor: "30",
        //       halamanJurnal: "20",
        //       url: "https://hahhahaha",
        //     },
        //   ],
        // },

        // {
        //   no: "3",
        //   nidn: "000012341",
        //   nama: "I Putu Satwika",
        //   judul: "Pelatihan Penggunaan Sistem Keuangan Dan Anggaran",
        //   proses: "Selesai",
        //   tahun_akademik: "2020/2021-Genap",
        //   proses: "InProgress",
        //   mitra: "ITB",
        //   bidangFokus: "Sistem Informasi",
        //   dana: [
        //     {
        //       sumberDana: "Luar Perguruan Tinggi",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "5.000.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "Nengah Widya Utami, S.Pd., M.Kom.",
        //       nidn: "0801088891",
        //       jabatanFungsional: "dosen",
        //       programStudi: "Teknik Informatika",

        //       noHPEmail: "satwika@primakara.ac.id",
        //     },
        //     {
        //       nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        //       nidn: "0817028803",
        //       jabatanFungsional: "Tenaga Pengajar",
        //       programStudi: "Sistem Informasi Akuntansi",
        //       noHPEmail: "aris@primakara.ac.id",
        //     },
        //   ],
        //   anggotaMahasiswa: [
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Yurina Anggela Oktaviana",
        //       nim: "1701010038",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_2.jpg",

        //       nama: "Ni Luh Gede Devi Darnita",
        //       nim: "17010100002",
        //       prodi: "Sistem Informasi",
        //     },
        //     {
        //       avatar: "http://localhost:8080/media/users/100_1.jpg",

        //       nama: "Nur Rohman Ashiddiqi",
        //       nim: "17010100003",
        //       prodi: "Sistem Informasi ",
        //     },
        //   ],

        //   proposal: {
        //     fileName: new File(["example.pdf"], "example.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },

        //   kemajuan: {
        //     fileName: new File(["example.pdf"], "Laporan Kemajuan.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },
        //   akhir: {
        //     fileName: new File(["example.pdf"], "Laporan Akhir.pdf", {
        //       type: "text/pdf",
        //     }),
        //     keterangan: "ini hanya contoh file",
        //     status: "success",
        //   },
        //   publikasi: [
        //     {
        //       jenis: "buku",
        //       tahunTerbit: "2011",
        //       judulBuku: "Gerak dan Gerik",
        //       jumlahHalaman: "205",
        //       isbn: "12345",
        //       penerbit: "Tidak di ketahui",
        //     },
        //     {
        //       jenis: "jurnal",
        //       tahunPublikasi: "2011",
        //       jenisPublikasi: "Nasional",
        //       judulPublikasi: "grak gerk",
        //       namaJurnal: "grak",
        //       issnJurnal: "1234",
        //       volume: "20",
        //       nomor: "30",
        //       halamanJurnal: "20",
        //       url: "https://hahhahaha",
        //     },
        //     {
        //       jenis: "forumilmiah",
        //       tahunPelaksanaan: "2011",
        //       tingkatForumIlmiah: "Nasional",
        //       namaForum: "forum 101",
        //       judulMakalah: "makalah grak",
        //       institusiPenyelenggara: "stmik",
        //       waktuPelaksanaan: "2020",
        //       tempatPelaksanaan: "Internasional",
        //     },
        //     {
        //       jenis: "hki",
        //       tahunPelaksanaan: "2011",
        //       judulHki: "unik",
        //       jenisHki: "pengetahuan",
        //       nomorHki: "1234",
        //       status: "aprove",
        //       nomorPendaftaran: "1",
        //     },
        //     {
        //       jenis: "mediamassa",
        //       tanggalPublikasi: "2011",
        //       judulPublikasi: "penelitian blah blah blah",
        //       namaMedia: "suarablahblah ",
        //       url: "https://suarablahblah",
        //     },
        //   ],
        // },
      ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Penelitian" }]);
    this.fetchPenelitian();
  },
  methods: {
    fetchPenelitian() {
      this.loading = true;
      axios.get('http://localhost:8000/api/get-kemajuan-akhir').then(res => {
        console.log("API Response:", res.data); // Log the API response

        // const currentUserID = this.currentUser.id; // Get the ID of the current user

        const tahunAkademik = res.data.length > 0 ? res.data[0].tahun_akademik : "Unknown";

        this.contentTablesPenelitian = res.data.map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          let status = bf.status === "Aproved" ? "success" : bf.status;
          return {
            no: index + 1,
            nidn: bf.user.nidn,
            nama: bf.name_user,
            judul: bf.judul,
            tahun_akademik: bf.tahun_akademik,
            proposal: {
              status: status
            },
            kemajuan: {
              status: bf.laporankemajuan ? bf.laporankemajuan.status : "empty",
            },
            akhir: {
              status: bf.laporanakhir ? bf.laporanakhir.status : "empty",
            },
            publikasi: [
              {
                jenis: "jurnal",
                tahunPublikasi: bf.publishcation.tahun_publikasi,
                jenisPublikasi: bf.publishcation.jenis_publikasi_jurnal,
                judulPublikasi: bf.publishcation.judul_publikasi,
                namaJurnal: bf.publishcation.nama_jurnal,
                issnJurnal: bf.publishcation.issn_jurnal,
                volume: bf.publishcation.volume,
                nomor: bf.publishcation.nomor,
                halamanJurnal: bf.publishcation.halaman,
                url: bf.publishcation.url,
              }
            ],
            detail: bf.id,
          };
        });

        console.log("Content Tables:", this.contentTablesPenelitian); // Log the updated contentTables array
        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });

    },
    btnListItem(item) {
      this.showPublikasi = true;
      this.datalistPublikasi = item.publikasi ? item.publikasi : [];
    },
    convertStatusForPrint(status) {
      if (status == "rejected") {
        return "&#10008;";
      } else if (status == "waiting") {
        return "&#9716;";
      } else {
        return "&#10004;";
      }
    },
    convertPublikasiForPrint(publikasi) {
      let result = "";
      publikasi.forEach((p, i) => {
        if (p.jenis == "buku") {
          result += `${i + 1}.Jenis :  ${p.jenis} </br>`;
          result += `Tahun Terbit :  ${p.tahunTerbit} </br>`;
          result += `Judul Buku :  ${p.judulBuku} </br>`;
          result += `Jumalah Halaman:  ${p.jumlahHalaman} </br>`;
          result += `isbn:  ${p.isbn} </br>`;
          result += `penerbit :  ${p.penerbit} </br> </br>`;
        } else if (p.jenis == "jurnal") {
          result += `${i + 1}.Jenis : ${p.jenis} </br>`;
          result += `Tahun Publikasi: ${p.tahunPublikasi} </br>`;
          result += `Jenis Publikasi: ${p.jenisPublikasi} </br>`;
          result += `Judul Publikasi: ${p.judulPublikasi} </br>`;
          result += `Nama Jurnal: ${p.namaJurnal} </br>`;
          result += `ISSN Jurnal: ${p.issnJurnal} </br>`;
          result += `Volume: ${p.volume} </br>`;
          result += `Nomor: ${p.nomor} </br>`;
          result += `Halaman Jurnal: ${p.halamanJurnal} </br> `;
          result += `URL: ${p.url} </br> </br>`;
        } else if (p.jenis == "forumilmiah") {
          result += `${i + 1}.jenis: ${p.jenis} </br>`;
          result += `TahunPelaksanaan: ${p.tahunPelaksanaan} </br>`;
          result += `TingkatForumIlmiah: ${p.tingkatForumIlmiah} </br>`;
          result += `NamaForum:${p.namaForum} </br>`;
          result += `JudulMakalah: ${p.judulMakalah} </br>`;
          result += `InstitusiPenyelenggara: ${p.institusiPenyelenggara} </br>`;
          result += `WaktuPelaksanaan: ${p.waktuPelaksanaan}  </br>`;
          result += `TempatPelaksanaan: ${p.tempatPelaksanaan} </br> </br>`;
        } else if (p.jenis == "hki") {
          result += ` ${i + 1}.Jenis: ${p.jenis} </br>`;
          result += `tahun Pelaksanaan: ${p.tahunPelaksanaan} </br>`;
          result += `Judul Hki: ${p.judulHki} </br>`;
          result += `Jenis Hki: ${p.jenisHki} </br>`;
          result += `Nomor Hki: ${p.nomorHki}  </br>`;
          result += `Status : ${p.status} <br>`;
          result += `Nomor Pendaftaran: ${p.nomorPendaftaran} </br> </br>`;
        } else if (p.jenis == "mediamassa") {
          result += ` ${i + 1}.Jenis: ${p.jenis} </br>`;
          result += `Tanggal Publikasi: ${p.tanggalPublikasi} </br>`;
          result += `Judul Publikasi:  ${p.judulPublikasi} </br>`;
          result += `Nama Media: ${p.namaMedia}  </br>`;
          result += `URL: ${p.url} </br> </br>`;
        }
      });
      return result;
    },
    btnPrintPenelitian() {
      // Open the print window
      const WinPrint = window.open(
        "",
        "",
        "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0"
      );
      let tahunAkademik = "2021-2022";
      let tbody = "";
      this.contentTablesPenelitian.forEach((penelitian) => {
        tbody += "<tr>";
        tbody += `<td style="vertical-align:top"> ${penelitian.no} </td>`;
        tbody += `<td style="vertical-align:top"> ${penelitian.nidn} </td>`;
        tbody += `<td style="vertical-align:top">  ${penelitian.nama} </td>`;
        tbody += `<td style="vertical-align:top"> ${penelitian.judul} </td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.proposal.status
        )}</td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.kemajuan.status
        )}</td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.akhir.status
        )}</td>`;
        tbody += `<td width="500px" style="vertical-align:top"> ${this.convertPublikasiForPrint(
          penelitian.publikasi
        )}</td>`;
        tbody += "</tr>";
      });

      WinPrint.document.write(`<!DOCTYPE html>
<html>
  <head>
    <title>Print Penelitian ${tahunAkademik}</title>
    <style>
      table,
      td,
      th {
        border: 1px solid black;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      table t
    </style>
  </head>
  <body>
    <div style="margin:0px auto; width:90vW ; text-align:center">
      <h4>Laporan Pelaksanaan Penelitian Tahun Akademik ${tahunAkademik}</h4>
    </div>
    <div style="margin:20px auto;width:95%">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Judul</th>
            <th>Proposal</th>
            <th>Laporan Kemajuan</th>
            <th>Laporan Akhir</th>
            <th>publikasi</th>
          <tr>
        </thead>
        <tbody>
          ${tbody}
        <tbody>
      </table>
    </div>
    </table>
  </body>
</html>`);

      WinPrint.document.close();
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    },
    btnPrintPengabdian() {
      // Open the print window
      const WinPrint = window.open(
        "",
        "",
        "left=0,top=0,width=800,height=900,toolbar=0,scrollbars=0,status=0"
      );
      let tahunAkademik = "2021-2022";
      let tbody = "";
      this.contentTablesPengabdian.forEach((penelitian) => {
        tbody += "<tr>";
        tbody += `<td style="vertical-align:top"> ${penelitian.no} </td>`;
        tbody += `<td style="vertical-align:top"> ${penelitian.nidn} </td>`;
        tbody += `<td style="vertical-align:top">  ${penelitian.nama} </td>`;
        tbody += `<td style="vertical-align:top"> ${penelitian.judul} </td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.proposal.status
        )}</td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.kemajuan.status
        )}</td>`;
        tbody += `<td style="text-align:center; vertical-align:top"> ${this.convertStatusForPrint(
          penelitian.akhir.status
        )}</td>`;
        tbody += `<td width="500px" style="vertical-align:top"> ${this.convertPublikasiForPrint(
          penelitian.publikasi
        )}</td>`;
        tbody += "</tr>";
      });

      WinPrint.document.write(`<!DOCTYPE html>
<html>
  <head>
    <title>Print Penelitian ${tahunAkademik}</title>
    <style>
      table,
      td,
      th {
        border: 1px solid black;
      }

      table {
        width: 100%;
        border-collapse: collapse;
      }

      table t
    </style>
  </head>
  <body>
    <div style="margin:0px auto; width:90vW ; text-align:center">
      <h4>Laporan Pelaksanaan Pengabdian Masyarakat Tahun Akademik ${tahunAkademik}</h4>
    </div>
    <div style="margin:20px auto;width:95%">
      <table>
        <thead>
          <tr>
            <th>No</th>
            <th>NIDN</th>
            <th>Nama</th>
            <th>Judul</th>
            <th>Proposal</th>
            <th>Laporan Kemajuan</th>
            <th>Laporan Akhir</th>
            <th>publikasi</th>
          <tr>
        </thead>
        <tbody>
          ${tbody}
        <tbody>
      </table>
    </div>
    </table>
  </body>
</html>`);

      WinPrint.document.close();
      WinPrint.focus();
      WinPrint.print();
      WinPrint.close();
    },
    btnDetailPenelitian(item) {
      this.$router.push({
        name: "kaprodi-penelitian-detail",
        params: { data: item },
      });
    },
  },

};
</script>