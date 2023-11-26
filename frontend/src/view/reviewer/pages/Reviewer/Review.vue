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
            <CustomWidget2 title="Proposal" descritpion="List Data Penilaian Proposal  Yang Telah Diinputkan"
              :dataTabs="tabTable" :contentTable="contentTablesProposal" :isDetail="false" :isEdit="false">
              <template v-slot:aksi="{ data, item }">
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <div v-on="on">
                      <v-icon v-bind="attrs" small color="warning" class="mr-2" @click="data.aksi.edit(item)" :disabled="dateCalculation(
                        data.aksi.time.startDateUploadProposal,
                        data.aksi.time.duedateUploadProposal,
                        'Penilaian Proposal '
                      ).isDisable || isActionDisabled(item)">
                        mdi-pencil
                      </v-icon>
                    </div>
                  </template>

                  <span>
                    {{
                      dateCalculation(
                        data.aksi.time.startDateUploadProposal,
                        data.aksi.time.duedateUploadProposal,
                        "Penilaian Proposal "
                      ).text
                    }}
                  </span>
                </v-tooltip>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Laporan Kemajuan"
              descritpion="List Data Penilaian Laporan Kemajuan  Yang Telah Diinputkan" :dataTabs="tabTable"
              :contentTable="contentTablesLaporanKemajuan" :isDetail="false" :isEdit="false">
              <template v-slot:aksi="{ data, item }">
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <div v-on="on">
                      <v-icon v-bind="attrs" small color="warning" class="mr-2" @click="data.aksi.edit(item)" :disabled="dateCalculation(
                        data.aksi.time.startDateUploadKemajuan,
                        data.aksi.time.duedateUploadKemajuan,
                        'Penilaian Laporan Kemajuan'
                      ).isDisable || isActionDisabled(item)">
                        mdi-pencil
                      </v-icon>
                    </div>
                  </template>

                  <span>
                    {{
                      dateCalculation(
                        data.aksi.time.startDateUploadKemajuan,
                        data.aksi.time.duedateUploadKemajuan,
                        "Penilaian Laporan Kemajuan"
                      ).text
                    }}
                  </span>
                </v-tooltip>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <!-- <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Monev" descritpion="List Data Penilaian Monev  Yang Telah Diinputkan"
              :dataTabs="tabTable" :contentTable="contentTablesLaporanAkhir" :isDetail="false" :isEdit="false">
              <template v-slot:aksi="{ data, item }">
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <div v-on="on">
                      <v-icon v-bind="attrs" small color="warning" class="mr-2" @click="data.aksi.edit(item)" :disabled="dateCalculation(
                        data.aksi.time.startDateUpload,
                        data.aksi.time.duedateUpload,
                        'Penilaian Monev'
                      ).isDisable
                        ">
                        mdi-pencil
                      </v-icon>
                    </div>
                  </template>

                  <span>
                    {{
                      dateCalculation(
                        data.aksi.time.startDateUpload,
                        data.aksi.time.duedateUpload,
                        "Penilaian Monev"
                      ).text
                    }}
                  </span>
                </v-tooltip>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item> -->
        <v-tab-item>
          <v-card flat>
            <CustomWidget2 title="Laporan Akhir" descritpion="List Data Penilaian Laporan Akhir  Yang Telah Diinputkan"
              :dataTabs="tabTable" :contentTable="contentTablesLaporanAkhir" :isDetail="false" :isEdit="false">
              <template v-slot:aksi="{ data, item }">
                <v-tooltip top>
                  <template v-slot:activator="{ on, attrs }">
                    <div v-on="on">
                      <v-icon v-bind="attrs" small color="warning" class="mr-2" @click="data.aksi.edit(item)" :disabled="dateCalculation(
                        data.aksi.time.startDateUploadAkhir,
                        data.aksi.time.duedateUploadAkhir,
                        'Penilaian Laporan Akhir'
                      ).isDisable || isActionDisabled(item)">
                        mdi-pencil
                      </v-icon>
                    </div>
                  </template>

                  <span>
                    {{
                      dateCalculation(
                        data.aksi.time.startDateUploadAkhir,
                        data.aksi.time.duedateUploadAkhir,
                        "Penilaian Laporan Akhir"
                      ).text
                    }}
                  </span>
                </v-tooltip>
              </template>
            </CustomWidget2>
          </v-card>
        </v-tab-item>
        <!-- <v-tab-item>
          <v-card flat>
            <CustomWidget2
              title="Publikasi"
              descritpion="data publikasi dosen"
              :dataTabs="tabTable"
              :contentTable="contentTablesPublikasi"
            ></CustomWidget2>
          </v-card>
        </v-tab-item> -->
      </v-tabs-items>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomWidget2 from "@/view/content/CustomWidget2";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "Review",
  components: {
    CustomWidget2,
    CustomCard,
  },
  data() {
    return {
      // duedateUploadProposal: "",
      // startDateUploadProposal: "",
      tab: "Proposal",
      // itemTabs: ["Proposal", "Laporan Kemajuan", "Monev", "Laporan Akhir"],
      itemTabs: ["Proposal", "Laporan Kemajuan", "Laporan Akhir"],
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
            ],
            content: [],
          },
          aksi: {
            time: {
              duedateUploadProposal: "",
              startDateUploadProposal: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-penelitian",
                params: { item: item, tabName: "Proposal Penelitan" },
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
              // {
              //   no: "1",
              //   nama: "I Putu Satwika, S.Kom, M.Kom",
              //   judul: "Implementasi Perpustakaan Digital Berbasis Website",
              //   tahun_ajaran: "2020/2021",
              //   semester: "Genap",
              //   nilai: 20,

              //   status: "Waiting",
              // },
              // {
              //   no: "2",
              //   nama: "Nengah Widya Utami, S.Pd., M.Kom.",
              //   judul:
              //     "Peningkatan Kopetensi Guru Melalui Pelatihan Pemanfaatan Teknologi",
              //   tahun_ajaran: "2020/2021",
              //   semester: "Genap",
              //   nilai: 20,
              //   status: "Selesai",
              // },
              // {
              //   no: "3",
              //   nama: "Nyoman Purnama,S.T.,M.T.",
              //   judul:
              //     "Pendampingan Pengenalan Data Warehouse Pada Siswa SMA Negeri 1 Gianyar",
              //   tahun_ajaran: "2020/2021",
              //   semester: "Genap",
              //   status: "Selesai",
              // },
            ],
          },
          aksi: {
            time: {
              duedateUploadProposal: "",
              startDateUploadProposal: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-pengabdian",
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
            ],
            content: [],
          },
          aksi: {
            time: {
              duedateUploadKemajuan: "",
              startDateUploadKemajuan: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-penelitian-laporankemajuan",
                params: { item: item, tabName: "Laporan Kemajuan Penelitan" },
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
            ],
            content: [
              // {
              //   no: "1",
              //   nama: "Nengah Widya Utami, S.Pd., M.Kom.",
              //   judul:
              //     "Peningkatan Kopetensi Guru Melalui Pelatihan Pemanfaatan Teknologi",
              //   tahun_ajaran: "2020/2021",
              //   semester: "Genap",
              //   nilai: 20,
              //   status: "Waiting",
              // },
            ],
          },
          aksi: {
            time: {
              duedateUploadKemajuan: "",
              startDateUploadKemajuan: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-pengabdian-laporankemajuan",
                params: { item: item, tabName: "Laporan Kemajuan Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
      // contentTablesMonev: [
      //   {
      //     name: "penelitian",
      //     data: {
      //       headers: [
      //         {
      //           text: "TIDAK ADA DATA PENILAIN",
      //           align: "center",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       time: {
      //         duedateUpload: "2021-09-21",
      //         startDateUpload: "2021-08-24",
      //       },
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         console.log(item);
      //         this.$router.push({
      //           name: "detail-review",
      //           params: { data: item, tabName: "Monev Penelitan" },
      //         });
      //       }.bind(this),
      //     },
      //   },
      //   {
      //     name: "pengabdian",
      //     data: {
      //       headers: [{ text: "TIDAK ADA DATA PENILAIN", align: "center" }],
      //     },
      //     aksi: {
      //       time: {
      //         duedateUpload: "2021-09-21",
      //         startDateUpload: "2021-08-24",
      //       },
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         console.log(item);
      //         this.$router.push({
      //           name: "detail-review",
      //           params: { data: item, tabName: "Monev Pengabdian" },
      //         });
      //       }.bind(this),
      //     },
      //   },
      // ],
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
              
            ],
            content: [],
          },
          aksi: {
            time: {
              duedateUploadAkhir: "",
              startDateUploadAkhir: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-penelitian-laporanakhir",
                params: { item: item, tabName: "Laporan Akhir Penelitan" },
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
                value: "tahun_ajaran_semester",
                width: "130px",
              },
              { text: "Status", value: "status" },
              { text: "Nilai", value: "nilai" },
              { text: "Aksi", value: "aksi" },
            ],
            content: [],
          },
          aksi: {
            time: {
              duedateUploadAkhir: "",
              startDateUploadAkhir: "",
            },
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "review-pengabdian-laporanakhir",
                params: { item: item, tabName: "Laporan Akhir Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Penilaian" }]);
    this.fetchJadwalProposal();
    this.fetchJadwalKemajuan();
    this.fetchJadwalAkhir();
    this.fetchProposalPenelitian();
    this.fetchProposalPengabdian();
    this.fetchKemajuanPenelitian();
    this.fetchKemajuanPengabdian();
    this.fetchAkhirPenelitian();
    this.fetchAkhirPengabdian();
    console.log(this.currentUser);
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user
    },
  },
  methods: {
    isActionDisabled(item) {
    // Assuming 'status' is a property of the item
    return item.status === 'Selesai';
  },
    fetchProposalPenelitian() {

      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Fetch penelitian data
      const penilaianPromise = axios.get('http://localhost:8000/api/showpenilaian-penelitian/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log the API response

          // Create reviewer mapping
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          this.contentTablesProposal[0].data.content = penilaianRes.data.map((penelitian, index) => {
            console.log("Current Data:", penelitian); // Log the current data object being mapped

            const datapenilaian = penelitian.datapenilaian.find(item => item.user_id === this.currentUser.id);

            // Check if datapenilaian is not null
            const totalNilai = datapenilaian ? datapenilaian.total : 0;
            const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";

            return {
              no: index + 1,
              nama: dosenMapping[penelitian.user_id],
              judul: penelitian.judul,
              tahun_ajaran: penelitian.tahun_akademik,
              semester: penelitian.semester,
              nilai: totalNilai,
              status: statusPenilaian,
              aksi: penelitian.id
            };
          });

          console.log("Content Tables:", this.contentTablesProposal[0]); // Log the updated contentTables array
        });
    },
    fetchProposalPengabdian() {

      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Fetch penelitian data
      const penilaianPromise = axios.get('http://localhost:8000/api/show-value-proposal/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log the API response

          // Create reviewer mapping
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          this.contentTablesProposal[1].data.content = penilaianRes.data.map((pengabdian, index) => {
            console.log("Current Data:", pengabdian); // Log the current data object being mapped

            const datapenilaian = pengabdian.datapenilaian.find(item => item.user_id === this.currentUser.id);

            // Check if datapenilaian is not null
            const totalNilai = datapenilaian ? datapenilaian.total : 0;
            const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";

            return {
              no: index + 1,
              nama: dosenMapping[pengabdian.user_id],
              judul: pengabdian.judul,
              tahun_ajaran: pengabdian.tahun_akademik,
              semester: pengabdian.semester,
              nilai: totalNilai,
              status: statusPenilaian,
              aksi: pengabdian.id
            };
          });

          console.log("Content Tables:", this.contentTablesProposal[1]); // Log the updated contentTables array
        });
    },
    fetchKemajuanPenelitian() {

      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Fetch penelitian data
      const penilaianPromise = axios.get('http://localhost:8000/api/showpenilaian-penelitian-kemajuan/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log the API response

          // Create reviewer mapping
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          const laporanKemajuan = penilaianRes.data[0].laporankemajuan;

          if (laporanKemajuan !== null) {
            this.contentTablesLaporanKemajuan[0].data.content = penilaianRes.data.map((item, index) => {
              console.log("Current Data:", item); // Log the current data object being mapped

              const datapenilaian = item.datapenilaian.find(item => item.user_id === this.currentUser.id);

              // Check if datapenilaian is not null
              const totalNilai = datapenilaian ? datapenilaian.total : 0;
              const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";
              // let status = item.laporankemajuan.status === "waiting" ? "Waiting" : item.laporankemajuan.status;


              return {
                no: index + 1,
                nama: dosenMapping[item.user_id],
                judul: item.judul,
                tahun_ajaran: item.tahun_akademik,
                semester: item.semester,
                nilai: totalNilai,
                status: statusPenilaian,
                aksi: item.id
              };
            });
          };
          console.log("Content Tables:", this.contentTablesLaporanKemajuan[0]); // Log the updated contentTables array
        });
    },
    fetchKemajuanPengabdian() {
      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Mengambil data penilaian
      const penilaianPromise = axios.get('http://localhost:8000/api/show-value-kemajuan/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log respon dari API

          // Membuat pemetaan dosen
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          const laporanKemajuan = penilaianRes.data[0].laporankemajuan;

          if (laporanKemajuan !== null) {
            this.contentTablesLaporanKemajuan[1].data.content = penilaianRes.data.map((item, index) => {
              console.log("Data Saat Ini:", item); // Log objek data saat ini yang sedang di-mapping

              const datapenilaian = item.datapenilaian.find(item => item.user_id === this.currentUser.id);

              // Memeriksa apakah datapenilaian tidak null
              const totalNilai = datapenilaian ? datapenilaian.total : 0;
              const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";

              return {
                no: index + 1,
                nama: dosenMapping[item.user_id],
                judul: item.judul,
                tahun_ajaran: item.tahun_akademik,
                semester: item.semester,
                nilai: totalNilai,
                status: statusPenilaian,
                aksi: item.id
              };
            });
          }

          console.log("Tabel Konten:", this.contentTablesLaporanKemajuan[1]); // Log array contentTables yang telah diperbarui
        });
    },
    fetchAkhirPenelitian() {
      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Mengambil data penilaian
      const penilaianPromise = axios.get('http://localhost:8000/api/showpenilaian-penelitian-akhir/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log respon dari API

          // Membuat pemetaan dosen
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          const laporanAkhir = penilaianRes.data[0].laporanakhir;

          if (laporanAkhir !== null) {
            this.contentTablesLaporanAkhir[0].data.content = penilaianRes.data.map((item, index) => {
              console.log("Data Saat Ini:", item); // Log objek data saat ini yang sedang di-mapping

              const datapenilaian = item.datapenilaian.find(item => item.user_id === this.currentUser.id);

              // Memeriksa apakah datapenilaian tidak null
              const totalNilai = datapenilaian ? datapenilaian.total : 0;
              const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";

              return {
                no: index + 1,
                nama: dosenMapping[item.user_id],
                judul: item.judul,
                tahun_ajaran: item.tahun_akademik,
                semester: item.semester,
                nilai: totalNilai,
                status: statusPenilaian,
                aksi: item.id
              };
            });
          }

          console.log("Tabel Konten:", this.contentTablesLaporanAkhir[0]); // Log array contentTables yang telah diperbarui
        });
    },
    fetchAkhirPengabdian() {
      const dosenPromise = axios.get('http://localhost:8000/api/users');

      // Mengambil data penilaian
      const penilaianPromise = axios.get('http://localhost:8000/api/show-value-akhir/' + this.currentUser.id);

      Promise.all([dosenPromise, penilaianPromise])
        .then(([dosenRes, penilaianRes]) => {
          console.log("API Response:", penilaianRes.data); // Log respon dari API

          // Membuat pemetaan dosen
          const dosenMapping = {};
          dosenRes.data.data.forEach(dosen => {
            dosenMapping[dosen.id] = dosen.name;
          });

          const laporanAkhir = penilaianRes.data[0].laporanakhir;

          if (laporanAkhir !== null) {
            this.contentTablesLaporanAkhir[1].data.content = penilaianRes.data.map((item, index) => {
              console.log("Data Saat Ini:", item); // Log objek data saat ini yang sedang di-mapping

              const datapenilaian = item.datapenilaian.find(item => item.user_id === this.currentUser.id);

              // Memeriksa apakah datapenilaian tidak null
              const totalNilai = datapenilaian ? datapenilaian.total : 0;
              const statusPenilaian = datapenilaian ? datapenilaian.status : "Waiting";

              return {
                no: index + 1,
                nama: dosenMapping[item.user_id],
                judul: item.judul,
                tahun_ajaran: item.tahun_akademik,
                semester: item.semester,
                nilai: totalNilai,
                status: statusPenilaian,
                aksi: item.id
              };
            });
          }

          console.log("Tabel Konten:", this.contentTablesLaporanAkhir[1]); // Log array contentTables yang telah diperbarui
        });
    },

    fetchJadwalProposal() {
      axios.get('http://localhost:8000/api/penjadwalan')
        .then(response => {
          // console.log("API Response:", response.data.data); // Log the API response

          const jadwalPenilaianProposal = response.data.data.find(
            item => item.type === 'Proposal' && item.jenis === 'penilaian'
          );
          if (jadwalPenilaianProposal) {
            this.contentTablesProposal.forEach(item => {
              if (item.name === 'penelitian' || item.name === 'pengabdian') {
                item.aksi.time.startDateUploadProposal = jadwalPenilaianProposal.waktu_buka;
                item.aksi.time.duedateUploadProposal = jadwalPenilaianProposal.waktu_tutup;
              }
            });
          } else {
            console.log('Jadwal pendaftaran proposal tidak ditemukan');
          }
        })
        .catch(error => {
          console.log(error);
        });
    },

    fetchJadwalKemajuan() {
      axios.get('http://localhost:8000/api/penjadwalan')
        .then(response => {
          console.log("API Response:", response.data.data); // Log the API response

          const jadwalPenilaian = response.data.data.find(
            item => item.type === 'Laporan Kemajuan' && item.jenis === 'penilaian'
          );
          if (jadwalPenilaian) {
            this.contentTablesLaporanKemajuan.forEach(item => {
              if (item.name === 'penelitian' || item.name === 'pengabdian') {
                item.aksi.time.startDateUploadKemajuan = jadwalPenilaian.waktu_buka;
                item.aksi.time.duedateUploadKemajuan = jadwalPenilaian.waktu_tutup;
              }
            });
          } else {
            console.log('Jadwal pendaftaran proposal tidak ditemukan');
          }
        })
        .catch(error => {
          console.log(error);
        });
    },
    fetchJadwalAkhir() {
      axios.get('http://localhost:8000/api/penjadwalan')
        .then(response => {
          console.log("API Response:", response.data.data); // Log the API response

          const jadwalPenilaian = response.data.data.find(
            item => item.type === 'Laporan Akhir' && item.jenis === 'penilaian'
          );
          if (jadwalPenilaian) {
            this.contentTablesLaporanAkhir.forEach(item => {
              if (item.name === 'penelitian' || item.name === 'pengabdian') {
                item.aksi.time.startDateUploadAkhir = jadwalPenilaian.waktu_buka;
                item.aksi.time.duedateUploadAkhir = jadwalPenilaian.waktu_tutup;
              }
            });
          } else {
            console.log('Jadwal pendaftaran proposal tidak ditemukan');
          }
        })
        .catch(error => {
          console.log(error);
        });
    },

    dateCalculation(start, end, subject = "Penilaian Proposal") {
      let dateStart = new Date(start);
      let dateEnd = new Date(end);
      let dateNow = new Date();

      if (dateStart > dateNow) {
        // Upcoming
        return {
          text: subject + " Belum Di Buka",
          isDisable: true,
        };
      } else if (dateStart < dateNow && dateEnd > dateNow) {
        // Process
        return {
          text: subject + " Telah Di Buka",
          isDisable: false,
        };
      } else if (dateNow > dateEnd) {
        // Passed
        return {
          text: subject + " Telah Di Tutup",
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