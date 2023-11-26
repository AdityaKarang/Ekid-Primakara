<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="confirmasi" max-width="290">
        <v-card>
          <v-card-title class="headline">Apakah Anda Yakin ?</v-card-title>

          <v-card-text> pastikan anda mengisi data dengan benar </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="confirmasi = false">
              Batal
            </v-btn>

            <v-btn color="green darken-1" text @click="simpanData()">
              Simpan
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>

    <v-card>
      <v-card-text>
        <v-row>
          <v-col cols="12" md="5">
            <v-form>
              <table>
                <tbody>
                  <tr>
                    <td><h6>Tahun Akademik</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.tahun_akademik }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Semester</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.semester }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Judul</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.judul }}</h6>
                    </td>
                  </tr>
                  <template v-for="(dosen, index) in [dataLaporan.anggota_dosen_1, dataLaporan.anggota_dosen_2]">
                    <tr :key="index">
                      <td>
                        <h6>Anggota Dosen {{ index + 1 }}</h6>
                      </td>
                      <td>
                        <h6>: {{ dosen.name }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">NIDN</h6>
                      </td>
                      <td>
                        <h6>: {{ dosen.nidn }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">Jabatan Fungsional</h6>
                      </td>
                      <td>
                        <h6>: {{ dosen.jabatan_fungsional }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">Program Studi</h6>
                      </td>
                      <td>
                        <h6>: {{ dosen.prodi }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">Email</h6>
                      </td>
                      <td>
                        <h6>: {{ dosen.email }}</h6>
                      </td>
                    </tr>
                  </template>
                  <template v-for="(mahasiswa, index) in [dataLaporan.mahasiswa_1, dataLaporan.mahasiswa_2]">
                    <tr :key="index">
                      <td>
                        <h6>Anggota Mahasiswa {{ index + 1 }}</h6>
                      </td>
                      <td>
                        <h6>: {{ mahasiswa.name }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">NIM</h6>
                      </td>
                      <td>
                        <h6>: {{ mahasiswa.nim }}</h6>
                      </td>
                    </tr>
                    <tr>
                      <td>
                        <h6 class="ml-3">Program Studi</h6>
                      </td>
                      <td>
                        <h6>: {{ mahasiswa.prodi }}</h6>
                      </td>
                    </tr>
                  </template>
                  <tr class="mt-2">
                    <td><h6>Bidang Fokus</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.bidang_fokus }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Mitra</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.mitra }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Sumber Dana</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.sumber_dana }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Bentuk Dana</h6></td>
                    <td>
                      <h6>: {{ dataLaporan.bentuk_dana }}</h6>
                    </td>
                  </tr>
                  <tr>
                    <td><h6>Jumlah Dana</h6></td>
                    <td>
                      <h6>: Rp.{{ dataLaporan.jumlah_dana }}</h6>
                    </td>
                  </tr>                  
                  <!-- <template v-for="(dana, index) in dataLaporan.dana">
                    <tr :key="index + '_sumberdana'">
                      <td><h6>Sumber Dana</h6></td>
                      <td>
                        <h6>: {{ dana.sumberDana }}</h6>
                      </td>
                    </tr>
                    <tr :key="index + '_bentukdana'">
                      <td><h6>Bentuk Dana</h6></td>
                      <td>
                        <h6>: {{ dana.bentukDana }}</h6>
                      </td>
                    </tr>
                    <tr :key="index + '_jumlahdana'">
                      <td><h6>Jumlah Dana</h6></td>
                      <td>
                        <h6>: Rp.{{ dana.jumlahDana }}</h6>
                      </td>
                    </tr>
                  </template> -->
                </tbody>
              </table>
            </v-form>
          </v-col>
          <v-col cols="12" md="7">
            <iframe
              :src="getProposalUrl(dataLaporan.laporankemajuan.laporan_kemajuan)"
              frameborder="1"
              width="100%"
              height="500px"
            ></iframe>
          </v-col>
        </v-row>
      </v-card-text>
    </v-card>
    <v-card class="mt-2">
      <v-card-title> Form Penilaian </v-card-title>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header>
            {{ titlePenilaian }}
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-data-table
              :headers="headerPenilaian"
              :items="dataNilai"
              item-class="p-0"
              hide-default-footer
            >
              <template slot="item" slot-scope="props">
                <template v-for="(indikator, i) in props.item.indikators">
                  <tr :key="i + '_' + indikator.name">
                    <td
                      class="text-start"
                      v-if="i == 0"
                      :rowspan="props.item.indikators.length"
                    >
                      {{ props.item.no }}
                    </td>
                    <td
                      class="text-start"
                      v-if="i == 0"
                      :rowspan="props.item.indikators.length"
                    >
                      {{ props.item.kriteria }}
                    </td>
                    <td>{{ indikator.name }}</td>
                    <td>{{ indikator.bobot }}</td>
                    <td>
                      <v-radio-group
                        v-model="indikator.nilai"
                        style="font-size: 12px"
                        row
                      >
                        <tr>
                          <td>
                            <v-radio
                              label="4"
                              color="green"
                              value="4"
                              size="sm"
                              
                            ></v-radio>
                            <label for="" class="mr-6" width="60px">
                              {{ indikator.prefix_radio }} Sangat Baik</label
                            >
                          </td>
                          <td>
                            <v-radio
                              label="3"
                              color="indigo"
                              value="3"
                              
                            ></v-radio>
                            <label for="" class="mr-6" width="60px">
                              {{ indikator.prefix_radio }} Baik</label
                            >
                          </td>
                          <td>
                            <v-radio
                              label="2"
                              color="indigo"
                              value="2"
                              class="ml-6"
                              
                            ></v-radio>
                            <label for="" class="ml-6" width="60px">
                              {{ indikator.prefix_radio }} Cukup</label
                            >
                          </td>
                          <td>
                            <v-radio
                              label="1"
                              color="orange"
                              value="1"
                              class="ml-6"
                              
                            ></v-radio>
                            <label for="" class="ml-6" width="60px">
                              {{ indikator.prefix_radio }} Kurang</label
                            >
                          </td>
                          <td>
                            <v-radio
                              label="0"
                              color="red"
                              value="0"
                              class="ml-6"
                              
                            ></v-radio>
                            <label for="" class="ml-6" width="60px">
                              {{ indikator.prefix_radio }} Sangat Kurang
                            </label>
                          </td>
                        </tr>
                      </v-radio-group>
                    </td>
                    <!-- <v-text-field v-model="item.nilai" type="number"></v-text-field> -->
                  </tr>
                </template>
              </template>

              <template slot="body.append">
                <tr>
                  <th colspan="4" class="text-end"><h4>Total</h4></th>
                  <th>
                    <h4>{{ getTotalValue(dataNilai) }}</h4>
                  </th>
                </tr>
              </template>
            </v-data-table>

            <v-row class="mt-2">
              <v-col cols="12">
                <v-textarea
                  name="input-catatan"
                  label="Catatan"
                  outlined
                  v-model="inputCatatan"
                  value=""
                ></v-textarea>
              </v-col>
              <v-col cols="12">
                <div class="float-right">
                  <div class="my-2">
                    <v-btn
                      small
                      class="mr-2"
                      color="success"
                      @click="confirmasi = true"
                      :disabled="isSaveDisabled"
                      >Save</v-btn
                    >
                  </div>
                  <div class="my-2"></div>
                </div>
              </v-col>
            </v-row>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card>
  </div>
</template>
<style >
.v-label {
  font-size: 12px;
}
</style>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import axios from 'axios';

export default {
  name: "DetailLaporanPenelitian",
  data() {
    return {
      confirmasi: false,
      dataLaporan: 
      {

      },
      indikator: {
        nilai: null, // Inisialisasi nilai dengan null
        prefix_radio: 'Prefix' // Ganti dengan nilai prefix Anda
      },
      dataArray: [
        
      ], // Inisialisasi array untuk menyimpan data

      titlePenilaian: "Proposal",
      inputCatatan: "",
      headerPenilaian: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "Bobot" },
        { text: "Nilai", value: "inputNilai", align: "center" },
      ],
      proposalValue:[
          {
                kriteria_penilaian_id: "",
                value: "",
         },
      ],
      dataNilai: [
            // {
            //     kriteria_penilaian_id: "",
            //     value: "",
            // },
            // {
            //     kriteria_penilaian_id: "",
            //     penelitian_id: "",
            //     pengabdian_id:"" ,
            //     user_id: "",
            //     value: "",
            //     total: "",
            //     catatan: "",
            // },
            // {
            //     kriteria_penilaian_id: "",
            //     penelitian_id: "",
            //     pengabdian_id:"" ,
            //     user_id: "",
            //     value: "",
            //     total: "",
            //     catatan: "",
            // },
            // {
            //     kriteria_penilaian_id: "",
            //     penelitian_id: "",
            //     pengabdian_id:"" ,
            //     user_id: "",
            //     value: "",
            //     total: "",
            //     catatan: "",
            // },
            // {
            //     kriteria_penilaian_id: "",
            //     penelitian_id: "",
            //     pengabdian_id:"" ,
            //     user_id: "",
            //     value: "",
            //     total: "",
            //     catatan: "",
            // },

        ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Form Penilaian" }]);
    console.log(this.$route.params.item);
    this.titlePenilaian = this.$route.params.tabName;
    console.log(this.titlePenilaian);
    console.log(this.currentUser);
    this.fetchData();
    this.fetchPenilaianProposal();

  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user
    },
    isSaveDisabled() {
    return this.dataNilai.some(item =>
      item.indikators.some(indikator => indikator.nilai === undefined)
    ) || !this.inputCatatan;
  },
  },
  methods: {
    getProposalUrl(berkas) {
      const baseUrl = "http://localhost:8000/storage/penelitian/laporan/";
      return baseUrl + berkas;
    }, 
    fetchData() {
  const item = this.$route.params.item;

  // Fetch the main data for the proposal
  axios.get('http://localhost:8000/api/penelitian/' + item.aksi)
    .then((response) => {
      console.log("API Response:", response.data.data); // Log the API response

      // Assign the fetched data to the dataLaporan object
      this.dataLaporan = response.data.data;

      // Fetch additional data for anggota_dosen_1
      axios.get('http://localhost:8000/api/anggotadosen/' + this.dataLaporan.anggota_dosen_1)
        .then((response) => {
          console.log("Anggota Dosen 1 Data:", response.data); // Log the API response for anggota_dosen_1

          // Assign the fetched data to the anggota_dosen_1 object
          this.dataLaporan.anggota_dosen_1 = response.data;
        })
        .catch((error) => {
          console.error(error);
        });

      // Fetch additional data for anggota_dosen_2
      axios.get('http://localhost:8000/api/anggotadosen/' + this.dataLaporan.anggota_dosen_2)
        .then((response) => {
          console.log("Anggota Dosen 2 Data:", response.data); // Log the API response for anggota_dosen_2

          // Assign the fetched data to the anggota_dosen_2 object
          this.dataLaporan.anggota_dosen_2 = response.data;
        })
        .catch((error) => {
          console.error(error);
        });
        axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_1)
            .then((response) => {
              this.dataLaporan.mahasiswa_1 = response.data;
            })
            .catch((error) => {
              console.error(error);
            });
          axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_2)
            .then((response) => {
              this.dataLaporan.mahasiswa_2 = response.data;
            })
            .catch((error) => {
              console.error(error);
            });
    })
    .catch((error) => {
      console.error(error);
    });
},

fetchPenilaianProposal() {
    axios.get("http://localhost:8000/api/kriteria-penilaian/")
      .then(response => {
        // Menangani respons dari API jika diperlukan
        console.log(response.data);
        // Mengubah format data yang diterima ke format yang sesuai dengan struktur contentTables
        this.dataNilai = response.data
        .filter(item => item.type === "kemajuan")
        .map((item, index) => ({
          no: (index + 1).toString(),
          kriteria: item.kriteria,
          detail: item.id,
          indikators: item.indikator_penilaians.map(indikator => ({
            name: indikator.indikator,
            bobot: indikator.bobot.toString(),
            nilai: 0
          
          }))
         
        }));
      })
      .catch(error => {
        // Menangani error jika terjadi
        console.error(error);
      });
  },

    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach((value) => {
        let total_indikators = 0;
        console.log(value);
        if (!value.indikators) return;
        value.indikators.forEach((val) => {
          total_indikators += Number(val.nilai);
        });
        total += total_indikators;
      });
      return total;
    },

    
    simpanData() {
  const data = {
    dataPenilaian: {
      penelitian_id: this.dataLaporan.id,
      user_id: this.currentUser.id,
      status: "Selesai",
      total: this.getTotalValue(this.dataNilai),
      catatan: this.inputCatatan,
      jenis: "Kemajuan",
    },
    nilaiPenilaian: this.dataNilai.flatMap(item =>
      item.indikators.map(indikator => ({
        kriteria_penilaian_id: item.detail,
        kriteria: item.kriteria,
        indikator: indikator.name,
        bobot: indikator.bobot,
        value: indikator.nilai
      }))
    )
  };

  // Kirim data ke server
  axios.post('/add-data-penilaian', data)
    .then(response => {
      console.log('Data saved successfully!', response.data);
      this.$router.push({
      name: "review",
    }); 
      })
    .catch(error => {
      console.error('Error saving data:', error);
      // Handle error saat menyimpan data
    });
}
  },
};
</script>