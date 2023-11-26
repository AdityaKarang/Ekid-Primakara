<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="confirmasi" max-width="350">
        <v-card>
          <v-card-title class="headline">Are you sure you want to submit a proposal?</v-card-title>

          <v-card-text>
            data that has been submitted cannot be edited again, so make sure you have filled in the data correctly.
          </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="confirmasi = false">
              cancel
            </v-btn>

            <v-btn color="green darken-1" text @click=" onSave()
            confirmasi = false;
            showAdd = false;
            ">
              submit
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-dialog v-model="showFormDosenLuar" max-width="400px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-file</v-icon>
          <v-toolbar-title class="font-weight-light">
            Tambah Dosen Luar Kampus
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showFormDosenLuar = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-row>
            <v-col md="12">
              <v-text-field v-model="formDosenLuar.nama" label="Nama" required></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field v-model="formDosenLuar.nidn" label="NIDN" required></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field v-model="formDosenLuar.noHPEmail" label="No HP atau Email" required></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field v-model="formDosenLuar.falkultas" label="Fakultas" required></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field v-model="formDosenLuar.universitas" label="Universitas" required></v-text-field>
            </v-col>
          </v-row>
          <b-button type="button" variant="primary" @click="addAnggotaDosenLuar()">Simpan</b-button>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="showAdd" max-width="800px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-file</v-icon>
          <v-toolbar-title class="font-weight-light">
            Add Proposal
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showAdd = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col md="6">
                <v-select v-model="form.tahun_akademik" :items="tahunAkademik" label="Tahun Akademik" required></v-select>
              </v-col>
              <v-col md="6">
                <v-select v-model="form.semester" :items="semester" label="semester" required></v-select>
              </v-col>
              <v-col sm="12" md="12">
                <v-text-field v-model="form.judul" label="Judul" required></v-text-field>
              </v-col>
              <v-col sm="12" md="12">
                <v-autocomplete v-model="searchDosen" :items="Dosen" dense filled item-text="name" item-value="name"
                  label="Anggota Penelitian Dosen" @change="onChangeDosenSelect($event)">
                  <template v-slot:selection>
                    <!-- <v-chip
                      v-bind="data.attrs"
                      :input-value="data.item.nama"
                      close
                      @click="data.select"
                      @click:close="remove(data.item, form.anggotaDosen)"
                    >
                      <v-avatar left>
                        <v-img :src="data.item.avatar"></v-img>
                      </v-avatar>
                      {{ data.item.nama }}
                    </v-chip> -->
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.nidn"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.jabaran_fungsional"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.prodi"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.email"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col sm="12" md="12">
                <v-expansion-panels>
                  <v-expansion-panel v-for="(item, i) in anggotaDosen" :key="i">
                    <v-expansion-panel-header>
                      <div class="d-flex justify-content-between">
                        {{ item.name }}
                        <v-spacer></v-spacer>
                        <v-btn width="20px" close @click="removeAnggotaDosen(item, anggotaDosen)">
                          remove
                        </v-btn>
                      </div>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <v-row>
                        <v-col cols="12" v-if="item.nidn">
                          <v-text-field :value="item.nidn" label="NIDN" readonly></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.jabatan_funsional">
                          <v-text-field :value="item.jabatan_funsional" label="Jabatan Fungsional"
                            readonly></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.program_studi">
                          <v-text-field :value="item.program_studi" label="Program Studi" readonly></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.email">
                          <v-text-field :value="item.email" label="NO HP/Email" readonly></v-text-field>
                        </v-col>
                      </v-row>
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-expansion-panels>
              </v-col>
              <v-col sm="12" md="12">
                <v-autocomplete v-model="form.mahasiswa_1" :items="DataMahasiswa" dense filled item-text="name"
                  item-value="id" label="Anggota Penelitian Mahasiswa 1">
                  <template v-slot:selection="data">
                    <v-chip v-bind="data.attrs" :input-value="data.item.name">
                      {{ data.item.name }}
                    </v-chip>
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.nim"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.prodi"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col sm="12" md="12">
                <v-autocomplete v-model="form.mahasiswa_2" :items="DataMahasiswa" dense filled item-text="name"
                  item-value="id" label="Anggota Penelitian Mahasiswa 2">
                  <template v-slot:selection="data">
                    <v-chip v-bind="data.attrs" :input-value="data.item.name">
                      {{ data.item.name }}
                    </v-chip>
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.name"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.nim"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.prodi"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col md="12" cols="12">
                <v-select :items="bidangfokuss" label="Bidang Fokus" v-model="form.bidang_fokus"></v-select>
              </v-col>

              <v-col cols="12">
                <v-text-field v-model="form.mitra" label="Mitra" required></v-text-field>
              </v-col>
              <v-row class="p-4 d-flex justify-content-between" v-for="kriteria in totalKriteria" :key="kriteria">
                <v-col cols="3">
                  <v-select v-model="form.sumber_dana" :items="sumberdanas" label="Sumber Dana" required>
                  </v-select>
                </v-col>
                <v-col cols="3">
                  <v-select v-model="form.bentuk_dana" :items="bentukdanas" label="Bentuk Dana" required></v-select>
                </v-col>
                <v-col cols="3">
                  <v-text-field v-model="form.jumlah_dana" label="Jumlah Dana" required></v-text-field>
                </v-col>
                <!-- <v-col cols="1" class="pt-4">
                  <b-button variant="success" class="mt-1" @click="totalKriteria++">
                    <i class="flaticon-plus"></i></b-button></v-col> -->
              </v-row>

              <b-col cols="12">
                <v-file-input v-model="form.proposal" label="Upload Proposal" @change="handleFileUpload"></v-file-input>
              </b-col>
            </v-row>
            <b-button class="mr-2" type="button" variant="success" @click="onDraft()
            confirmasi = false;
            showAdd = false;" :disabled="!isFormComplete">Draft</b-button>
            <b-button type="button" variant="primary" @click="confirmasi = true" :disabled="!isFormComplete">Submit</b-button>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <CustomCard title="List of Proposal Pengabdian" deskripsi="List of Proposal Pengabdian That Have Been Inputted"
      :headers="headers" :contentTable="contentTables" :isTopAction="false" :isEdit="false" :isDelete="false"
      @detailItem="detailData">
      <template v-slot:toolbar>
        <div class="card-toolbar">
          <ul class="nav nav-pills nav-pills-sm nav-dark-75">
            <li class="nav-item">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <div v-on="on">
                    <button v-bind="attrs" class="btn btn-primary" @click="addNew(true)"
                      :disabled="checkDueDate.isDisable">
                      <i class="menu-icon flaticon2-add-1"></i> Add
                    </button>
                  </div>
                </template>

                <span> {{ checkDueDate.text }} </span>
              </v-tooltip>
            </li>
          </ul>
        </div>
      </template>
    </CustomCard>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "Penelitian",
  components: {
    CustomCard,
  },
  data() {
    return {
      duedateUploadProposal: "",
      startDateUploadProposal: "",
      totalKriteria: 1,
      searchDosen: "",
      selectedDosen: [],
      showFormDosenLuar: false,
      formDosenLuar: {
        nama: "",
        nidn: "",
        noHPEmail: "",
        falkultas: "",
        universitas: "",
      },

      form: {
        pengabdians: [],
      },
      DataMahasiswa: [
        //   {
        //     avatar: "http://localhost:8080/media/users/100_2.jpg",

        //     nama: "Yurina Anggela Oktaviana",
        //     nim: "1701010038",
        //     prodi: "Sistem Informasi",
        //   },
        //   {
        //     avatar: "http://localhost:8080/media/users/100_2.jpg",

        //     nama: "Ni Luh Gede Devi Darnita",
        //     nim: "17010100002",
        //     prodi: "Sistem Informasi Akuntansis",
        //   },
        //   {
        //     avatar: "http://localhost:8080/media/users/100_1.jpg",

        //     nama: "Nur Rohman Ashiddiqi",
        //     nim: "17010100003",
        //     prodi: "Teknik Infomatika",
        //   },
      ],
      Dosen: [
        // { nama: "Tambah Dosen Luar" },
        // {
        //   avatar: "http://localhost:8080/media/users/100_1.jpg",

        //   nama: "I Putu Satwika, S.Kom, M.Kom",
        //   nidn: "0801088891",
        //   jabatanFunsional: "rektor",
        //   programStudi: "Teknik Informatika",
        //   noHPEmail: "satwika@primakara.ac.id",
        // },
        // {
        //   avatar: "http://localhost:8080/media/users/100_2.jpg",

        //   nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        //   nidn: "0817028803",
        //   jabatanFunsional: "Tenaga Pengajar",
        //   programStudi: "Sistem Informasi Akuntansi",
        //   noHPEmail: "aris@primakara.ac.id",
        // },
        // {
        //   avatar: "http://localhost:8080/media/users/100_1.jpg",

        //   nama: "Putu Trisna Hadi Permana, S.Pd, M.Pd",
        //   nidn: "0824049101",
        //   jabatanFunsional: "Tenaga Pengajar",
        //   programStudi: "Teknik Informatika",
        //   noHPEmail: "trisna@primakara.ac.id",
        // },
      ],
      anggotaDosen: [],
      anggotaMahasiswa: [],
      tahunAkademik: [
        { text: "Pilih Tahun Akademik", value: null },
        "2022/2023",
        "2023/2024",
        "2024/2025",
      ],
      semester: [
        { text: "Pilih Semester", value: null },
        "Ganjil",
        "Genap",
      ],
      // jenisPublkasis: [
      //   { text: "Select One", value: null },
      //   "Buku",
      //   "Jurnal",
      //   "HKI",
      //   "Majalah",
      //   "Media Massa",
      // ],
      // tingkatPublikasis: [
      //   { text: "Select One", value: null },
      //   "Lokal",
      //   "Nasional",
      //   "Internasional",
      // ],
      tahunAkademiks: [
        { text: "Select One", value: null },
        "2021/2022",
        "2020/2021",
        "2019/2020",
        "2018/2019",
      ],
      sumberdanas: [
        // { text: "Pilih Sumber Dana", value: null },
        // "Perguruan Tinggi",
        // "Kemenristek",
        // "Mandiri",
        // "Luar Perguruan Tinggi",
      ],
      bentukdanas: [
        // { text: "In-Cash", value: null }, "In-Kind"
      ],
      bidangfokuss: [
        // { text: "Pilih Bidang Fokus", value: null },
        // "Techopreneur",
        // "Sistem Informasi",
        // "IOT",
      ],
      prodis: [
        // { text: "Pilih Prodi", value: null },
        // "Teknik Informatika",
        // "Sistem Informasi",
        // "Sistem Informasi Akuntansi",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Semester", value: "semester" },
        { text: "Judul", value: "judul" },
        { text: "Kontrak", value: "kontrak" },
        { text: "Proposal", value: "berkas" },
        { text: "Status", value: "status" },
        { text: "Detail", value: "detail" },
      ],
      contentTables: [
        // {
        //   no: "1",
        //   tahun_akademik: "2020/2021",
        //   semester: "Genap",
        //   judul:
        //     "Implementasi Buku Cerita Bergambar Dwi-Bahasa Untuk Siswa Sekolah Dasar ",
        //   berkas: "example.pdf",
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
        //       nama: "I Putu Satwika, S.Kom, M.Kom",
        //       nidn: "0801088891",
        //       jabatanFungsional: "rektor",
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

        //   kemajuan: {
        //     status: "success",
        //   },
        //   akhir: {
        //     status: "success",
        //   },
        //   publikasi: {
        //     status: "empty",
        //   },

        //   status: "Draft",
        // },

        // {
        //   no: "2",
        //   tahun_akademik: "2020/2021",
        //   semester: "Genap",
        //   judul:
        //     "Implemetasi Aplikasi Augmented Reality Berbasis Lokasi Wisata di Kota ",
        //   berkas: "example.pdf",
        //   mitra: "-",
        //   bidangFokus: "IOT",
        //   dana: [
        //     {
        //       sumberDana: "Mandiri",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "2.500.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "I Putu Satwika, S.Kom, M.Kom",
        //       nidn: "0801088891",
        //       jabatanFungsional: "rektor",
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

        //   kemajuan: {
        //     status: "success",
        //   },
        //   akhir: {
        //     status: "success",
        //   },
        //   publikasi: {
        //     status: "success",
        //   },

        //   status: "Submited",
        // },

        // {
        //   no: "3",
        //   tahun_akademik: "2019/2020",
        //   semester: "Ganjil",
        //   judul: " Pelatihan Digital Marekting UMKM  Sokasi di Desa Tigawasa ",
        //   kontrak: "example.pdf",
        //   berkas: "exmaple.pdf",
        //   mitra: "Stmik Primakara",
        //   bidangFokus: "Sistem Informasi",
        //   dana: [
        //     {
        //       sumberDana: "Perguruan Tinggi",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "4.000.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "I Putu Satwika, S.Kom, M.Kom",
        //       nidn: "0801088891",
        //       jabatanFungsional: "rektor",
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

        //   kemajuan: {
        //     status: "success",
        //   },
        //   akhir: {
        //     status: "rejected",
        //   },
        //   publikasi: {
        //     status: "empty",
        //   },

        //   status: "Aproved",
        // },

        // {
        //   no: "4",
        //   tahun_akademik: "2019/2020",
        //   semester: "Ganjil",
        //   judul: "Pelatihan Pengelolaan Server Bebasis Linux I ",
        //   berkas: "exmaple.pdf",
        //   mitra: "Stmik Primakara",
        //   bidangFokus: "Sistem Informasi",
        //   dana: [
        //     {
        //       sumberDana: "Perguruan Tinggi",
        //       bentukDana: "In-Cash",
        //       jumlahDana: "4.000.000",
        //     },
        //   ],
        //   anggotaDosen: [
        //     {
        //       nama: "I Putu Satwika, S.Kom, M.Kom",
        //       nidn: "0801088891",
        //       jabatanFungsional: "rektor",
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

        //   kemajuan: {
        //     status: "success",
        //   },
        //   akhir: {
        //     status: "rejected",
        //   },
        //   publikasi: {
        //     status: "empty",
        //   },

        //   status: "Rejected",
        // },
      ],
    };
  },
  computed: {
    isFormComplete() {
    return (
      this.form.tahun_akademik &&
      this.form.semester &&
      this.form.judul &&
      // this.form.anggota_dosen_1 &&
      this.form.mahasiswa_1 &&
      this.form.mahasiswa_2 &&
      this.form.mitra &&
      this.form.sumber_dana &&
      this.form.bentuk_dana &&
      this.form.jumlah_dana &&
      this.form.bidang_fokus &&
      this.form.proposal
    );
  },
    currentUser() {
      return this.$store.state.auth.user
    },
    checkDueDate() {
      return this.dateCalculation(
        this.startDateUploadProposal,
        this.duedateUploadProposal
      );
    },
  },
  mounted() {
    // this.$store.dispatch(SET_BREADCRUMB, [{ title: "Proposal Pengabdian" }]);
    this.fetchData();
    this.fetchPenjadwalan();
    this.fetchBidangFokus();
    this.fetchSumberDana();
    this.fetchBentukDana();
    this.fetchDataDosen();
    this.fetchDataMahasiswa();
    console.log(this.currentUser);
  },
  methods: {
    fetchDataMahasiswa() {
      axios.get('http://localhost:8000/api/mahasiswa')
        .then(response => {
          this.DataMahasiswa = response.data.data;
          console.log(this.DataMahasiswa)
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchData() {
      axios.get('http://localhost:8000/api/pengabdian').then(res => {
        console.log("API Response:", res.data.data); // Log the API response

        const currentUserID = this.currentUser.id;

        this.contentTables = res.data.data
          .filter(bf => bf.user_id === currentUserID) // Filter the data based on the user ID
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              semester: bf.semester,
              judul: bf.judul,
              kontrak: bf.kontrak,
              berkas: bf.proposal,
              tipe: "pengabdian",
              status: bf.status,
              detail: bf.id,
            }
          })
        console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
      })
    },

    handleFileUpload(file) {
      this.form.proposal = file; // Simpan file yang diunggah ke dalam data form

      // Optional: Tampilkan informasi file yang diunggah
      console.log("File Name:", file.name);
      console.log("File Size:", file.size);
      console.log("File Type:", file.type);
    },
    onSave() {
      console.log(this.anggotaDosen);
      const anggotaDosenNames = this.anggotaDosen.map((item) => item.id);
      const dosen1 = anggotaDosenNames[0];
      const dosen2 = anggotaDosenNames[1] || null;

      const formData = new FormData();
      formData.append("tahun_akademik", this.form.tahun_akademik);
      formData.append("semester", this.form.semester);
      formData.append("judul", this.form.judul);
      formData.append("anggota_dosen_1", dosen1);
      formData.append("anggota_dosen_2", dosen2);
      formData.append("mahasiswa_1", this.form.mahasiswa_1);
      formData.append("mahasiswa_2", this.form.mahasiswa_2);
      formData.append("mitra", this.form.mitra);
      formData.append("bidang_fokus", this.form.bidang_fokus);
      formData.append("bentuk_dana", this.form.bentuk_dana);
      formData.append("sumber_dana", this.form.sumber_dana);
      formData.append("jumlah_dana", this.form.jumlah_dana);
      formData.append("status", "Submited");
      formData.append("proposal", this.form.proposal);
      formData.append("user_id", this.currentUser.id);

      axios
        .post("http://localhost:8000/api/pengabdian", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          // this.confirmasi = true;
          this.fetchData();
          this.form.tahun_akademik = '';
          this.form.judul = '';
          this.form.anggota_dosen_1 = '';
          this.form.anggota_dosen_2 = '';
          this.form.mahasiswa_1 = '';
          this.form.mahasiswa_2 = '';
          this.form.mitra = '';
          this.form.bidang_fokus = '';
          this.form.bentuk_dana = '';
          this.form.sumber_dana = '';
          this.form.jumlah_dana = '';
          this.form.proposal = '';

        })
        .catch((error) => {
          console.log(error);
        });
    },

    onDraft() {
      console.log(this.anggotaDosen);
      const anggotaDosenNames = this.anggotaDosen.map((item) => item.id);
      const dosen1 = anggotaDosenNames[0];
      const dosen2 = anggotaDosenNames[1] || null;

      const formData = new FormData();
      formData.append("tahun_akademik", this.form.tahun_akademik);
      formData.append("semester", this.form.semester);
      formData.append("judul", this.form.judul);
      formData.append("anggota_dosen_1", dosen1);
      formData.append("anggota_dosen_2", dosen2);
      formData.append("mahasiswa_1", this.form.mahasiswa_1);
      formData.append("mahasiswa_2", this.form.mahasiswa_2);
      formData.append("mitra", this.form.mitra);
      formData.append("bidang_fokus", this.form.bidang_fokus);
      formData.append("bentuk_dana", this.form.bentuk_dana);
      formData.append("sumber_dana", this.form.sumber_dana);
      formData.append("jumlah_dana", this.form.jumlah_dana);
      formData.append("status", "Draft");
      formData.append("proposal", this.form.proposal);
      formData.append("user_id", this.currentUser.id);

      axios
        .post("http://localhost:8000/api/pengabdian", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          // this.confirmasi = true;
          this.fetchData();
          this.form.tahun_akademik = '';
          this.form.judul = '';
          this.form.anggota_dosen_1 = '';
          this.form.anggota_dosen_2 = '';
          this.form.mahasiswa_1 = '';
          this.form.mahasiswa_2 = '';
          this.form.mitra = '';
          this.form.bidang_fokus = '';
          this.form.bentuk_dana = '';
          this.form.sumber_dana = '';
          this.form.jumlah_dana = '';
          this.form.proposal = '';

        })
        .catch((error) => {
          console.log(error);
        });
    },

    fetchPenjadwalan() {
      axios.get('/penjadwalan')
        .then(response => {
          const jadwalPendaftaranProposal = response.data.data.find(
            item => item.type === 'Proposal' && item.jenis === 'penerimaan'
          );
          if (jadwalPendaftaranProposal) {
            console.log(jadwalPendaftaranProposal);
            this.startDateUploadProposal = jadwalPendaftaranProposal.waktu_buka;
            console.log(this.startDateUploadProposal)
            this.duedateUploadProposal = jadwalPendaftaranProposal.waktu_tutup;
            console.log(this.duedateUploadProposal)
          } else {
            console.log('Jadwal pendaftaran proposal tidak ditemukan');
          }
        })
        .catch(error => {
          console.log(error);
        });
    },

    fetchBidangFokus() {
      axios.get('/sumberdana')
        .then(res => {
          // Menyimpan data bidang fokus ke dalam property "bidangfokuss"
          this.sumberdanas = res.data.data.map(data => data.sumber_dana)
          // Menyimpan data bidang fokus ke dalam property "form.bidangFokus"
          // this.form.sumberDana = this.sumberdanas
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchSumberDana() {
      axios.get('/bidangfokus')
        .then(res => {
          // Menyimpan data bidang fokus ke dalam property "bidangfokuss"
          this.bidangfokuss = res.data.data.map(data => data.bidang_fokus)
          // Menyimpan data bidang fokus ke dalam property "form.bidangFokus"
          // this.form.bidangFokus = this.bidangfokuss
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchBentukDana() {
      axios.get('/bentukdana')
        .then(res => {
          // Menyimpan data bidang fokus ke dalam property "bidangfokuss"
          this.bentukdanas = res.data.data.map(data => data.bentuk_dana)
          // Menyimpan data bidang fokus ke dalam property "form.bidangFokus"
          // this.form.bentukDana = this.bentukdanas
        })
        .catch(error => {
          console.error(error)
        })
    },
    fetchDataDosen() {
      axios.get('http://localhost:8000/api/users')
        .then(response => {
          this.Dosen = response.data.data;
          console.log(this.Dosen)
        })
        .catch(error => {
          console.log(error);
        });
    },

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
    detailData(item) {
      this.$router.push({
        name: "detail-pengabdian",
        params: { data: item },
      });
    },
    addNew(value) {
      this.showAdd = value;
    },
    // onClick() {
    //   this.confirmasi = true;
    // },

    onChangeDosenSelect(e) {
  if (this.selectedDosen.length >= 2) {
    // Jika sudah memilih 2 dosen, hentikan proses selanjutnya
    return;
  }

  if (this.searchDosen && this.searchDosen.toLowerCase() == "tambah dosen luar") {
    this.showFormDosenLuar = true;
  } else {
    let data = this.Dosen.find((dosen) => {
      return dosen.name.toLowerCase() == this.searchDosen.toLowerCase();
    });

    // Cek apakah dosen sudah ada di dalam selectedDosen
    if (!this.selectedDosen.some((selected) => selected.name === data.name)) {
      this.selectedDosen.push(data);
      this.anggotaDosen.push(data);
      console.log(data);
      console.log(this.anggotaDosen);
    }

    // Reset nilai searchDosen
    this.searchDosen = null;
  }
},
    addAnggotaDosenLuar() {
      this.form.anggotaDosen.push(this.formDosenLuar);
      this.showFormDosenLuar = false;
    },
    removeAnggotaDosen(item, data) {
      const index = data.indexOf(item);
      if (index >= 0) {
        data.splice(index, 1);
        // Hapus item dari array selectedDosen
        const selectedIndex = this.selectedDosen.indexOf(item);
        if (selectedIndex >= 0) {
          this.selectedDosen.splice(selectedIndex, 1);
        }
      }
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
    dateCalculation(start, end) {
      let dateStart = new Date(start);
      let dateEnd = new Date(end);
      let dateNow = new Date();

      if (dateStart > dateNow) {
        // Upcoming
        return {
          text: "Proposal Registration Not Yet Open",
          isDisable: true,
        };
      } else if (dateStart < dateNow && dateEnd > dateNow) {
        // Process
        return {
          text: "Proposal Registration is Open",
          isDisable: false,
        };
      } else if (dateNow > dateEnd) {
        // Passed
        return {
          text: "Proposal Registration is Closed",
          isDisable: true,
        };
      } else {
        // Default case
        return {
          text: "",
          isDisable: true,
        };
      }
    },
  },
};
</script>
