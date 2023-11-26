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
                    <a v-if="dataLaporan.proposal !== ''" :href="getUrlProposal(dataLaporan.proposal)" target="__blank">
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.proposal }}
                    </a>
                    <div v-else>: File Tidak Tersedia</div>
                  </h5>
                </td>
              </tr>
              <tr class="mt-2">
                <td>
                  <h5>Laporan Kemajuan</h5>
                </td>
                <td>
                  <h5>
                    <a v-if="dataLaporan.laporankemajuan.laporan_kemajuan !== ''"
                      :href="getUrlLaporan(dataLaporan.laporankemajuan.laporan_kemajuan)" target="__blank">
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.laporankemajuan.laporan_kemajuan }}
                    </a>
                    <div v-else>: File Tidak Tersedia</div>
                  </h5>
                </td>
              </tr>
              <tr class="mt-2">
                <td>
                  <h5>Laporan Akhir</h5>
                </td>
                <td>
                  <h5>
                    <a v-if="dataLaporan.laporanakhir.laporan_akhir !== ''"
                      :href="getUrlLaporan(dataLaporan.laporanakhir.laporan_akhir)" target="__blank">
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.laporanakhir.laporan_akhir }}
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
    <v-card class="mt-2">
      <v-card-title> Publikasi</v-card-title>
      <ListPublikasi :dataList="datalistPublikasi"></ListPublikasi>
    </v-card>
    <!-- <v-card>
      <v-card-title>
        Hasil Penilaian Input
        <v-spacer></v-spacer>
      </v-card-title>
      <v-data-table
        :headers="headerPenilaianInput"
        :items="dataNilaiInput"
        hide-default-footer
      >
        <template slot="item" slot-scope="props">
          <template v-for="(indikator, i) in props.item.indikators">
            <tr :key="i">
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
                {{ indikator.nilai }}
              </td>
            </tr>
          </template>
        </template>

        <template slot="body.append">
          <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>
              {{ getTotalValue(dataNilaiInput) }}
            </th>
          </tr>
        </template>
      </v-data-table>
    </v-card>
    <v-card>
      <v-card-title>
        Hasil Penilaian Output
        <v-spacer></v-spacer>
      </v-card-title>
      <v-data-table
        :headers="headerPenilaianOutput"
        :items="dataNilaiOutput"
        hide-default-footer
      >
        <template slot="item" slot-scope="props">
          <template v-for="(indikator, i) in props.item.indikators">
            <tr :key="i">
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
                {{ indikator.nilai }}
              </td>
            </tr>
          </template>
        </template>

        <template slot="body.append">
          <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>
              {{ getTotalValue(dataNilaiOutput) }}
            </th>
          </tr>
        </template>
      </v-data-table>
    </v-card>
    <v-card>
      <v-card-title>
        Hasil Penilaian Final
        <v-spacer></v-spacer>
      </v-card-title>
      <v-data-table
        :headers="headerPenilaianFinal"
        :items="dataNilaiFinal"
        hide-default-footer
      >
        <template slot="item" slot-scope="props">
          <template v-for="(indikator, i) in props.item.indikators">
            <tr :key="i">
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
                {{ indikator.nilai }}
              </td>
            </tr>
          </template>
        </template>

        <template slot="body.append">
          <tr>
            <th colspan="4" class="text-end">Total</th>
            <th>
              {{ getTotalValue(dataNilaiFinal) }}
            </th>
          </tr>
        </template>
      </v-data-table>
    </v-card> -->
  </div>
</template>
<script>
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import axios from 'axios';

export default {
  name: "InputPenelitian",
  components: {
    ListPublikasi,
  },

  data() {
    return {
      datalistPublikasi: [],
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
        tahunAkademik: "2020/2021",
        semester: "Ganjil",
        judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
        bidangFokus: "IOT",
        mitra: "ITB",
        dana: [
          {
            sumberDana: "Luar Perguruan Tinggi",
            bentukDana: "In-Cash",
            jumlahDana: 3000000,
          },
        ],

        jenisPublkasi: "jenis publiaksi",
        tingkatPublikasi: "tingkatan publikasi",
        anggotaDosen: [
          {
            nama: "I Putu Satwika, S.Kom, M.Kom",
            nidn: "0801088891",
            jabatanFungsional: "rektor",
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
        fileNameProposal: "example.pdf",
        fileNameKemajuan: "example.pdf",
        fileNameAkhir: "example.pdf",
        fileNamePublikasi: "",
      },

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      file: null,
      headerPenilaianInput: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "bobot", value: "bobot" },
        { text: "Nilai", value: "inputNilai" },
      ],

      dataNilaiInput: [
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
              name: "indikator 2 ",
              prefix_radio: "indikator 2 ",
              bobot: "25",
              nilai: 0,
            },
          ],
        },
      ],
      headerPenilaianOutput: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "bobot", value: "bobot" },
        { text: "Nilai", value: "inputNilai" },
      ],

      dataNilaiOutput: [
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
              name: "indikator 2 ",
              prefix_radio: "indikator 2 ",
              bobot: "25",
              nilai: 0,
            },
          ],
        },
      ],
      headerPenilaianFinal: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "bobot", value: "bobot" },
        { text: "Nilai", value: "inputNilai" },
      ],

      dataNilaiFinal: [
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
              name: "indikator 2 ",
              prefix_radio: "indikator 2 ",
              bobot: "25",
              nilai: 0,
            },
          ],
        },
      ],
    };
  },
  methods: {
    fetchData() {
      const item = this.$route.params.data;

      // Fetch the main data for the proposal
      axios.get('http://localhost:8000/api/penelitian/' + item.detail)
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

    getUrlProposal(laporanFilename) {
      if (laporanFilename !== '') {
        return `http://localhost:8000/storage/pengabdian/proposal/${laporanFilename}`;
      } else {
        return null; // or any default link if the filename is empty
      }
    },
    getUrlLaporan(laporanFilename) {
      if (laporanFilename !== '') {
        return `http://localhost:8000/storage/pengabdian/laporan/${laporanFilename}`;
      } else {
        return null; // or any default link if the filename is empty
      }
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
  },
  mounted() {
    this.fetchData();
    console.log(this.$route.params.data);
    this.$route.params.data.status = false;
    this.datalistPublikasi = this.$route.params.data.publikasi;
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Detail Penelitian" }]);
  },
};
</script>

