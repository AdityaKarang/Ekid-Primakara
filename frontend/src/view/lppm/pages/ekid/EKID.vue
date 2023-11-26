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

    <v-card>
      <v-tabs v-model="tab" background-color="accent-4" grow>
        <v-tab v-for="itemTab in itemTabs" :key="itemTab">
          {{ itemTab }}
        </v-tab>
      </v-tabs>

      <v-tabs-items v-model="tab">
        <v-tab-item>
          <v-card flat>
            <CustomCard title="Daftar Penelitian" deskripsi="List Daftar Penelitian Yang Telah Di Inputkan"
              :isTopAction="false" :isDetail="false" :isEdit="false" :isDelete="false" :headers="headers"
              :contentTable="contentTablesPenelitian">
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
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomCard title="Daftar Pengabdian " deskripsi="List Daftar Pengabdian Yang Telah Di Inputkan"
              :isTopAction="false" :isDetail="false" :isEdit="false" :isDelete="false" :headers="headers"
              :contentTable="contentTablesPengabdian">
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
                      <button class="btn btn-primary" @click="btnPrintPengabdian()">
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
        </v-tab-item>
      </v-tabs-items>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";
import axios from "axios";


export default {
  name: "Rekapitulasi",
  components: {
    CustomCard,
    ListPublikasi,
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
      ],
      contentTablesPenelitian: [

      ],
      contentTablesPengabdian: [

      ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "EKID" }]);
    this.fetchPenelitian();
    this.fetchPengabdian();
  },
  methods: {
    checkAndDisplayData() {
      const filteredData = this.contentTablesPenelitian.filter(data =>
        data.proposal.status === 'aprove' ||
        data.kemajuan.status === 'aprove' ||
        data.akhir.status === 'aprove' ||
        data.publikasi.every(publikasi => publikasi.status === 'aprove')
      );

      if (filteredData.length > 0) {
        console.log("Filtered Data:", filteredData);
        // You can set this.filteredData to filteredData if you want to use it in your component
      } else {
        console.log("No data to display");
        // Optionally, you can display a message or perform other actions when there is no data to display
      }
    },

    fetchPenelitian() {
      this.loading = true;
      axios.get('http://localhost:8000/api/get-kemajuan-akhir').then(res => {
        console.log("API Response:", res.data); // Log the API response

        // const currentUserID = this.currentUser.id; // Get the ID of the current user

        const tahunAkademik = res.data.length > 0 ? res.data[0].tahun_akademik : "Unknown";

        this.contentTablesPenelitian = res.data.map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped

          let status;
          if (bf.status === "Aproved") {
            status = "success";
          } else if (bf.status === "Revisi" || bf.status === "Submited") {
            status = "waiting";
          } else {
            status = bf.status;
          }

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
              status: bf.laporankemajuan ? bf.laporankemajuan.status : "waiting",
            },
            akhir: {
              status: bf.laporanakhir ? bf.laporanakhir.status : "waiting",
            },
            publikasi: [
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
                status: bf.publishcation ? bf.publishcation.status : "",
              }
            ],
          };
        });

        console.log("Content Tables:", this.contentTablesPenelitian); // Log the updated contentTables array
        this.checkAndDisplayData(); // Call the function to check and display data
        this.loading = false; // Set loading to false when data is fetched
      })
        .catch(error => {
          console.error("Error fetching data:", error);
          this.loading = false; // Set loading to false in case of an error
        });

    },
    fetchPengabdian() {
      this.loading = true;
      axios.get('http://localhost:8000/api/get-akhir-kemajuan').then(res => {
        console.log("API Response:", res.data); // Log the API response

        // const currentUserID = this.currentUser.id; // Get the ID of the current user
        const tahunAkademik = res.data.length > 0 ? res.data[0].tahun_akademik : "Unknown";

        this.contentTablesPengabdian = res.data.map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          let status;
          if (bf.status === "Aproved") {
            status = "success";
          } else if (bf.status === "Revisi" || bf.status === "Submited") {
            status = "waiting";
          } else {
            status = bf.status;
          }
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
              status: bf.laporankemajuan ? bf.laporankemajuan.status : "waiting",
            },
            akhir: {
              status: bf.laporanakhir ? bf.laporanakhir.status : "waiting",
            },
            publikasi: [
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
              }
            ],
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
      const tahunAkademik = this.contentTablesPenelitian.length > 0 ?
        this.contentTablesPenelitian[0].tahun_akademik :
        "Unknown";
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
      const tahunAkademik = this.contentTablesPenelitian.length > 0 ?
        this.contentTablesPenelitian[0].tahun_akademik :
        "Unknown";
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
  },
};
</script>