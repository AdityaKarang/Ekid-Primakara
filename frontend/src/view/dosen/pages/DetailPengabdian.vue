<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="confirmasi" max-width="290">
        <v-card>
          <v-card-title class="headline">Apakah Anda Yakin Untuk Submit Proposal ?</v-card-title>

          <v-card-text> pastikan anda mengis data dengan benar </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="confirmasi = false">
              batal
            </v-btn>

            <v-btn color="green darken-1" text @click="onClick()
                                        confirmasi = false;
            showAdd = false;
                                        ">
              submit
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-card class="">
      <v-card-text>
        <v-form>
          <StaticView v-if="checkDisable($route.params.data.status)" :listData="setDataStatic(this.dataLaporan)">
          </StaticView>
          <!-- <h3 class="mb-4">Detail Proposal</h3> -->
          <v-row v-else>
            <!-- {{ this.$route.params.data }} -->
            <v-col md="6">
              <v-select v-model="form.tahun_akademik" :items="tahunAkademik" label="Tahun Akademik" required
                :disabled="checkDisable($route.params.data.status)"></v-select>
            </v-col>
            <v-col md="6">
              <v-select v-model="form.semester" :items="semester" label="semester" required
                :disabled="checkDisable($route.params.data.status)"></v-select>
            </v-col>
            <v-col sm="12" md="12">
              <v-text-field v-model="form.judul" label="Judul" required
                :disabled="checkDisable($route.params.data.status)"></v-text-field>
            </v-col>
            <!-- <v-col sm="12" md="12">
              <v-autocomplete
                v-model="form.anggotaDosen"
                :items="Dosen"
                dense
                filled
                item-text="name"
                item-value="name"
                label="Anggota Pengabdian Dosen"
                multiple
                :disabled="checkDisable($route.params.data.status)"
              >
                <template v-slot:selection="data">
                  <v-chip
                    v-bind="data.attrs"
                    :input-value="data.item.name"
                    close
                    @click="data.select"
                    @click:close="remove(data.item, form.anggotaDosen)"
                  >
                    <v-avatar left>
                      <v-img :src="data.item.avatar"></v-img>
                    </v-avatar>
                    {{ data.item.name }}
                  </v-chip>
                </template>
                <template v-slot:item="data">
                  <template v-if="typeof data.item !== 'object'">
                    <v-list-item-content
                      v-text="data.item"
                    ></v-list-item-content>
                  </template>
                  <template v-else>
                    <v-list-item-content>
                      <v-list-item-title
                        v-html="data.item.name"
                      ></v-list-item-title>
                      <v-list-item-subtitle
                        v-html="data.item.nidn"
                      ></v-list-item-subtitle>
                      <v-list-item-subtitle
                        v-html="data.item.jabaranFungsional"
                      ></v-list-item-subtitle>
                      <v-list-item-subtitle
                        v-html="data.item.programStudi"
                      ></v-list-item-subtitle>
                      <v-list-item-subtitle
                        v-html="data.item.noHPEmail"
                      ></v-list-item-subtitle>
                    </v-list-item-content>
                  </template>
                </template>
              </v-autocomplete>
            </v-col> -->
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
                      {{ data.item }}
                    </v-chip> -->
                </template>
                <!-- <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title v-html="data.item.nama"></v-list-item-title>
                        <v-list-item-subtitle v-html="data.item.nidn"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.jabaranFungsional"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.programStudi"></v-list-item-subtitle>
                        <v-list-item-subtitle v-html="data.item.noHPEmail"></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template> -->
              </v-autocomplete>
            </v-col>
            <v-col md="12" sm="12">
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
                      <v-col cols="12" v-if="item.jabatan_fungsional">
                        <v-text-field :value="item.jabatan_fungsional" label="Jabatan Fungsional" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12" v-if="item.prodi">
                        <v-text-field :value="item.prodi" label="Program Studi" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12" v-if="item.email">
                        <v-text-field :value="item.email" label="NO HP/Email" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12" v-if="item.falkultas">
                        <v-text-field :value="item.falkultas" label="fakultas" readonly></v-text-field>
                      </v-col>
                      <v-col cols="12" v-if="item.universitas">
                        <v-text-field :value="item.universitas" label="Universitas" readonly></v-text-field>
                      </v-col>
                    </v-row>
                  </v-expansion-panel-content>
                </v-expansion-panel>
              </v-expansion-panels>
            </v-col>
            <!-- <v-col md="12" sm="12">
              <v-autocomplete
                v-model="form.anggotaMahasiswa"
                :items="DataMahasiswa"
                dense
                filled
                item-text="name"
                item-value="name"
                label="Anggota Pengabdian Mahasiswa "
                multiple
                :disabled="checkDisable($route.params.data.status)"
              >
                <template v-slot:selection="data">
                  <v-chip
                    v-bind="data.attrs"
                    :input-value="data.item.name"
                    close
                    @click="data.select"
                    @click:close="remove(data.item, form.anggotaMahasiswa)"
                  >
                    <v-avatar left>
                      <v-img :src="data.item.avatar"></v-img>
                    </v-avatar>
                    {{ data.item.name }}
                  </v-chip>
                </template>
                <template v-slot:item="data">
                  <template v-if="typeof data.item !== 'object'">
                    <v-list-item-content
                      v-text="data.item"
                    ></v-list-item-content>
                  </template>
                  <template v-else>
                    <v-list-item-content>
                      <v-list-item-title
                        v-html="data.item.name"
                      ></v-list-item-title>
                      <v-list-item-subtitle
                        v-html="data.item.nim"
                      ></v-list-item-subtitle>
                      <v-list-item-subtitle
                        v-html="data.item.prodi"
                      ></v-list-item-subtitle>
                    </v-list-item-content>
                  </template>
                </template>
              </v-autocomplete>
            </v-col> -->
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
              <v-select :items="bidangfokuss" label="Bidang Fokus" v-model="form.bidang_fokus"
                :disabled="checkDisable($route.params.data.status)"></v-select>
            </v-col>

            <v-col cols="12">
              <v-text-field v-model="form.mitra" label="Mitra" required
                :disabled="checkDisable($route.params.data.status)"></v-text-field>
            </v-col>
            <!-- <v-row
              class="p-4 d-flex justify-content-between"
              v-for="(dana, index) in form.dana"
              :key="index"
            > -->
            <v-col cols="3">
              <v-select v-model="form.sumber_dana" :items="sumberdanas" label="Sumber Dana"
                :disabled="checkDisable($route.params.data.status)" required>
              </v-select>
            </v-col>
            <v-col cols="3">
              <v-select v-model="form.bentuk_dana" :items="bentukdanas" label="Bentuk Dana"
                :disabled="checkDisable($route.params.data.status)" required></v-select>
            </v-col>
            <v-col cols="3">
              <v-text-field v-model="form.jumlah_dana" label="Jumlah Dana"
                :disabled="checkDisable($route.params.data.status)" required></v-text-field>
            </v-col>
            <!-- <v-col cols="1" class="pt-4">
                <b-button
                  variant="success"
                  class="mt-1"
                  @click="totalKriteria++"
                  :disabled="checkDisable($route.params.data.status)"
                >
                  <i class="flaticon-plus"></i></b-button
              ></v-col>
            </v-row> -->

            <b-col cols="12">
              <v-file-input v-model="form.proposal" label="Upload Proposal" @change="handleFileUpload"
                :disabled="checkDisable($route.params.data.status)" required></v-file-input>
            </b-col>
          </v-row>

          <b-button v-if="!checkDisable($route.params.data.status)" type="button" class="mr-2" variant="success"
            :disabled="!isFormComplete || checkDisable($route.params.data.status)" @click="onDraft()
                          confirmasi = false;
            showAdd = false;">Draft</b-button>

          <b-button v-if="!checkDisable($route.params.data.status)" type="button" variant="primary"
            :disabled="!isFormComplete || checkDisable($route.params.data.status)" @click="onClick()">Submit</b-button>
        </v-form>
      </v-card-text>
    </v-card>
    <template v-if="checkStatus($route.params.data.status)">
      <div>
        <v-tabs v-model="activeTab">
          <v-tab v-for="(item, index) in proposalResults" :key="index">
            {{ item.name }}
          </v-tab>

          <v-tab-item v-for="(item, index) in proposalResults" :key="index">
            <v-card>
              <v-card-title>
                Hasil Penilaian Proposal
                <v-spacer></v-spacer>
              </v-card-title>
              <v-data-table :headers="headerPenilaian" :items="item.dataNilai" hide-default-footer>
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
                      {{ getTotalValue(item.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
            </v-card>
            <v-row class="mt-2">
              <v-col cols="12">
                <v-textarea name="input-keterangan" label="Catatan" outlined :value="proposalResults[activeTab].keterangan" disabled></v-textarea>
              </v-col>
            </v-row>
          </v-tab-item>
        </v-tabs>
      </div>
      <!-- <v-alert dense type="success"> Approved </v-alert> -->

    </template>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import StaticView from "@/view/content/Recrusive/StaticView.vue";
import axios from 'axios';


export default {
  name: "DetailPengabdian",
  components: {
    StaticView,
  },

  data() {
    return {
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
      activeTab: 0,
      proposalResults: [
        { name: 'Hasil Penilaian Reviewer 1', dataNilai: [] }, // Ganti [] dengan data penilaian pertama
        { name: 'Hasil Penilaian Reviewer 2', dataNilai: [] }  // Ganti [] dengan data penilaian kedua
      ],
      keterangan: "",
      totalKriteria: 1,
      dataStatic: [],
      dataLaporan: [],
      searchDosen: "",
      anggotaDosen: [],
      selectedDosen: [],
      anggotaMahasiswa: [],

      form: {
        pengabdians: [],
        mahasiswa_1: {},
        mahasiswa_2: {},
      },
      DataMahasiswa: [
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
          prodi: "Sistem Informasi Akuntansis",
        },
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

          nama: "Nur Rohman Ashiddiqi",
          nim: "17010100003",
          prodi: "Teknik Infomatika",
        },
      ],
      Dosen: [
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

          nama: "I Putu Satwika, S.Kom, M.Kom",

          nidn: "0801088891",
          jabatanFunsional: "rektor",
          programStudi: "Teknik Informatika",
          noHPEmail: "satwika@primakara.ac.id",
        },
        {
          avatar: "http://localhost:8080/media/users/100_2.jpg",

          nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
          nidn: "0817028803",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Sistem Informasi Akuntansi",
          noHPEmail: "aris@primakara.ac.id",
        },
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

          nama: "Putu Trisna Hadi Permana, S.Pd, M.Pd",
          nidn: "0824049101",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Teknik Informatika",
          noHPEmail: "trisna@primakara.ac.id",
        },
      ],
      jenisPublkasis: [
        { text: "Select One", value: null },
        "Buku",
        "Jurnal",
        "HKI",
        "Majalah",
        "Media Massa",
      ],
      tingkatPublikasis: [
        { text: "Select One", value: null },
        "Lokal",
        "Nasional",
        "Internasional",
      ],
      tahunAkademiks: [
        { text: "Select One", value: null },
        "2021/2022",
        "2020/2021",
        "2019/2020",
        "2018/2019",
      ],
      sumberdanas: [
        { text: "Pilih Sumber Dana", value: null },
        "Perguruan Tinggi",
        "Kemenristek",
        "Mandiri",
        "Luar Perguruan Tinggi",
      ],
      bentukdanas: [
        { text: "Pilih Bentuk Dana", value: null },
        "In-Kind",
        "In-Cash",
      ],
      bidangfokuss: [
        { text: "Pilih Bidang Fokus", value: null },
        "Techopreneur",
        "Sistem Informasi",
        "IOT",
      ],
      prodis: [
        { text: "Pilih Prodi", value: null },
        "Teknik Informatika",
        "Sistem Informasi",
        "Sistem Informasi Akuntansi",
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
        { text: "Berkas", value: "berkas" },
        { text: "Status", value: "status" },
        { text: "Detail", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Pelatihan Digital Marekting UMKM  Sokasi di Desa Tigawasa ",
          berkas: "example.pdf",
          kemajuan: {
            status: "success",
          },
          akhir: {
            status: "success",
          },
          publikasi: {
            status: "empty",
          },

          status: "Draft",
        },

        {
          no: "2",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun ",
          berkas: "example.pdf",
          kemajuan: {
            status: "success",
          },
          akhir: {
            status: "success",
          },
          publikasi: {
            status: "success",
          },

          status: "Aproved",
        },

        {
          no: "3",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Usability Testing Sistem Informasi Akademik ",
          berkas: "exmaple.pdf",
          kemajuan: {
            status: "success",
          },
          akhir: {
            status: "rejected",
          },
          publikasi: {
            status: "empty",
          },

          status: "Rejected",
        },
      ],
      headerPenilaian: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "Nilai", value: "inputNilai", align: "center" },
      ],

      dataNilai: [
        {
          no: 1,
          kriteria: "Perumusan Masalah",
          indikators: [
            {
              name: "Ketajaman Perumusan Masalah dan Tujuan",
              prefix_radio: "Ketajaman Perumusan ",
              bobot: "25",
              nilai: 0,
            },
            {
              name: "Ketajaman Perumusan Tujuan ",
              prefix_radio: "Ketajaman Tujuan ",
              bobot: "25",
              nilai: 0,
            },
          ],
        },
        {
          no: 2,
          kriteria: "Manfaat Hasil Dan Luaran",
          indikators: [
            {
              name: "Pengembangan IPTEKS",
              prefix_radio: "pengembangan ipteks ",
              bobot: "20",
              nilai: 0,
            },
            {
              name: "Pembangunan  ",
              prefix_radio: "pembangunan ",
              bobot: "20",
              nilai: 0,
            },
            {
              name: "Pengembangan Kelembagaan  ",
              prefix_radio: "pembangunan ",
              bobot: "20",
              nilai: 0,
            },
            {
              name: "Luaran Sesuai IKUP  ",
              prefix_radio: "pembangunan ",
              bobot: "20",
              nilai: 0,
            },
          ],
        },
        {
          no: 3,
          kriteria: "Tinjauan Pustaka",
          indikators: [
            {
              name: "Relevansi",
              prefix_radio: "pengembangan ipteks ",
              bobot: "15",
              nilai: 0,
            },
            {
              name: "Kemuktahiran  ",
              prefix_radio: "pembangunan ",
              bobot: "15",
              nilai: 0,
            },
            {
              name: "Penyusunan Daftar Pustaka  ",
              prefix_radio: "pembangunan ",
              bobot: "15",
              nilai: 0,
            },
          ],
        },
        {
          no: 4,
          kriteria: "Metode",
          indikators: [
            {
              name: "Ketepatan Metode Yang Digunakan",
              prefix_radio: "pengembangan ipteks ",
              bobot: "30",
              nilai: 0,
            },
          ],
        },
        {
          no: 5,
          kriteria: "Unsur Penunjang",
          indikators: [
            {
              name: "Kesesuaian Jadwal",
              prefix_radio: "pengembangan ipteks ",
              bobot: "10",
              nilai: 0,
            },
            {
              name: "Kesesuaian Keahlian Personalia dan Kewajaran Biaya",
              prefix_radio: "pengembangan ipteks ",
              bobot: "10",
              nilai: 0,
            },
          ],
        },
      ],
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user
    },
    isFormComplete() {
      return (
        this.form.tahun_akademik &&
        this.form.semester &&
        this.form.judul &&
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
  },
  mounted() {
    this.fetchData();
    this.fetchBidangFokus();
    this.fetchSumberDana();
    this.fetchBentukDana();
    this.fetchDataDosen();
    this.getDataNilai();
    this.fetchDataMahasiswa();
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Detail Proposal Pengabdian" },
    ]);
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
    getDataNilai(index) {
      // Fetch reviewer data
      const item = this.$route.params.data
      const reviewerPromise = axios.get('http://localhost:8000/api/reviewer');

      // Fetch penelitian data
      const penelitianPromise = axios.get('http://localhost:8000/api/show-nilai-pengabdian/' + item.detail);

      Promise.all([reviewerPromise, penelitianPromise])
        .then(([reviewerRes, penelitianRes]) => {
          console.log("API Response:", penelitianRes.data); // Log the API response

          // Create reviewer mapping
          const reviewerMapping = {};
          reviewerRes.data.data.forEach(reviewer => {
            reviewerMapping[reviewer.id] = reviewer.username;
          });

          const newDataNilai = penelitianRes.data
            .map((bf, index) => {
              console.log("Current Data:", bf); // Log the current data object being mapped

              // Temukan datapenilaian untuk reviewer_1 dan reviewer_2
              let datapenilaian_reviewer_1 = bf.datapenilaian.find(item => item.user_id == bf.reviewer_1);
              let datapenilaian_reviewer_2 = bf.datapenilaian.find(item => item.user_id == bf.reviewer_2);

              let valuepenilaian_reviewer_1 = datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.valuepenilaian : [];
              let valuepenilaian_reviewer_2 = datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.valuepenilaian : [];
              let catatan_reviewer_1 = datapenilaian_reviewer_1 ? datapenilaian_reviewer_1.catatan : ""
              let catatan_reviewer_2 = datapenilaian_reviewer_2 ? datapenilaian_reviewer_2.catatan : ""

              return {
                dataNilai1: valuepenilaian_reviewer_1,
                dataNilai2: valuepenilaian_reviewer_2,
                catatan1: catatan_reviewer_1,
                catatan2: catatan_reviewer_2
              };
            });

          // Set dataNilai pada proposalResults
          this.$set(this.proposalResults[0], 'dataNilai', newDataNilai[0].dataNilai1);
          this.$set(this.proposalResults[1], 'dataNilai', newDataNilai[0].dataNilai2);
          this.$set(this.proposalResults[0], 'keterangan', newDataNilai[0].catatan1);
          this.$set(this.proposalResults[1], 'keterangan', newDataNilai[0].catatan2);

        })
        .catch(error => {
          console.error('Error fetching data:', error);
        });
    },
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach(item => {
        total += item.value;
      });
      return total;
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
      axios.get('http://localhost:8000/api/bidangfokus')
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
      axios.get('http://localhost:8000/api/bentukdana')
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

    fetchData() {
      const item = this.$route.params.data
      // Fetch the main data for the proposal
      axios.get('http://localhost:8000/api/pengabdian/' + item.detail)
        .then((response) => {
          console.log("detail:", response.data.data); // Log the API response

          // Assign the fetched data to the dataLaporan object
          this.dataLaporan = response.data.data
          this.form.judul = response.data.data.judul;
          this.form.tahun_akademik = response.data.data.tahun_akademik;
          this.form.semester = response.data.data.semester;
          this.form.mitra = response.data.data.mitra;
          this.form.bidang_fokus = response.data.data.bidang_fokus;
          this.form.sumber_dana = response.data.data.sumber_dana;
          this.form.bentuk_dana = response.data.data.bentuk_dana;
          this.form.jumlah_dana = response.data.data.jumlah_dana;
          // this.form.proposal =  this.form.proposal = new File(["example.pdf"], response.data.data.proposal, { type: "application/pdf" });


          // Fetch additional data for anggota_dosen_1
          axios.get('http://localhost:8000/api/anggotadosen/' + this.dataLaporan.anggota_dosen_1)
            .then((response) => {
              console.log("Anggota Dosen 1 Data:", response.data); // Log the API response for anggota_dosen_1

              // Assign the fetched data to the anggota_dosen_1 object
              this.dataLaporan.anggota_dosen_1 = response.data;

              this.anggotaDosen.push(response.data);

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

              this.anggotaDosen.push(response.data);

            })
            .catch((error) => {
              console.error(error);
            });
          // Fetch additional data for mahasiswa_1
          axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_1)
            .then((response) => {
              console.log("Mahasiswa 1 Data:", response.data); // Log the API response for anggota_dosen_2

              this.dataLaporan.mahasiswa_1 = response.data;

              this.form.mahasiswa_1 = response.data.id;
              console.log("Mahasiswa 1 Form Field:", this.form.mahasiswa_1);


            })
            .catch((error) => {
              console.error(error);
            });
          axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_2)
            .then((response) => {
              this.dataLaporan.mahasiswa_2 = response.data;
              this.form.mahasiswa_2 = response.data.id;

            })
            .catch((error) => {
              console.error(error);
            });
        })
        .catch((error) => {
          console.error(error);
        });
    },
    handleFileUpload(file) {
      this.form.proposal = file; // Simpan file yang diunggah ke dalam data form

      // Optional: Tampilkan informasi file yang diunggah
      console.log("File Name:", file.name);
      console.log("File Size:", file.size);
      console.log("File Type:", file.type);
    },
    onClick() {
      // console.log(this.anggotaDosen);

      const item = this.$route.params.data.detail;

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
      formData.append("sumber_dana", this.form.sumber_dana);
      formData.append("bentuk_dana", this.form.bentuk_dana);
      formData.append("jumlah_dana", this.form.jumlah_dana);
      formData.append("bidang_fokus", this.form.bidang_fokus);
      formData.append("status", "Submited");
      formData.append("proposal", this.form.proposal);
      formData.append("user_id", this.currentUser.id);

      axios.post('http://localhost:8000/api/pengabdian/' + item, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
        .then((response) => {
          this.$router.push({
            path: "/dosen/pengabdian",
          });
        })
        .catch((error) => {
          console.log(error);
        });
    },
    onDraft() {
      // console.log(this.anggotaDosen);

      const item = this.$route.params.data.detail;

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
      formData.append("sumber_dana", this.form.sumber_dana);
      formData.append("bentuk_dana", this.form.bentuk_dana);
      formData.append("jumlah_dana", this.form.jumlah_dana);
      formData.append("bidang_fokus", this.form.bidang_fokus);
      formData.append("status", "Draft");
      formData.append("proposal", this.form.proposal);
      formData.append("user_id", this.currentUser.id);

      axios.post('http://localhost:8000/api/pengabdian/' + item, formData, {
        headers: {
          "Content-Type": "multipart/form-data",
        },
      })
        .then((response) => {
          this.$router.push({
            path: "/dosen/pengabdian",
          });
        })
        .catch((error) => {
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
    // detailData(item) {
    //   this.$router.push({
    //     name: "detail-penelitian",
    //     params: { data: item },
    //   });
    // },
    addNew(value) {
      this.showAdd = value;
    },

    // onConfirmation() {
    //   this.$router.push({
    //     path: "/dosen/pengabdian",
    //   });
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
    checkDisable(status) {
      if (status == "Rejected" || status == "Aproved" || status == "Submited") {
        return true;
      } else {
        return false;
      }
    },
    checkStatus(status) {
      if (status == "Rejected" || status == "Aproved") {
        return true;
      } else {
        return false;
      }
    },

    dataArray(ar) {
      let newAr = [];
      if (!ar) return [];
      ar.forEach((e) => {
        newAr.push({ label: "Sumber Dana", value: e.sumberDana });
        newAr.push({ label: "Bentuk Dana", value: e.bentukDana });
        newAr.push({ label: "Jumlah Dana", value: e.jumlahDana });
      });
      return newAr;
    },
    // dataDosenArray(ar) {
    //   let newAr = [];
    //   if (!ar) return [];
    //   ar.forEach((e, i) => {
    //     newAr.push({
    //       label: "Nama Anggota " + (i + 1),
    //       value: e.nama,
    //     });
    //     newAr.push({
    //       label: "NIDN  ",
    //       value: e.nidn,
    //     });
    //     newAr.push({
    //       label: "Jabatan Fungsional  ",
    //       value: e.jabatanFungsional,
    //     });
    //     newAr.push({
    //       label: "Program Studi ",
    //       value: e.programStudi,
    //     });
    //     newAr.push({
    //       label: "NO HP/Email  ",
    //       value: e.noHPEmail,
    //     });
    //   });
    //   return newAr;
    // },

    dataDosenArray(ar) {
      let newAr = [];
      if (!Array.isArray(ar)) return [];
      ar.forEach((e, i) => {
        newAr.push(
          {
            label: "Anggota Dosen " + (i + 1),
            value: e.name,
          },
          {
            isSpace: true,
            label: "NIDN",
            value: e.nidn,
          },
          {
            isSpace: true,
            label: "Jabatan Fungsional",
            value: e.jabatan_fungsional,
          },
          {
            isSpace: true,
            label: "Program Studi",
            value: e.prodi,
          },
          {
            isSpace: true,
            label: "NO HP/Email",
            value: e.email,
          }
        );
      });
      return newAr;
    },

    dataMahasiswaArray(ar) {
      let newAr = [];
      if (!ar) return [];
      ar.forEach((e, i) => {
        newAr.push({
          label: "Anggota Mahasiswa " + (i + 1),
          value: e.name,
        });
        newAr.push({
          label: "NIM",
          value: e.nim,
        });
        newAr.push({
          label: "Prodi ",
          value: e.prodi,
        });
      });
      return newAr;
    },

    setDataStatic(data) {
      let dt = [
        {
          label: "Judul",
          value: data.judul,
        },
        {
          label: "Tahun Akademik",
          value: data.tahun_akademik,
        },
        {
          label: "Semester",
          value: data.semester,
        },
        {
          children: this.dataDosenArray([data.anggota_dosen_1, data.anggota_dosen_2]),
        },
        {
          children: this.dataMahasiswaArray([data.mahasiswa_1, data.mahasiswa_2]),
        },
        {
          label: "Mitra",
          value: data.mitra,
        },
        {
          label: "Bidang Fokus",
          value: data.bidang_fokus,
        },
        {
          label: "Sumber Dana",
          value: data.sumber_dana,
        },
        {
          label: "Bentuk Dana",
          value: data.bentuk_dana,
        },
        {
          label: "Jumlah dana",
          value: data.jumlah_dana,
        },
        {
          label: "Proposal",
          value: data.proposal,
        },

      ];

      return dt;
    },
  },

};
</script>

