<template>
  <div>
    <v-card>
      <v-card-text>
        <v-form>
          <table>
            <tbody>
              <tr>
                <td><h5>Tahun Akademik</h5></td>
                <td>
                  <h5>: {{ dataLaporan.tahunAkademik }}</h5>
                </td>
              </tr>
              <tr>
                <td><h5>Semester</h5></td>
                <td>
                  <h5>: {{ dataLaporan.semester }}</h5>
                </td>
              </tr>
              <tr>
                <td><h5>Judul</h5></td>
                <td>
                  <h5>: {{ dataLaporan.judul }}</h5>
                </td>
              </tr>
              <template v-for="(dosen, index) in dataLaporan.anggotaDosen">
                <tr :key="index + '_' + dosen.nama">
                  <td>
                    <h5>Anggota Dosen {{ index + 1 }}</h5>
                  </td>
                  <td>
                    <h5>: {{ dosen.nama }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + dosen.nidn">
                  <td>
                    <h5 class="ml-3">NIDN</h5>
                  </td>
                  <td>
                    <h5>: {{ dosen.nidn }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + dosen.jabatanFungsional">
                  <td>
                    <h5 class="ml-3">Jabatan Fungsional</h5>
                  </td>
                  <td>
                    <h5>: {{ dosen.jabatanFungsional }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + dosen.programStudi">
                  <td>
                    <h5 class="ml-3">Program Studi</h5>
                  </td>
                  <td>
                    <h5>: {{ dosen.programStudi }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + dosen.noHPEmail">
                  <td>
                    <h5 class="ml-3">No.Hp/Email</h5>
                  </td>
                  <td>
                    <h5>: {{ dosen.noHPEmail }}</h5>
                  </td>
                </tr>
              </template>

              <template
                v-for="(Mahasiswa, index) in dataLaporan.anggotaMahasiswa"
              >
                <tr class="mt-2" :key="index + '_' + Mahasiswa.nama">
                  <td>
                    <h5>Anggota Mahasiswa {{ index + 1 }}</h5>
                  </td>
                  <td>
                    <h5>: {{ Mahasiswa.nama }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + Mahasiswa.nim">
                  <td>
                    <h5 class="ml-3">NIM</h5>
                  </td>
                  <td>
                    <h5>: {{ Mahasiswa.nim }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_' + Mahasiswa.prodi">
                  <td>
                    <h5 class="ml-3">Prodi</h5>
                  </td>
                  <td>
                    <h5>: {{ Mahasiswa.prodi }}</h5>
                  </td>
                </tr>
              </template>
              <tr class="mt-2">
                <td><h5>Bidang Fokus</h5></td>
                <td>
                  <h5>: {{ dataLaporan.bidangFokus }}</h5>
                </td>
              </tr>
              <tr>
                <td><h5>Mitra</h5></td>
                <td>
                  <h5>: {{ dataLaporan.mitra }}</h5>
                </td>
              </tr>
              <template v-for="(dana, index) in dataLaporan.dana">
                <tr :key="index + '_sumberdana'">
                  <td><h5>Sumber Dana</h5></td>
                  <td>
                    <h5>: {{ dana.sumberDana }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_bentukdana'">
                  <td><h5>Bentuk Dana</h5></td>
                  <td>
                    <h5>: {{ dana.bentukDana }}</h5>
                  </td>
                </tr>
                <tr :key="index + '_jumlahdana'">
                  <td><h5>Jumlah Dana</h5></td>
                  <td>
                    <h5>: Rp.{{ dana.jumlahDana }}</h5>
                  </td>
                </tr>
              </template>
              <tr class="mt-2">
                <td><h5>Laporan Kemajuan</h5></td>
                <td>
                  <h5>
                    <a
                      v-if="dataLaporan.fileNameKemajuan !== ''"
                      :href="'./berkas/' + dataLaporan.fileNameKemajuan"
                      target="__blank"
                    >
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.fileNameKemajuan }}
                    </a>
                    <div v-else>: File Tidak Tersedia</div>
                  </h5>
                </td>
              </tr>
              <tr class="mt-2">
                <td><h5>Laporan Akhir</h5></td>
                <td>
                  <h5>
                    <a
                      v-if="dataLaporan.fileNameAkhir !== ''"
                      :href="'./berkas/' + dataLaporan.fileNameAkhir"
                      target="__blank"
                    >
                      :
                      <i class="flaticon-file-2 text-primary"></i>
                      {{ dataLaporan.fileNameAkhir }}
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
    <v-card class="mt-2">
      <v-card-title> Hasil Penilaian </v-card-title>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header>
            Laporan Kemajuan
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-data-table
              :headers="headerPenilaianKemajuan"
              :items="dataNilaiKemajuan"
              hide-default-footer
            >
              <template slot="body.append">
                <tr>
                  <th colspan="2">Total</th>
                  <th>{{ getTotalValue(dataNilaiKemajuan) }}</th>
                </tr>
              </template>
            </v-data-table>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header> Laporan Akhir </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-data-table
              :headers="headerPenilaianAkhir"
              :items="dataNilaiAkhir"
              hide-default-footer
            >
              <template slot="body.append">
                <tr>
                  <th colspan="2">Total</th>
                  <th>{{ getTotalValue(dataNilaiAkhir) }}</th>
                </tr>
              </template>
            </v-data-table>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card>
  </div>
</template>
<script>
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";

import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";

export default {
  name: "DetailLaporanPenelitian",
  components: {
    ListPublikasi,
  },
  data() {
    return {
      datalistPublikasi: [],
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
      headerPenilaianKemajuan: [
        { text: "No", value: "no" },
        { text: "Kriteria ", value: "kriteria" },
        { text: "Nilai", value: "nilai" },
      ],
      dataNilaiKemajuan: [
        {
          no: 1,
          kriteria: "Latar Belakang Masalah",
          nilai: "",
        },
        {
          no: 2,
          kriteria: "Rumusan Masalah Dan Tujuan Penelitian ",
          nilai: "",
        },
        {
          no: 3,
          kriteria: "Hasil dan Pembahasan",
          nilai: "",
        },
        {
          no: 4,
          kriteria: "Metode",
          nilai: "",
        },
        {
          no: 5,
          kriteria: "Unsur Penunjang",
          nilai: "",
        },
      ],
      headerPenilaianAkhir: [
        { text: "No", value: "no" },
        { text: "Kriteria ", value: "kriteria" },
        { text: "Nilai", value: "nilai" },
      ],
      dataNilaiAkhir: [
        {
          no: 1,
          kriteria: "Perumusan Masalah",
          nilai: "",
        },
        {
          no: 2,
          kriteria: "Manfaat Hasil dan Luaran ",
          nilai: "",
        },
        {
          no: 3,
          kriteria: "Tinjauan Pustaka",
          nilai: "",
        },
        {
          no: 4,
          kriteria: "Metode",
          nilai: "",
        },
        {
          no: 5,
          kriteria: "Unsur Penunjang",
          nilai: "",
        },
      ],
    };
  },
  methods: {
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach((value) => {
        total += value.nilai;
      });
      return total;
    },
  },
  mounted() {
    console.log(this.$route.params.data.publikasi);
    this.datalistPublikasi = this.$route.params.data.publikasi;
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Detail Penelitian" }]);
  },
};
</script>