<template>
  <div>
    <v-dialog v-model="modalAdd" max-width="500px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-calendar-clock</v-icon>
          <v-toolbar-title class="font-weight-light">
            {{ titleModal }}
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="modalAdd = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col md="12">
                <v-menu ref="waktuBuka" v-model="waktuBuka" :close-on-content-click="false" transition="scale-transition"
                  offset-y max-width="290px" min-width="auto">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="form.waktu_buka" label="Waktu Buka" hint="MM/DD/YYYY format" persistent-hint
                      prepend-icon="mdi-calendar" v-bind="attrs" @blur="
                        form.waktu_buka = parseDate(
                          form.waktu_buka
                        )
                        " v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="form.waktu_buka" no-title @input="waktuBuka = false"></v-date-picker>
                </v-menu>
              </v-col>
              <v-col md="12">
                <v-menu ref="waktuTutup" v-model="waktuTutup" :close-on-content-click="false"
                  transition="scale-transition" offset-y max-width="290px" min-width="auto">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="form.waktu_tutup" label="Waktu Tutup" hint="MM/DD/YYYY format" persistent-hint
                      prepend-icon="mdi-calendar" v-bind="attrs" @blur="
                        form.waktu_tutup = parseDate(
                          form.waktu_tutup
                        )
                        " v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="form.waktu_tutup" no-title @input="waktuTutup = false"></v-date-picker>
                </v-menu>
              </v-col>
              <v-col md="12">
                <v-select :items="['Penerimaan', 'Penilaian']" label="Jenis" v-model="form.jenis"></v-select>
              </v-col>
            </v-row>
            <b-button type="button" variant="primary" @click=" onClick(); modalAdd = false">Simpan</b-button>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-dialog v-model="modalEdit" max-width="500px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-calendar-clock</v-icon>
          <v-toolbar-title class="font-weight-light">
            {{ titleModal }}
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="modalEdit = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col md="12">
                <v-menu ref="waktuBuka" v-model="waktuBuka" :close-on-content-click="false" transition="scale-transition"
                  offset-y max-width="290px" min-width="auto">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="form.waktu_buka" label="Waktu Buka" hint="MM/DD/YYYY format" persistent-hint
                      prepend-icon="mdi-calendar" v-bind="attrs" @blur="
                        form.waktu_buka = parseDate(
                          form.waktu_buka
                        )
                        " v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="form.waktu_buka" no-title @input="waktuBuka = false"></v-date-picker>
                </v-menu>
              </v-col>
              <v-col md="12">
                <v-menu ref="waktuTutup" v-model="waktuTutup" :close-on-content-click="false"
                  transition="scale-transition" offset-y max-width="290px" min-width="auto">
                  <template v-slot:activator="{ on, attrs }">
                    <v-text-field v-model="form.waktu_tutup" label="Waktu Tutup" hint="MM/DD/YYYY format" persistent-hint
                      prepend-icon="mdi-calendar" v-bind="attrs" @blur="
                        form.waktu_tutup = parseDate(
                          form.waktu_tutup
                        )
                        " v-on="on"></v-text-field>
                  </template>
                  <v-date-picker v-model="form.waktu_tutup" no-title @input="waktuTutup = false"></v-date-picker>
                </v-menu>
              </v-col>
              <v-col md="12">
                <v-select :items="['Penerimaan', 'Penilaian']" label="Jenis" v-model="form.jenis"></v-select>
              </v-col>
            </v-row>
            <b-button type="button" variant="primary" @click=" onSave(); modalEdit = false">Simpan</b-button>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="modalDelete" max-width="300">
      <v-card>
        <v-card-title class="headline">Apakah Anda Yakin Menghapus data?</v-card-title>

        <v-card-text>
          pastikan anda menghapus data dengan benar
        </v-card-text>

        <v-card-actions>
          <v-spacer></v-spacer>

          <v-btn color="green darken-1" text @click="modalDelete = false">
            Cancel
          </v-btn>

          <v-btn color="green darken-1" text @click="onDelete();
          modalDelete = false;
          ">
            Hapus
          </v-btn>
        </v-card-actions>
      </v-card>
    </v-dialog>
    <v-card>
      <v-tabs v-model="tab" background-color="accent-4" grow>
        <v-tab @click="getPenjadwalan">
          Proposal
        </v-tab>
        <v-tab @click="getKemajuan">
          Laporan Kemajuan
        </v-tab>
        <v-tab @click="getMonev">
          Monev
        </v-tab>
        <v-tab @click="getAkhir">
          Laporan Akhir
        </v-tab>
      </v-tabs>
      <v-tabs-items v-model="tab">
        <v-tab-item v-for="(content, i) in contentTables" :key="i">
          <v-card flat>
            <CustomCard :title="content.title" :deskripsi="content.description" :isDetail="false"
              @addNew="content.addAction" @editItem="content.aksi.edit" @deleteItem="content.aksi.delete"
              :headers="content.data.headers" :contentTable="content.data.content" />
          </v-card>
        </v-tab-item>
        <!-- <v-tab-item>
          <v-card flat>
            <CustomWidget2
              title="Laporan Kemajuan"
              descritpion="List Waku Laporan Kemajuan Dosen Y"
              :dataTabs="tabTable"
              :contentTable="contentTablesLaporanKemajuan"
            ></CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2
              title="Laporan Akhir"
              descritpion="List waktu Laporan Akhir Dosen Yang Telah Diinputkan"
              :dataTabs="tabTable"
              :contentTable="contentTablesLaporanAkhir"
            ></CustomWidget2>
          </v-card>
        </v-tab-item>
        <v-tab-item>
          <v-card flat>
            <CustomWidget2
              title="Publikasi"
              descritpion="List Wakut Publikasi Dosen"
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
  name: "penjadwalan",
  components: {
    CustomWidget2,
    CustomCard,
  },
  data() {
    return {
      form: {
        data_penjadwalans: [],
      },

      tab: "Proposal",
      itemTabs: ["Proposal", "Laporan Kemajuan", "Monev", "Laporan Akhir"],
      tabTable: ["penelitian", "pengabdian"],
      titleModal: "Proposal penelitian",
      modalAdd: false,
      modalDelete: false,
      modalEdit: false,
      waktuBuka: false,
      waktuTutup: false,
      tabValues: null,
      tabType: "Proposal",


      contentTables: [
        {
          itemTabs: "Proposal",
          name: "proposal",
          title: "Daftar Penjadwalan Proposal",
          description: "List Daftar Jadwal Proposal Yang Telah Di Inputkan",
          addAction: function () {
            this.titleModal = "Tambah Jadwal Proposal";
            this.form.waktu_buka = "";
            this.form.waktu_tutup = "";
            this.form.jenis = "";
            this.modalAdd = true;
          }.bind(this),

          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              // { text: "Tahun Akademik", value: "tahun_akademik" },
              { text: "Jenis", value: "jenis" },
              { text: "Waktu Buka", value: "waktu_buka" },
              { text: "Waktu Tutup", value: "waktu_tutup" },
              { text: "Action", value: "detail" },
            ],
            content: [],

          },
          aksi: {
            detail: function (item) {
              this.detail = item.id;
            }.bind(this),
            edit: function (item) {
              this.editData(item);
              this.titleModal = "Edit Jadwal Proposal";
              this.modalEdit = true;
              console.log(this.form);
            }.bind(this),
            delete: function (item) {
              this.deleteData(item);
              this.modalDelete = true;
            }.bind(this),
          },
        },
        {
          itemTabs: "Laporan Kemajuan",
          name: "kemajuan",
          title: "Daftar Penjadwalan Laporan Kemajuan",
          description: "List Daftar Jadwal Laporan Kemajuan Yang Telah Di Inputkan",
          addAction: function () {
            this.titleModal = "Tambah Jadwal Kemajuan";
            this.form.waktu_buka = "";
            this.form.waktu_tutup = "";
            this.form.jenis = "";
            this.modalAdd = true;
          }.bind(this),

          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              // { text: "Tahun Akademik", value: "tahun_akademik" },
              { text: "Jenis", value: "jenis" },
              { text: "Waktu Buka", value: "waktu_buka" },
              { text: "Waktu Tutup", value: "waktu_tutup" },
              { text: "Action", value: "detail" },
            ],
            content: [],

          },
          aksi: {
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              this.editData(item);
              this.titleModal = "Edit Jadwal Kemajuan";
              this.modalEdit = true;
              console.log(this.form);
            }.bind(this),
            delete: function (item) {
              this.deleteData(item);
              this.modalDelete = true;
            }.bind(this),
          },
        },
        {
          itemTabs: "Monev",
          name: "monev",
          title: "Daftar Penjadwalan Monev",
          description: "List Daftar Jadwal Monev Yang Telah Di Inputkan",
          addAction: function () {
            this.titleModal = "Tambah Jadwal Monev";
            this.form.waktu_buka = "";
            this.form.waktu_tutup = "";
            this.form.jenis = "";
            this.modalAdd = true;
          }.bind(this),

          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Tahun Akademik", value: "tahun_akademik" },
              { text: "Jenis", value: "jenis" },
              { text: "Waktu Buka", value: "waktu_buka" },
              { text: "Waktu Tutup", value: "waktu_tutup" },
              { text: "Action", value: "detail" },
            ],
            content: [],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              this.editData(item);
              this.titleModal = "Edit Jadwal Monev";
              this.modalEdit = true;
              console.log(this.form);
            }.bind(this),
            delete: function (item) {
              this.deleteData(item);
              this.modalDelete = true;
            }.bind(this),
          },
        },
        {
          itemTabs: "Laporan Akhir",
          name: "akhir",
          title: "Daftar Penjadwalan Laporan Akhir",
          description: "List Daftar Jadwal Laporan Akhir Yang Telah Di Inputkan",
          addAction: function () {
            this.titleModal = "Tambah Jadwal Akhir";
            this.form.waktu_buka = "";
            this.form.waktu_tutup = "";
            this.form.jenis = "";
            this.modalAdd = true;
          }.bind(this),

          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Tahun Akademik", value: "tahun_akademik" },
              { text: "Jenis", value: "jenis" },
              { text: "Waktu Buka", value: "waktu_buka" },
              { text: "Waktu Tutup", value: "waktu_tutup" },
              { text: "Action", value: "detail" },
            ],
            content: [],

          },
          aksi: {
            detail: function (item) {
              console.log(item);
            }.bind(this),
            edit: function (item) {
              this.editData(item);
              this.titleModal = "Edit Jadwal Akhir";
              this.modalEdit = true;
              console.log(this.form);
            }.bind(this),
            delete: function (item) {
              this.deleteData(item);
              this.modalDelete = true;
            }.bind(this),
          },
        },
      ],
    };
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user.data
    }
  },
  mounted() {
    console.log(this.currentUser);
    this.getPenjadwalan();
  },
  methods: {
    getPenjadwalan() {
      // Mengambil nilai dari tab yang aktif
      this.tabType = "Proposal";

      // Menampilkan data sesuai dengan nilai activeTab
      axios.get('http://localhost:8000/api/penjadwalan').then(res => {
        console.log(res);
        if (res && res.headers) {
          // Update the content array with the retrieved data
          this.contentTables[0].data.content = res.data.data.filter(bf => bf.type === this.tabType).map((bf, index) => {
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              jenis: bf.jenis,
              waktu_buka: bf.waktu_buka,
              waktu_tutup: bf.waktu_tutup,
              type: bf.type,
              detail: bf.id
            }
          });
        } else {
          console.log('Respon tidak valid atau properti headers tidak ditemukan');
        }
      }).catch(err => {
        console.error(err);
      });

    },

    getKemajuan() {
      // Mengambil nilai dari tab yang aktif
      this.tabType = "Laporan Kemajuan";

      // Menampilkan data sesuai dengan nilai activeTab
      axios.get('http://localhost:8000/api/penjadwalan').then(res => {
        console.log(res);
        if (res && res.headers) {
          // Update the content array with the retrieved data
          this.contentTables[1].data.content = res.data.data.filter(bf => bf.type === this.tabType).map((bf, index) => {
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              jenis: bf.jenis,
              waktu_buka: bf.waktu_buka,
              waktu_tutup: bf.waktu_tutup,
              type: bf.type,
              detail: bf.id
            }
          });
        } else {
          console.log('Respon tidak valid atau properti headers tidak ditemukan');
        }
      }).catch(err => {
        console.error(err);
      });
    },

    getMonev() {
      // Mengambil nilai dari tab yang aktif
      this.tabType = "Monev";

      // Menampilkan data sesuai dengan nilai activeTab
      axios.get('http://localhost:8000/api/penjadwalan').then(res => {
        console.log(res);
        if (res && res.headers) {
          // Update the content array with the retrieved data
          this.contentTables[2].data.content = res.data.data.filter(bf => bf.type === this.tabType).map((bf, index) => {
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              jenis: bf.jenis,
              waktu_buka: bf.waktu_buka,
              waktu_tutup: bf.waktu_tutup,
              type: bf.type,
              detail: bf.id
            }
          });
        } else {
          console.log('Respon tidak valid atau properti headers tidak ditemukan');
        }
      }).catch(err => {
        console.error(err);
      });
    },

    getAkhir() {
      // Mengambil nilai dari tab yang aktif
      this.tabType = "Laporan Akhir";

      // Menampilkan data sesuai dengan nilai activeTab
      axios.get('http://localhost:8000/api/penjadwalan').then(res => {
        console.log(res);
        if (res && res.headers) {
          // Update the content array with the retrieved data
          this.contentTables[3].data.content = res.data.data.filter(bf => bf.type === this.tabType).map((bf, index) => {
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              jenis: bf.jenis,
              waktu_buka: bf.waktu_buka,
              waktu_tutup: bf.waktu_tutup,
              type: bf.type,
              detail: bf.id
            }
          });
        } else {
          console.log('Respon tidak valid atau properti headers tidak ditemukan');
        }
      }).catch(err => {
        console.error(err);
      });
    },

    onClick() {
      const data = {
        tahun_akademik: this.form.tahun_akademik,
        jenis: this.form.jenis,
        waktu_buka: this.form.waktu_buka,
        waktu_tutup: this.form.waktu_tutup,
        type: this.tabType
      };

      axios.post('http://localhost:8000/api/penjadwalan', data)
        .then(res => {

          console.log(res);

          if (this.tabType === 'Proposal') {
            this.getPenjadwalan();
          } else if (this.tabType === 'Laporan Kemajuan') {
            this.getKemajuan();
          } else if (this.tabType === 'Monev') {
            this.getMonev();
          } else if (this.tabType === 'Laporan Akhir') {
            this.getAkhir();
          }
        })

        .catch(err => {
          // Log any errors that occur
          console.error(err);
        });
    },


    editData(item) {
      this.modalEdit = true;
      this.form = { jenis: item.jenis, waktu_buka: item.waktu_buka, waktu_tutup: item.waktu_tutup };
      this.detail = item.detail; // Set the detail variable to the ID of the item being edited
      axios.get(`http://localhost:8000/api/penjadwalan/${this.detail}`)
        .then(res => {
          console.log(res);
          // Populate the form fields with the retrieved data
          this.form.jenis = res.data.jenis;
          this.form.waktu_buka = res.data.waktu_buka;
          this.form.waktu_tutup = res.data.waktu_tutup;
        })
        .catch(err => {
          // Log any errors that occur
          console.error(err);
        });
    },

    onSave() {
      if (!this.detail) {
        console.error("No ID provided for update");
        return;
      }
      const data = {
        jenis: this.form.jenis,
        waktu_buka: this.form.waktu_buka,
        waktu_tutup: this.form.waktu_tutup,
        type: this.tabType,
      };

      axios.put(`http://localhost:8000/api/penjadwalan/${this.detail}`, data)
        .then(res => {
          if (res && res.data) {
            console.log(res);

            if (this.tabType === 'Proposal') {
              this.getPenjadwalan();
            } else if (this.tabType === 'Laporan Kemajuan') {
              this.getKemajuan();
            } else if (this.tabType === 'Monev') {
              this.getMonev();
            } else if (this.tabType === 'Laporan Akhir') {
              this.getAkhir();
            }
          } else {
            console.error('Respon tidak valid atau properti data tidak ditemukan');
          }
        })
        .catch(err => {
          // Log any errors that occur
          console.error(err);
        });
    },

    deleteData(item) {
      console.log(item);
      this.modalDelete = true;
      this.deleteItemId = item.detail;
    },

    onDelete() {
      // Send a DELETE request to the API with the ID of the item being deleted
      axios.delete(`http://localhost:8000/api/penjadwalan/${this.deleteItemId}`)
        .then(res => {
          if (res && res.data) {
            console.log(res);

            if (this.tabType === 'Proposal') {
              this.getPenjadwalan();
            } else if (this.tabType === 'Laporan Kemajuan') {
              this.getKemajuan();
            } else if (this.tabType === 'Monev') {
              this.getMonev();
            } else if (this.tabType === 'Laporan Akhir') {
              this.getAkhir();
            }
          } else {
            console.error('Respon tidak valid atau properti data tidak ditemukan');
          }
        })
        .catch(err => {
          // Log any errors that occur
          console.error(err);
        });
    },




    formatDate(date) {
      if (!date) return null;

      const [dateTime, ...rest] = date.split(" ");
      const [year, month, day] = dateTime.split("-");
      return `${month}/${day}/${year} ${rest.join(" ")}`;
    },

    parseDate(date) {
      if (!date) return null;

      const [dateTime, ...rest] = date.split(" ");
      const [month, day, year] = dateTime.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")} ${rest.join(" ")}`;
    }
  },
};
</script>

// contentTablesProposal: [
      //   {
      //     name: "penelitian",
      //     addAction: function () {
      //       this.titleModal = "Proposal Penelitian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Proposal Penelitian";
      //         this.modalAdd = true;
      //         console.log(this.formPenjadwalan);
      //       }.bind(this),
      //     },
      //   },
      //   {
      //     name: "pengabdian",
      //     addAction: function () {
      //       this.titleModal = "Proposal Pengabdian";

      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),

      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),

      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Proposal Pengabdian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      // ],
      // contentTablesLaporanKemajuan: [
      //   {
      //     name: "penelitian",
      //     addAction: function () {
      //       this.titleModal = "Laporan Kemajuan Peneilitan";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Laporan Kemajuan Penelitian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      //   {
      //     name: "pengabdian",
      //     addAction: function () {
      //       this.titleModal = "Laporan Kemajuan Pengabdian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Laporan Kemajuan Pengabdian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      // ],
      // contentTablesLaporanAkhir: [
      //   {
      //     name: "penelitian",
      //     addAction: function () {
      //       this.titleModal = "Laporan Akhir Penelitian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";

      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Laporan Akhir Penelitian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      //   {
      //     name: "pengabdian",
      //     addAction: function () {
      //       this.titleModal = "Laporan Akhir Pengabdian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Laporan Akhir Pengabdian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      // ],
      // contentTablesPublikasi: [
      //   {
      //     name: "penelitian",
      //     addAction: function () {
      //       this.titleModal = "Publikasi Penelitian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";

      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Publikasi penelitian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      //   {
      //     name: "pengabdian",
      //     addAction: function () {
      //       this.titleModal = "Publikasi Pengabdian";
      //       this.formPenjadwalan.waktu_buka = "";
      //       this.formPenjadwalan.waktu_tutup = "";
      //       this.formPenjadwalan.jenis = "";
      //       this.modalAdd = true;
      //     }.bind(this),
      //     data: {
      //       headers: [
      //         { text: "No", value: "no", width: "70px" },
      //         { text: "Jenis", value: "jenis" },
      //         { text: "Waktu Buka", value: "waktu_buka" },
      //         { text: "Waktu Tutup", value: "waktu_tutup" },
      //         { text: "Action", value: "aksi" },
      //       ],
      //       content: [
      //         {
      //           no: "1",
      //           jenis: "Penerimaan",
      //           waktu_buka: "2021-12-01",
      //           waktu_tutup: "2021-12-01",
      //         },
      //         {
      //           no: "2",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //         {
      //           no: "3",
      //           jenis: "Penilaian",
      //           waktu_buka: "2021-12-21",
      //           waktu_tutup: "2021-12-31",
      //         },
      //       ],
      //     },
      //     aksi: {
      //       detail: function (item) {
      //         console.log(item);
      //       }.bind(this),
      //       edit: function (item) {
      //         this.formPenjadwalan.waktu_buka = this.formatDate(
      //           item.waktu_buka
      //         );
      //         this.formPenjadwalan.waktu_tutup = this.formatDate(
      //           item.waktu_tutup
      //         );
      //         this.formPenjadwalan.jenis = item.jenis;
      //         this.titleModal = "Publikasi Pengabdian";
      //         this.modalAdd = true;

      //         console.log(item);
      //       }.bind(this),
      //     },
      //   },
      // ],