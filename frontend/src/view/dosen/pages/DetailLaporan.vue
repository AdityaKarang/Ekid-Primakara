<template>
  <div>
    <v-card>
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
                  <h5>Sumber Dana</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.sumber_dana }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Bentuk Dana</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.bentuk_dana }}</h5>
                </td>
              </tr>
              <tr>
                <td>
                  <h5>Jumlah Dana</h5>
                </td>
                <td>
                  <h5>: {{ dataLaporan.jumlah_dana }}</h5>
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
              <!-- <template v-for="(dana, index) in dataLaporan.dana">
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
              </template> -->
              <tr class="mt-2">
                <td>
                  <h5>Laporan Kemajuan</h5>
                </td>
                <td>
                  <h5>
                    <a v-if="dataLaporan.laporankemajuan.laporan_kemajuan !== ''" :href="getUrl(dataLaporan.laporankemajuan.laporan_kemajuan)"
                      target="__blank">
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
                    <a v-if="dataLaporan.laporanakhir.laporan_akhir !== ''" :href="getUrl(dataLaporan.laporanakhir.laporan_akhir)"
                      target="__blank">
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

    <!-- <v-card class="mt-2">
      <v-card-title> Hasil Penilaian </v-card-title>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header>
            <h4>Laporan Kemajuan</h4>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-data-table :headers="headerPenilaianKemajuan" :items="dataNilaiKemajuan" hide-default-footer>
              <template slot="item" slot-scope="props">
                <template v-for="(indikator, i) in props.item.indikators">
                  <tr :key="i">
                    <td class="text-start" v-if="i == 0" :rowspan="props.item.indikators.length">
                      {{ props.item.no }}
                    </td>
                    <td class="text-start" v-if="i == 0" :rowspan="props.item.indikators.length">
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
                  <th colspan="2" class="text-end">
                    <h5>Total</h5>
                  </th>
                  <th>{{ getTotalValue(dataNilaiKemajuan) }}</th>
                </tr>
              </template>
            </v-data-table>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
      <v-expansion-panels>
        <v-expansion-panel>
          <v-expansion-panel-header>
            <h4>Laporan Akhir</h4>
          </v-expansion-panel-header>
          <v-expansion-panel-content>
            <v-data-table :headers="headerPenilaianAkhir" :items="dataNilaiAkhir" hide-default-footer>
              <template slot="item" slot-scope="props">
                <template v-for="(indikator, i) in props.item.indikators">
                  <tr :key="i">
                    <td class="text-start" v-if="i == 0" :rowspan="props.item.indikators.length">
                      {{ props.item.no }}
                    </td>
                    <td class="text-start" v-if="i == 0" :rowspan="props.item.indikators.length">
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
                  <th colspan="2" class="text-end">
                    <h5>Total</h5>
                  </th>
                  <th>{{ getTotalValue(dataNilaiKemajuan) }}</th>
                </tr>
              </template>
            </v-data-table>
          </v-expansion-panel-content>
        </v-expansion-panel>
      </v-expansion-panels>
    </v-card> -->
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";
import axios from 'axios';


export default {
  name: "DetailLaporanPenelitian",
  components: {
    ListPublikasi,
  },
  data() {
    return {
      datalistPublikasi: [
        {
          jenis: "jurnal",
          tahunPublikasi: "2011",
          jenisPublikasi: "Nasional",
          judulPublikasi: "Perancangan Alat Deteksi Citra Tanaman Daun",
          namaJurnal: "Jurnal Teknologi",
          issnJurnal: "1234",
          volume: "20",
          nomor: "30",
          halamanJurnal: "20",
          url: "https://hahhahaha",
        },
      ],
      dataLaporan: [],
      headerPenilaianKemajuan: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "Bobot" },
        { text: "Nilai", value: "inputNilai", align: "center" },
      ],

      dataNilaiKemajuan: [
        {
          no: 1,
          kriteria: "Latar Belakang",
          indikators: [
            {
              name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Rumusan Masalah dan Tujuan Penelitian",
          indikators: [
            {
              name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Originalitas  dan keluaran Penelitian",
          indikators: [
            {
              name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Hasil dan Pembahasan",
          indikators: [
            {
              name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Simpulan dan saran",
          indikators: [
            {
              name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          no: "2",
          kriteria: "Ketepatan menggunakan metode dan teori",
          indikators: [
            {
              name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Penggunaan referensi",
          indikators: [
            {
              name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
          indikators: [
            {
              name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Bahasa dan Sistematika Laporan",
          indikators: [
            {
              name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          no: "3",
          kriteria: "Pembiayaan dan Pelaksanaan",
          indikators: [
            {
              name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
      ],

      headerPenilaianAkhir: [
        { text: "No", value: "no", width: "20px" },
        { text: "Kriteria ", value: "kriteria" },
        {
          text: "Indikator Penilaian",
          value: "indikator",
        },
        { text: "Bobot" },
        { text: "Nilai", value: "inputNilai", align: "center" },
      ],

      dataNilaiAkhir: [
        {
          no: 1,
          kriteria: "Latar Belakang",
          indikators: [
            {
              name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Rumusan Masalah dan Tujuan Penelitian",
          indikators: [
            {
              name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Originalitas  dan keluaran Penelitian",
          indikators: [
            {
              name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Hasil dan Pembahasan",
          indikators: [
            {
              name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Simpulan dan saran",
          indikators: [
            {
              name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          no: "2",
          kriteria: "Ketepatan menggunakan metode dan teori",
          indikators: [
            {
              name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Penggunaan referensi",
          indikators: [
            {
              name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
              bobot: "10",
              nilai: 4,
            },
          ],
        },
        {
          kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
          indikators: [
            {
              name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          kriteria: "Bahasa dan Sistematika Laporan",
          indikators: [
            {
              name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
        {
          no: "3",
          kriteria: "Pembiayaan dan Pelaksanaan",
          indikators: [
            {
              name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
              bobot: "10",
              nilai: 3,
            },
          ],
        },
      ],
    };
  },
  async mounted() {
    this.datalistPublikasi = this.$route.params.data.publikasi.jurnal
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Detail Penelitian" }]);
    await this.fetchData();
  },
  methods: {
    async fetchData() {
      try {
        this.isLoading = true;

        const item = this.$route.params.data;

        // Fetch the main data for the proposal
        const responseMain = await axios.get('http://localhost:8000/api/get-kemajuan-akhir/' + item.detail);
        console.log("detail:", responseMain.data.data); // Log the API response

        // Assign the fetched data to the dataLaporan object
        this.dataLaporan = responseMain.data.data;

        // Fetch additional data for anggota_dosen_1
        const responseDosen1 = await axios.get('http://localhost:8000/api/anggotadosen/' + this.dataLaporan.anggota_dosen_1);
        console.log("Anggota Dosen 1 Data:", responseDosen1.data); // Log the API response for anggota_dosen_1
        this.dataLaporan.anggota_dosen_1 = responseDosen1.data;

        // Fetch additional data for anggota_dosen_2
        const responseDosen2 = await axios.get('http://localhost:8000/api/anggotadosen/' + this.dataLaporan.anggota_dosen_2);
        console.log("Anggota Dosen 2 Data:", responseDosen2.data); // Log the API response for anggota_dosen_2
        this.dataLaporan.anggota_dosen_2 = responseDosen2.data;

        // Fetch additional data for mahasiswa_1
        const responseMahasiswa1 = await axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_1);
        this.dataLaporan.mahasiswa_1 = responseMahasiswa1.data;

        // Fetch additional data for mahasiswa_2
        const responseMahasiswa2 = await axios.get('http://localhost:8000/api/mahasiswa/' + this.dataLaporan.mahasiswa_2);
        this.dataLaporan.mahasiswa_2 = responseMahasiswa2.data;
      } catch (error) {
        console.error(error);
      } finally {
        // Set loading state to false, whether the request succeeds or fails
        this.isLoading = false;
      }
    },

    getUrl(laporanFilename) {
    if (laporanFilename !== '') {
      return `http://localhost:8000/storage/penelitian/laporan/${laporanFilename}`;
    } else {
      return null; // or any default link if the filename is empty
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

};
</script>