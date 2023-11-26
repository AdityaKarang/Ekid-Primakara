<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="nilaiPopup" max-width="500">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Hasil Penilaian Laporan Akhir
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="nilaiPopup = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>

          <v-data-table :headers="headerPenilaian" :items="dataNilai" hide-default-footer>
            <template slot="item" slot-scope="props">
              <tr>
                <td>{{ props.item.kriteria_penilaian_id }}</td>
                <td>{{ props.item.kriteria }}</td>
                <td>{{ props.item.indikator }}</td>
                <td>{{ props.item.bobot }}</td>
                <td>{{ props.item.value }}</td>

              </tr>
            </template>

            <template slot="body.append">
              <tr>
                <th colspan="4" class="text-end">Total</th>
                <th>
                  {{ getTotalValue(dataNilai) }}
                </th>
              </tr>
            </template>
          </v-data-table>
          <v-row class="mt-2 p-3">
            <v-col cols="12">
              <v-textarea name="input-keterangan" label="Catatan" outlined v-model="keterangan" value=""
                disabled></v-textarea>
            </v-col>
          </v-row>
        </v-card>
      </v-dialog>
    </v-row>
    <CustomCard title="Daftar Akhir Penelitian" deskripsi="List Daftar Akhir Penelitian Yang Telah Di Inputkan"
      :headers="headers" :contentTable="filterDataContentTable" :additionalData="additionalData" :isTopAction="false"
      :isEdit="false" :isDelete="false" :isDetail="false" @saveReviewers="saveReviewers">
      <template v-slot:filter>
        <div class="w-30 mr-2">
          <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademik"
            label="Tahun Akademik dan semester"></v-select>
        </div>
        <div class="w-30 mr-2">
          <v-select :items="dataFilterProdi" label="Prodi" v-model="filterProdi"></v-select>
        </div>
      </template>
      <template v-slot:additioalFilter>
        <div class="ml-2">
          <CountDashboard v-bind:count="countDataMasuk" title="Proposal Masuk" icon="./media/svg/files/doc.svg"
            textButton="Lihat Semua Data" @clickData="filterDataMasuk"></CountDashboard>
        </div>
        <div class="ml-2">
          <CountDashboard v-bind:count="countTelahDiPlot" title="Set Reviewer" icon="./media/svg/files/doc.svg"
            textButton="Lihat  Belum Di Set" @clickData="filterBelumDiPlot"></CountDashboard>
        </div>
        <div class="ml-2">
          <CountDashboard v-bind:count="countTelahDiNilai" title="Telah Di Nilai" icon="./media/svg/files/doc.svg"
            textButton="Lihat  Belum Di Nilai" @clickData="filterBelumDiNilai"></CountDashboard>
        </div>
      </template>

      <template v-slot:Detail="{ item }">
        <!-- <v-dialog v-model="showUploadDialog" max-width="500px">
          <template v-slot:activator="{ on, attrs }">
            <v-tooltip v-if="checkStatus(item.status, 'aprove')" left>
              <template v-slot:activator="{ on, attrs }">
                <v-icon color="green" class="mr-2" v-bind="attrs" v-on="on" @click="showUploadDialog = true">
                  mdi-check-circle-outline
                </v-icon>
              </template>
              <span>Approve</span>
            </v-tooltip>
          </template>
          <v-card>
            <v-toolbar flat>
              <v-icon>mdi-file</v-icon>
              <v-toolbar-title class="font-weight-light">
                Upload Kontrak
              </v-toolbar-title>
              <v-spacer></v-spacer>
              <v-btn color="white" fab small @click="showUploadDialog = false">
                <v-icon> mdi-close </v-icon>
              </v-btn>
            </v-toolbar>
            <v-card-text>
              <v-container>
                <v-row>
                  <v-col cols="12">
                    <v-file-input show-size counter v-model="contractFile" label="Upload Kontrak"></v-file-input>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
            <v-card-actions>
              <v-spacer></v-spacer>
              <v-btn color="blue darken-1" text @click="uploadContract(item)">Simpan</v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog> -->
        <v-dialog v-model="showUploadDialog" max-width="350">
          <template v-slot:activator="{ on, attrs }">
            <v-tooltip v-if="checkStatus(item.status, 'aprove')" left>
              <template v-slot:activator="{ on, attrs }">
                <v-icon color="green" class="mr-2" v-bind="attrs" v-on="on" @click="btnAprove(item)">
                  mdi-check-circle-outline
                </v-icon>
              </template>
              <span>Approve</span>
            </v-tooltip>
          </template>
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin?</v-card-title>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="showUploadDialog = false">
                batal
              </v-btn>

              <v-btn color="green darken-1" text @click="approve(item)">
                approve
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="confirmasi" max-width="350">
          <template v-slot:activator="{ on, attrs }">
            <v-tooltip v-if="checkStatus(item.status, 'rejected')" left>
              <template v-slot:activator="{ on, attrs }">
                <v-icon color="red" class="mr-2" v-bind="attrs" v-on="on" @click="btnRejected(item)">
                  mdi-close-circle-outline
                </v-icon>
              </template>
              <span>Rejected</span>
            </v-tooltip>
          </template>
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin?</v-card-title>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasi = false">
                batal
              </v-btn>

              <v-btn color="green darken-1" text @click="reject(item)">
                reject
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <!-- <v-dialog v-model="confirmasiRevisi" max-width="350">
          <template v-slot:activator="{ on, attrs }">
            <v-tooltip v-if="checkStatus(item.status, 'revisi')" left>
              <template v-slot:activator="{ on, attrs }">
                <v-icon color="yellow" class="mr-2" v-bind="attrs" v-on="on" @click="confirmasiRevisi = true">
                  mdi-pencil-circle-outline
                </v-icon>
              </template>
              <span>Revisi</span>
            </v-tooltip>
          </template>
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin?</v-card-title>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasiRevisi = false">
                batal
              </v-btn>

              <v-btn color="green darken-1" text @click="revisi(item)">
                revisi
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="confirmasiCancel" max-width="350">
          <template v-slot:activator="{ on, attrs }">
            <v-tooltip v-if="checkStatus(item.status, 'cancel')" left>
              <template v-slot:activator="{ on, attrs }">
                <v-icon color="red" class="mr-2" v-bind="attrs" v-on="on" @click="btnCancel(item)">
                  mdi-cancel
                </v-icon>
              </template>
              <span>Cancel</span>
            </v-tooltip>
          </template>
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin?</v-card-title>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasiCancel = false">
                batal
              </v-btn>

              <v-btn color="green darken-1" text @click="cancel(item)">
                cancel
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog> -->
      </template>

      <template v-slot:detailnilai="{ item }">
        <v-icon color="success" small class="mr-2" @click="detailData(item)">
          mdi-eye
        </v-icon>
      </template>
    </CustomCard>
  </div>
</template>
<script>
import CustomCard from "@/view/content/CustomCard";
import CountDashboard from "@/view/content/CountDashboard";
import axios from "axios";

export default {
  name: "AkhirPenelitan",
  components: {
    CustomCard,
    CountDashboard,
  },
  data() {
    return {
      showUploadDialog: false,
      confirmasiCancel: false,
      confirmasiRevisi: false,
      contractFile: null,
      filterDataContentTable: [],
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
      showAdd: false,
      confirmasi: false,

      file: null,
      additionalData: {
        timReviewer: [],
      },
      headerPenilaian: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "Bobot", value: "bobot" },
        { text: "Nilai", value: "inputNilai", align: "center" },
      ],
      dataNilai: [],
      nilaiPopup: false,
      keterangan: "",

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
        { text: "Bidang Fokus", value: "bidangFokus" },
        { text: "Proposal", value: "berkas" },
        { text: "Pilih Reviewer", value: "plot_reviewer" },
        { text: "Reviewer", value: "reviewer" },
        { text: "Nilai", value: "plot_reviewer_nilai" },
        { text: "Grade", value: "rata_rata" },
        { text: "Action", value: "detail" },
      ],
      contentTables: [
      ],
    };
  },
  mounted() {
    this.filterDataContentTable = this.contentTables;
    this.fetchData();
    this.fetchReviewer();
  },
  methods: {
    fetchData() {
      // Fetch reviewer data
      const reviewerPromise = axios.get('http://localhost:8000/api/reviewer');

      // Fetch penelitian data
      const penelitianPromise = axios.get('http://localhost:8000/api/get-nilai-akhir');

      Promise.all([reviewerPromise, penelitianPromise])
        .then(([reviewerRes, penelitianRes]) => {
          console.log("API Response:", penelitianRes.data.data); // Log the API response

          // Create reviewer mapping
          const reviewerMapping = {};
          reviewerRes.data.data.forEach(reviewer => {
            reviewerMapping[reviewer.id] = reviewer.username;
          });

          this.contentTables = penelitianRes.data
            .filter(item => item.status === "Submited" || item.status === "Aproved" || item.status === "Rejected" || item.status === "Revisi")
            .map((bf, index) => {
              console.log("Current Data:", bf); // Log the current data object being mapped

              if (bf.laporanakhir === null) {
                return null; // Jika laporankemajuan null, kembalikan null
              }
              // Temukan datapenilaian untuk reviewer_1 dan reviewer_2
              let datapenilaian_reviewer_1 = bf.datapenilaian.find(item => item.user_id == bf.reviewer_1);
              let datapenilaian_reviewer_2 = bf.datapenilaian.find(item => item.user_id == bf.reviewer_2);

              let valuepenilaian_reviewer_1 = datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.valuepenilaian : [];
              let valuepenilaian_reviewer_2 = datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.valuepenilaian : [];

              let status = bf.laporanakhir.status === "waiting" ? "Empty" : bf.laporanakhir.status;
              status = status === "Aproved" ? "Aprove" : status; // Handle "Aproved" to "Approved"

              return {
                no: index + 1,
                tahun_akademik: bf.tahun_akademik,
                prodi: bf.prodi,
                nama: bf.name_user,
                judul: bf.judul,
                bidangFokus: bf.bidang_fokus,
                berkas: bf.laporanakhir.laporan_akhir,
                tipe: "akhirpenelitian",
                plot_reviewer: {
                  reviewers: [
                    {
                      id: datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.id : "",
                      nama: reviewerMapping[bf.reviewer_1],
                      nilai: datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.total : "",
                      detailNilai: {
                        dataNilai: valuepenilaian_reviewer_1,
                        keterangan: datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.catatan : ""
                      },
                    },
                    {
                      id: datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.id : "",
                      nama: reviewerMapping[bf.reviewer_2],
                      nilai: datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.total : "",
                      detailNilai: {
                        dataNilai: valuepenilaian_reviewer_2,
                        keterangan: datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.catatan : ""

                      },
                    },
                  ],
                },
                reviewer: {
                  reviewers: [
                    {
                      name: reviewerMapping[bf.reviewer_1],
                    },
                    {
                      name: reviewerMapping[bf.reviewer_2],
                    },
                  ],
                },
                status: status,
                detail: bf.id,
              };
            }).filter(item => item !== null);

          this.filterDataContentTable = this.contentTables;
        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },

    saveReviewers(item) {
      console.log('Data proposal:', item);

      if (item.reviewer_1 && item.reviewer_2) {
        axios
          .put(`http://localhost:8000/api/addreviewer-penelitian/` + item.detail, {
            reviewer_1: item.reviewer_1,
            reviewer_2: item.reviewer_2,
          })
          .then((res) => {
            console.log(res.data);
            this.fetchData();
            item.dialog = false;
          })
          .catch((error) => {
            console.error(error);
          });
      }
    },

    fetchReviewer() {
      axios
        .get('http://localhost:8000/api/reviewer')
        .then(response => {
          const reviewers = response.data.data;

          this.additionalData.timReviewer = reviewers;
          console.log(this.additionalData.timReviewer);
        })
        .catch(error => {
          console.error('Error fetching reviewers:', error);
        });
    },

    checkStatus(status, typeButton) {
      let sts = status.toLowerCase();
      if (sts == "aprove" && typeButton == "aprove") {
        return true;
      } else if (sts == "rejected" && typeButton == "rejected") {
        return true;
      } else if (sts == "revisi" && typeButton == "revisi") {
        return true;
        // } else if (
        //   (sts == "rejected" || sts == "aprove") &&
        //   typeButton == "cancel"
        // ) {
        //   return true;
      } else if (sts == "empty" && typeButton != "cancel") {
        return true;
      }
      return false;
    },

    btnAprove(item) {
      this.showUploadDialog = true;
      this.id = item.detail;
      console.log(item);
    },
    approve(item) {
      axios
        .get('http://localhost:8000/api/laporanakhir/' + this.id)
        .then((response) => {
          // Di sini, Anda dapat memproses data respons sesuai dengan kebutuhan Anda
          const data = response.data.data[0] // Misalnya, jika ID ada dalam respons
          console.log('data:', data);

          const formData = new FormData();
          formData.append("status", "aprove");

          axios
            .post("http://localhost:8000/api/update-status-akhir/" + data.id, formData, {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.fetchData();
              this.showUploadDialog = false;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    btnRejected(item) {
      this.confirmasi = true;
      this.id = item.detail;
      console.log(item);
    },
    reject(item) {
      axios
        .get('http://localhost:8000/api/laporanakhir/' + this.id)
        .then((response) => {
          // Di sini, Anda dapat memproses data respons sesuai dengan kebutuhan Anda
          const data = response.data.data[0] // Misalnya, jika ID ada dalam respons
          console.log('data:', data);

          const formData = new FormData();
          formData.append("status", "rejected");

          axios
            .post("http://localhost:8000/api/update-status-akhir/" + data.id, formData, {
              headers: {
                "Content-Type": "multipart/form-data",
              },
            })
            .then((response) => {
              this.fetchData();
              this.confirmasi = false;
            })
            .catch((error) => {
              console.log(error);
            });
        })
        .catch((error) => {
          console.log(error);
        });
    },

    // btnCancel(item) {
    //   this.confirmasiCancel = true;
    // },
    // revisi(item) {
    //   const formData = new FormData();
    //   formData.append("status", "Revisi");

    //   axios
    //     .post("http://localhost:8000/api/update-status-penelitian/" + item.detail, formData, {
    //       headers: {
    //         "Content-Type": "multipart/form-data",
    //       },
    //     })
    //     .then((response) => {
    //       this.fetchData();
    //       this.confirmasiRevisi = false;

    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },
    // cancel(item) {
    //   const formData = new FormData();
    //   formData.append("status", "Submited");

    //   axios
    //     .post("http://localhost:8000/api/update-status-penelitian/" + item.detail, formData, {
    //       headers: {
    //         "Content-Type": "multipart/form-data",
    //       },
    //     })
    //     .then((response) => {
    //       this.fetchData();
    //       this.confirmasiCancel = false;

    //     })
    //     .catch((error) => {
    //       console.log(error);
    //     });
    // },

    detailData(item) {
      this.nilaiPopup = true;
      console.log(item);
      this.dataNilai = item.detailNilai.dataNilai;
      this.keterangan = item.detailNilai.keterangan;

    },
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach(item => {
        total += item.value;
      });
      return total;
    },
    filterDataMasuk() {
      this.filterDataContentTable = this.contentTables;
    },
    filterBelumDiPlot() {
      this.filterDataContentTable = this.contentTables.filter(
        (c) =>
          (c.reviewer.reviewers[0].name == "" || c.reviewer.reviewers[0].name == null) ||
          (c.reviewer.reviewers[1].name == "" || c.reviewer.reviewers[1].name == null)
      );
    },

    filterBelumDiNilai() {
      this.filterDataContentTable = this.contentTables.filter(
        (c) =>
          c.plot_reviewer.reviewers[0].nilai == 0 ||
          c.plot_reviewer.reviewers[1].nilai == 0
      );
    },
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user
    },
    countDataMasuk() {
      return this.contentTables.length;
    },
    countTelahDiPlot() {
      let data = this.contentTables.filter(
        (c) =>
          (c.reviewer.reviewers[0].name != "" && c.reviewer.reviewers[0].name != null) ||
          (c.reviewer.reviewers[1].name != "" && c.reviewer.reviewers[1].name != null)
      );
      return data.length;
    },
    countTelahDiNilai() {
      let data = this.contentTables.filter(
        (c) =>
          c.plot_reviewer.reviewers[0].nilai != 0 &&
          c.plot_reviewer.reviewers[1].nilai != 0
      );
      return data.length;
    },
  },
};
</script>