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
            </tbody>
          </table>
        </v-form>
      </v-card-text>
    </v-card>
    <v-card class="mt-2">
      <v-card-title> Publikasi</v-card-title>
      <ListPublikasi :dataList="datalistPublikasi"></ListPublikasi>
    </v-card>
  </div>
</template>
<script>
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";
import axios from 'axios';

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
      },

    };
  },
  mounted() {
    this.fetchData();
    this.datalistPublikasi = this.$route.params.item.publikasi.jurnal;
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Detail Publikasi" }]);
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
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach((value) => {
        total += value.nilai;
      });
      return total;
    },
  },
};
</script>