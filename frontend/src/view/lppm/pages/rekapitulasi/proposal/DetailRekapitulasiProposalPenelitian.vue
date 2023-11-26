<template>
  <div>
    <v-card class="">
      <v-card-text>
        <v-form>
          <table>
            <tbody>
              <tr>
                <td>
                  <h5>Tahun Akademik</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.tahun_akademik }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Semester</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.semester }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Judul</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.judul }}</h5>
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
                <td>
                  <h5>Bidang Fokus</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.bidang_fokus }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Mitra</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.mitra }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Sumber Dana</h6>
                </td>
                <td>
                  <h6>: {{ dataLaporan.sumber_dana }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Bentuk Dana</h6>
                </td>
                <td>
                  <h6>: {{ dataLaporan.bentuk_dana }}</h6>
                </td>
              </tr>
              <tr>
                <td>
                  <h6>Jumlah Dana</h6>
                </td>
                <td>
                  <h6>: Rp.{{ dataLaporan.jumlah_dana }}</h6>
                </td>
              </tr>
              <tr class="mt-2">
                <td>
                  <h5>Laporan Proposal</h5>
                </td>
                <td>
                  <h5>
                    <a v-if="dataLaporan.proposal !== ''" :href="getUrl(dataLaporan.proposal)"
                      target="__blank">
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.proposal }}
                    </a>
                    <div v-else>: File Tidak Tersedia</div>
                  </h5>
                </td>
              </tr>
            </tbody>
          </table>
        </v-form>
      </v-card-text>
    </v-card>
    <template v-if="checkDisable($route.params.item.status)">
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
import axios from 'axios';

export default {
  name: "InputPenelitian",
  data() {
    return {
      activeTab: 0,
      proposalResults: [
        { name: 'Hasil Penilaian Reviewer 1', dataNilai: [] }, // Ganti [] dengan data penilaian pertama
        { name: 'Hasil Penilaian Reviewer 2', dataNilai: [] }  // Ganti [] dengan data penilaian kedua
      ],
      keterangan: "",
      totalKriteria: 1,
      form: {
        tahunAkademik: "2020/2021",
        semester: "Ganjil",
        judul: "",
        bidangFokus: "",
        mitra: "",
        dana: [
          {
            sumberDana: "",
            bentukDana: "",
            jumlahDana: "",
          },
        ],

        jenisPublkasi: "",
        tingkatPublikasi: "",
        anggotaDosen: [
          "I Putu Satwika, S.Kom, M.Kom",
          "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        ],
        anggotaMahasiswa: [
          "Yurina Anggela Oktaviana",
          "Ni Luh Gede Devi Darnita",
          "Nur Rohman Ashiddiqi",
        ],
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
      dataLaporan: {
        // tahunAkademik: "2020/2021",
        // semester: "Ganjil",
        // judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
        // bidangFokus: "IOT",
        // mitra: "ITB",
        // dana: [
        //   {
        //     sumberDana: "Luar Perguruan Tinggi",
        //     bentukDana: "In-Cash",
        //     jumlahDana: 3000000,
        //   },
        // ],

        // jenisPublkasi: "jenis publiaksi",
        // tingkatPublikasi: "tingkatan publikasi",
        // anggotaDosen: [
        //   {
        //     nama: "I Putu Satwika, S.Kom, M.Kom",
        //     nidn: "0801088891",
        //     jabatanFungsional: "rektor",
        //     programStudi: "Teknik Informatika",

        //     noHPEmail: "satwika@primakara.ac.id",
        //   },
        //   {
        //     nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
        //     nidn: "0817028803",
        //     jabatanFungsional: "Tenaga Pengajar",
        //     programStudi: "Sistem Informasi Akuntansi",
        //     noHPEmail: "aris@primakara.ac.id",
        //   },
        // ],
        // anggotaMahasiswa: [
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
        //     prodi: "Sistem Informasi",
        //   },
        //   {
        //     avatar: "http://localhost:8080/media/users/100_1.jpg",

        //     nama: "Nur Rohman Ashiddiqi",
        //     nim: "17010100003",
        //     prodi: "Sistem Informasi ",
        //   },
        // ],
        // proposal: "example.pdf",
        // fileNameKemajuan: "example.pdf",
        // fileNameAkhir: "example.pdf",
        // fileNamePublikasi: "",
      },

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

      ],
      headerPenilaian: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        { text: "Indikator Penilaian", value: "indikator" },
        { text: "Nilai", value: "inputNilai" },
      ],

    };
  },
  mounted() {
    this.fetchData();
    this.getDataNilai();
    console.log(this.$route.item);
    this.$route.params.item.status = false;
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Detail Rekapitulasi Proposal " },
    ]);
  },
  methods: {
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

    getUrl(laporanFilename) {
    if (laporanFilename !== '') {
      return `http://localhost:8000/storage/penelitian/proposal/${laporanFilename}`;
    } else {
      return null; // or any default link if the filename is empty
    }
  },

    getDataNilai(index) {
      // Fetch reviewer data
      const item = this.$route.params.item
      const reviewerPromise = axios.get('http://localhost:8000/api/reviewer');

      // Fetch penelitian data
      const penelitianPromise = axios.get('http://localhost:8000/api/show-nilai-penelitian/' + item.aksi);

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
          console.log(catatan1);

        })
        .catch(error => {
          console.error('Error fetching data:', error);
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
        name: "detail-penelitian",
        params: { data: item },
      });
    },
    addNew(value) {
      this.showAdd = value;
    },
    onClick() {
      this.confirmasi = true;
    },
    onConfirmation() {
      this.$router.push({
        path: "/dosen/penelitian",
      });
    },
    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
    checkDisable(status) {
      return true;
      if (status == "rejected" || status == "aproved") {
        return true;
      } else {
        return false;
      }
    },
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach(item => {
        total += item.value;
      });
      return total;
    },
  },
};
</script>
