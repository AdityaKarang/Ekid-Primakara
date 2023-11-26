<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialogPublikasi" persistent max-width="800px">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Form Publikasi
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="dialogPublikasi = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-select v-model="formPublikasi.jenisPublkasi" :items="listPublikasi" label="Jenis Publikasi" required
                    @change="onJenisPublikasi" :disabled="checkDisable(formPublikasi.status)">
                  </v-select>
                </v-col>
                <!-- <template v-if="onCheckSelectFormStatus('Buku')">
                  <v-col cols="12">
                    <v-text-field label="Tahun Terbit" v-model="formPublikasi.buku.tahunTerbit" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Judul Buku" v-model="formPublikasi.buku.judul" required>
                    </v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-text-field label="Jumlah Halaman" v-model="formPublikasi.buku.halaman" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="ISBN" v-model="formPublikasi.buku.isbn" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Penerbit" v-model="formPublikasi.buku.penerbit" required></v-text-field>
                  </v-col>
                </template> -->

                <template v-if="onCheckSelectFormStatus('jurnal')">
                  <v-col cols="12">
                    <v-text-field label="Tahun Publikasi" v-model="formPublikasi.jurnal.tahun" :disabled="checkDisable(formPublikasi.status)" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select label="Jenis Publikasi Jurnal" v-model="formPublikasi.jurnal.jenis" :disabled="checkDisable(formPublikasi.status)" :items="jenisjurnal"
                      required>
                    </v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Judul Publikasi" v-model="formPublikasi.jurnal.judul" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Nama Jurnal" v-model="formPublikasi.jurnal.nama" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                    <v-text-field label="ISSN Jurnal" v-model="formPublikasi.jurnal.issn" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                    <v-col cols="12">
                      <v-text-field label="Volume" v-model="formPublikasi.jurnal.volume" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field label="Nomor" v-model="formPublikasi.jurnal.nomor" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                    </v-col>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Halaman Jurnal" v-model="formPublikasi.jurnal.halaman" :disabled="checkDisable(formPublikasi.status)" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="URL" v-model="formPublikasi.jurnal.url" :disabled="checkDisable(formPublikasi.status)"  required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input v-model="formPublikasi.jurnal.file_jurnal" :disabled="checkDisable(formPublikasi.status)" label="Upload Jurnal" required></v-file-input>
                  </v-col>
                </template>
                <!-- 
                <template v-if="onCheckSelectFormStatus('Media Massa')">
                  <v-col cols="12">
                    <v-menu ref="waktuBuka" v-model="formPublikasi.mediamasa.calendar" :close-on-content-click="false"
                      transition="scale-transition" offset-y max-width="290px" min-width="auto">
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field v-model="formPublikasi.mediamasa.tanggal" label="Tanggal Publikasi"
                          hint="MM/DD/YYYY format" persistent-hint prepend-icon="mdi-calendar" v-bind="attrs" @blur="
                            formPublikasi.mediamasa.tanggal = parseDate(
                              formPublikasi.mediamasa.tanggal
                            )
                            " v-on="on"></v-text-field>
                      </template>
                      <v-date-picker v-model="formPublikasi.mediamasa.tanggal" no-title
                        @input="formPublikasi.mediamasa.calendar = false"></v-date-picker>
                    </v-menu>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Judul Publikasi" v-model="formPublikasi.mediamasa.judul" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Nama Media" v-model="formPublikasi.mediamasa.media" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="URL" v-model="formPublikasi.mediamasa.url" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input label="Upload Dokumen Pendukung lainnya"></v-file-input>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('Forum Ilmiah')">
                  <v-col cols="12">
                    <v-text-field label="Tahun Pelaksanaan" v-model="formPublikasi.forumilmiah.tahun" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select label="Tingkat Forum Ilmiah" v-model="formPublikasi.forumilmiah.tingkat"
                      :items="tingkatilmiah" required></v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Nama Forum" v-model="formPublikasi.forumilmiah.namaforum" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Judul Makalah" v-model="formPublikasi.forumilmiah.makalah"
                      required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Institusi Penyelenggara" v-model="formPublikasi.forumilmiah.institusi"
                      required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Waktu Pelaksanaan" v-model="formPublikasi.forumilmiah.waktu"
                      required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Tempat Pelaksanaan" v-model="formPublikasi.forumilmiah.tempat"
                      required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input label="Upload Dokumen Forum Ilmiah"></v-file-input>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('HKI')">
                  <v-col cols="12">
                    <v-text-field label="Tahun Pelaksanaan" v-model="formPublikasi.hki.tahun" required>
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Judul HKI" v-model="formPublikasi.hki.judul" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select label="Jenis HKI" v-model="formPublikasi.hki.jenis" :items="jenishki" required>
                    </v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Nomor HKI" v-model="formPublikasi.hki.nomor" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Status" v-model="formPublikasi.hki.status" required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field label="Nomor Pendaftaran" v-model="formPublikasi.hki.pendaftaran"
                      required></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input label="Upload Dokumen HKI"></v-file-input>
                  </v-col>
                </template> -->
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn v-if="!checkDisable(formPublikasi.status)" color="blue darken-1" text
              @click="savePublikasi()">Submit</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-row justify="center">
      <v-dialog v-model="dialogUploadKemajuan" persistent max-width="600px">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Upload Laporan Kemajuan
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="dialogUploadKemajuan = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-file-input show-size counter v-model="formBerkas.file" label="Upload Berkas"
                    :disabled="checkDisable(formBerkas.status)"></v-file-input>
                </v-col>
                <!-- <v-col cols="12">
                  <v-textarea name="input-keterangan" label="Keterangan" outlined v-model="formBerkas.keterangan"
                    :disabled="checkDisable(formBerkas.status)" value=""></v-textarea>
                </v-col> -->
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn v-if="!checkDisable(formBerkas.status)" color="blue darken-1" text @click="saveKemajuan()
                          dialogUploadKemajuan = false">Simpan</v-btn>
          </v-card-actions>
        </v-card>
        <v-expansion-panels v-if="formBerkas.penilaian1 && checkDisable(formBerkas.status)">
          <v-expansion-panel>
            <v-expansion-panel-header>
              <h4>Hasil Penilaian Reviewer 1</h4>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-data-table :headers="formBerkas.penilaian1.header" :items="formBerkas.penilaian1.dataNilai"
                hide-default-footer>
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
                      {{ getTotalValue(formBerkas.penilaian1.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12">
                  <v-textarea name="catatan" label="catatan" outlined v-model="catatan_penilaian1" disabled
                    value=""></v-textarea>
                </v-col>
              </v-row>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <v-expansion-panels v-if="formBerkas.penilaian2 && checkDisable(formBerkas.status)">
          <v-expansion-panel>
            <v-expansion-panel-header>
              <h4>Hasil Penilaian Reviewer 2</h4>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-data-table :headers="formBerkas.penilaian2.header" :items="formBerkas.penilaian2.dataNilai"
                hide-default-footer>
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
                      {{ getTotalValue(formBerkas.penilaian2.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12">
                  <v-textarea name="catatan" label="catatan" outlined v-model="catatan_penilaian2" disabled
                    value=""></v-textarea>
                </v-col>
              </v-row>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-dialog>
    </v-row>
    <v-row justify="center">
      <v-dialog v-model="dialogUploadAkhir" persistent max-width="600px">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Upload Laporan Akhir
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="dialogUploadAkhir = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-file-input show-size counter v-model="formBerkas.file" label="Upload Berkas"
                    :disabled="checkDisable(formBerkas.status)"></v-file-input>
                </v-col>
                <!-- <v-col cols="12">
                  <v-textarea name="input-keterangan" label="Keterangan" outlined v-model="formBerkas.keterangan"
                    :disabled="checkDisable(formBerkas.status)" value=""></v-textarea>
                </v-col> -->
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn v-if="!checkDisable(formBerkas.status)" color="blue darken-1" text @click="saveAkhir()
                          dialogUploadAkhir = false">Simpan</v-btn>
          </v-card-actions>
        </v-card>
        <v-expansion-panels v-if="formBerkas.penilaian1 && checkDisable(formBerkas.status)">
          <v-expansion-panel>
            <v-expansion-panel-header>
              <h4>Hasil Penilaian Reviewer 1</h4>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-data-table :headers="formBerkas.penilaian1.header" :items="formBerkas.penilaian1.dataNilai"
                hide-default-footer>
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
                      {{ getTotalValue(formBerkas.penilaian1.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12">
                  <v-textarea name="catatan" label="catatan" outlined v-model="catatan_penilaian1" disabled
                    value=""></v-textarea>
                </v-col>
              </v-row>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
        <v-expansion-panels v-if="formBerkas.penilaian2 && checkDisable(formBerkas.status)">
          <v-expansion-panel>
            <v-expansion-panel-header>
              <h4>Hasil Penilaian Reviewer 2</h4>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-data-table :headers="formBerkas.penilaian2.header" :items="formBerkas.penilaian2.dataNilai"
                hide-default-footer>
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
                      {{ getTotalValue(formBerkas.penilaian2.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12">
                  <v-textarea name="catatan" label="catatan" outlined v-model="catatan_penilaian2" disabled
                    value=""></v-textarea>
                </v-col>
              </v-row>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-dialog>
    </v-row>
    <CustomCard title="Daftar Penelitian" deskripsi="List Daftar penelitian Yang Telah Di Inputkan" :headers="headers"
      :contentTable="contentTables" :isTopAction="false" :isEdit="false" :isDelete="false" @detailItem="detailData"
      @addNew="addNew" @onKemajuan="Kemajuan" @onAkhir="Akhir" @onPublikasi="Publikasi" />
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "LaporanPenelitian",
  components: {
    CustomCard,
  },
  data() {
    return {
      formPublikasi: {
        status: "",
        jenisPublkasi: "",
        buku: {
          tahunTerbit: "",
          judul: "",
          halaman: "",
          isbn: "",
          penerbit: "",
        },
        jurnal: {
          tahun: "",
          Jenis: "",
          judul: "",
          nama: "",
          issn: "",
          volume: "",
          nomor: "",
          halaman: "",
          url: "",
          file_jurnal: null,
        },
        mediamasa: {
          calendar: false,
          tanggalCalendar: "",
          tanggal: "",
          Jenis: "",
          media: "",
          volume: "",
          nomor: "",
          halaman: "",
          url: "",
        },
        forumilmiah: {
          tahun: "",
          tingkat: "",
          namaforum: "",
          makalah: "",
          institusi: "",
          waktu: "",
          tempat: "",
        },
        hki: {
          tahun: "",
          judul: "",
          Jenis: "",
          nomor: "",
        },
      },
      showFormSelect: [],
      showFormBuku: false,
      showFormForumIlmiah: false,
      showFormJurnal: false,
      showFormMediaMassa: false,
      showFormHKI: false,
      dialogPublikasi: false,
      listPublikasi: ["jurnal"],
      formBerkas: {
        file: null,
        keterangan: "",
      },
      catatan_penilaian: "",
      dialogUploadKemajuan: false,
      dialogUploadAkhir: false,
      titleUploadBerkas: "Laporan Kemajuan",
      form: {
        tahunAkademik: "2020/2021",
        semester: "Genap",
        prodi: "",
        nama: "",
        judul: "",
        bidangFokus: "",
        sumberDana: "",
        jenisPublkasi: "",
        tingkatPublikasi: "",
      },
      jenisjurnal: [
        { text: "Select One", value: null },
        "Internasional",
        "Nasional Terakreditasi",
        "Nasional Tidak Terakreditasi",
      ],
      jenishki: [
        { text: "Select One", value: null },
        "Paten",
        "Paten Sederhana",
        "Hak Cipta",
        "Desain Produk Industri",
        "Perlindungan Varietas Tanaman",
        "Desain Tata Letak Sirkuit Terpada",
      ],
      tingkatilmiah: [
        { text: "Select One", value: null },
        "Regional",
        "Nasional",
        "Internasional",
      ],
      jenisPublkasis: [
        { text: "Select One", value: null },
        "buku",
        "jurnal",
        "HKI",
        "Majalah",
      ],
      tingkatPublikasis: [
        { text: "Select One", value: null },
        "internasional",
        "nasional",
        "lokal",
      ],
      tahunAkademiks: [
        { text: "Select One", value: null },
        "2021/2022",
        "2020/2021",
        "2019/2020",
        "2018/2019",
      ],
      prodis: [
        { text: "Pilih Prodi", value: null },
        "Informatika",
        "Sistem Informasi",
        "Sistem Informasi Ankuntansi",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Judul", value: "judul" },
        { text: "Status", value: "proses" },
        { text: "Laporan Kemajuan", value: "kemajuan" },
        { text: "Laporan Akhir", value: "akhir" },
        { text: "Publikasi", value: "publikasi" },
        { text: "Detail", value: "detail" },
      ],
      contentTables: []
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user
    },
  },
  mounted() {
    this.fetchData();
    this.listPublikasi.forEach(
      function (value) {
        let data = {
          name: value,
          status: false,
        };
        this.showFormSelect.push(data);
      }.bind(this)
    );
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Laporan Penelitian" }]);
  },
  methods: {
    fetchData() {
      // Fetch reviewer data
      const reviewerPromise = axios.get('http://localhost:8000/api/reviewer');

      // Fetch penelitian data
      const nilaiPromise = axios.get('http://localhost:8000/api/get-kemajuan-akhir');

      Promise.all([reviewerPromise, nilaiPromise])
        .then(([reviewerRes, nilai]) => {
          // console.log("API Response:", penelitianRes.data); // Log the API response

          // Create reviewer mapping
          const reviewerMapping = {};
          reviewerRes.data.data.forEach(reviewer => {
            reviewerMapping[reviewer.id] = reviewer.username;
          });

          const currentUserID = this.currentUser.id; // Get the ID of the current user

          this.contentTables = nilai.data
            .filter(bf => bf.user_id === currentUserID && bf.status === 'Aproved')  // Filter the data based on the user ID
            .map((bf, index) => {

              let nilaikemajuan_reviewer_1 = bf.datapenilaian.filter(item => item.jenis === 'Kemajuan' && item.user_id == bf.reviewer_1);
              let nilaikemajuan_reviewer_2 = bf.datapenilaian.filter(item => item.jenis === 'Kemajuan' && item.user_id == bf.reviewer_2);

              let valuekemajuan_reviewer_1 = nilaikemajuan_reviewer_1.length > 0 ? nilaikemajuan_reviewer_1[0].valuepenilaian : [];
              let valuekemajuan_reviewer_2 = nilaikemajuan_reviewer_2.length > 0 ? nilaikemajuan_reviewer_2[0].valuepenilaian : [];

              let nilaiakhir_reviewer_1 = bf.datapenilaian.filter(item => item.jenis === 'Akhir' && item.user_id == bf.reviewer_1);
              let nilaiakhir_reviewer_2 = bf.datapenilaian.filter(item => item.jenis === 'Akhir' && item.user_id == bf.reviewer_2);

              let valueakhir_reviewer_1 = nilaiakhir_reviewer_1.length > 0 ? nilaiakhir_reviewer_1[0].valuepenilaian : [];
              let valueakhir_reviewer_2 = nilaiakhir_reviewer_2.length > 0 ? nilaiakhir_reviewer_2[0].valuepenilaian : [];


              console.log("Current Data:", bf); // Log the current data object being mapped

              const kemajuanStatus = bf.laporankemajuan ? bf.laporankemajuan.status : "empty";
              const akhirStatus = bf.laporanakhir ? bf.laporanakhir.status : "empty";
              const publikasiStatus = bf.publishcation ? bf.publishcation.status : "empty";

              // Set the value of proses based on the status
              let proses;
              if (kemajuanStatus === 'aprove' && akhirStatus === 'aprove' && publikasiStatus === 'aprove') {
                proses = 'Selesai';
              } else if (kemajuanStatus === 'empty' && akhirStatus === 'empty' && publikasiStatus === 'empty') {
                proses = 'InProgress';
              } else {
                proses = 'InProgress'; // You can set another value for different combinations of statuses if needed
              }

              return {
                no: index + 1,
                tahun_akademik: bf.tahun_akademik,
                judul: bf.judul,
                tipe: "penelitian",
                proses: proses,
                kemajuan: {
                  fileName: bf.laporankemajuan ? new File(["example.pdf"], bf.laporankemajuan.laporan_kemajuan, { type: "application/pdf" }) : null,
                  keterangan: bf.laporankemajuan ? bf.laporankemajuan.catatan : "",
                  status: kemajuanStatus,
                  penilaian1: {
                    header: [
                      { text: "No", value: "no", width: "20px" },
                      { text: "Kriteria ", value: "kriteria" },
                      {
                        text: "Indikator Penilaian",
                        value: "indikator",
                      },
                      { text: "Bobot" },
                      { text: "Nilai", value: "inputNilai", align: "center" },
                    ],

                    dataNilai: valuekemajuan_reviewer_1,
                    catatan_penilaian1: "catatn penilatian ",
                  },
                  penilaian2: {
                    header: [
                      { text: "No", value: "no", width: "20px" },
                      { text: "Kriteria ", value: "kriteria" },
                      {
                        text: "Indikator Penilaian",
                        value: "indikator",
                      },
                      { text: "Bobot" },
                      { text: "Nilai", value: "inputNilai", align: "center" },
                    ],

                    dataNilai: valuekemajuan_reviewer_2,
                    catatan_penilaian2: "catatn penilatian ",
                  },
                },
                akhir: {
                  fileName: bf.laporanakhir ? new File(["example.pdf"], bf.laporanakhir.laporan_akhir, { type: "application/pdf" }) : null,
                  keterangan: bf.laporanakhir ? bf.laporanakhir.catatan : "",
                  status: akhirStatus,
                  penilaian1: {
                    header: [
                      { text: "No", value: "no", width: "20px" },
                      { text: "Kriteria ", value: "kriteria" },
                      {
                        text: "Indikator Penilaian",
                        value: "indikator",
                      },
                      { text: "Bobot" },
                      { text: "Nilai", value: "inputNilai", align: "center" },
                    ],

                    dataNilai: valueakhir_reviewer_1,
                    catatan_penilaian1: "catatn penilatian ",
                  },
                  penilaian2: {
                    header: [
                      { text: "No", value: "no", width: "20px" },
                      { text: "Kriteria ", value: "kriteria" },
                      {
                        text: "Indikator Penilaian",
                        value: "indikator",
                      },
                      { text: "Bobot" },
                      { text: "Nilai", value: "inputNilai", align: "center" },
                    ],

                    dataNilai: valueakhir_reviewer_2,
                    catatan_penilaian2: "catatn penilatian ",
                  },
                },
                publikasi: {
                  status: publikasiStatus,
                  jenis: bf.publishcation ? bf.publishcation.jenis : "",
                  jurnal: [
                    {
                      jenis: bf.publishcation ? bf.publishcation.jenis : "",
                      tahunPublikasi: bf.publishcation ? bf.publishcation.tahun_publikasi : "",
                      jenisPublikasi: bf.publishcation ? bf.publishcation.jenis_publikasi_jurnal : "",
                      judulPublikasi: bf.publishcation ? bf.publishcation.judul_publikasi : "",
                      namaJurnal: bf.publishcation ? bf.publishcation.nama_jurnal : "",
                      issnJurnal: bf.publishcation ? bf.publishcation.issn_jurnal : "",
                      volume: bf.publishcation ? bf.publishcation.volume : "",
                      nomor: bf.publishcation ? bf.publishcation.nomor : "",
                      halamanJurnal: bf.publishcation ? bf.publishcation.halaman : "",
                      url: bf.publishcation ? bf.publishcation.url : "",
                    },
                  ]
                },
                detail: bf.id,
              };
            });

          console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
        });
    },
    onSubmit(evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    detailData(item) {
      console.log(item);
      this.$router.push({
        name: "detail-laporan",
        params: { data: item },
      });
      this.itemID = item.detail
    },

    Kemajuan(item) {
      console.log(item);
      this.dialogUploadKemajuan = true;
      this.itemID = item.detail;
      this.formBerkas.file = item.kemajuan.fileName;
      this.formBerkas.keterangan = item.kemajuan.keterangan;
      this.formBerkas.status = item.kemajuan.status;
      this.formBerkas.penilaian1 = item.kemajuan.penilaian1;
      this.formBerkas.penilaian2 = item.kemajuan.penilaian2;
      // this.titleUploadBerkas = "Laporan Kemajuan";
      this.catatan_penilaian1 = item.kemajuan.penilaian.catatan_penilaian1;
      this.catatan_penilaian2 = item.kemajuan.penilaian.catatan_penilaian2;
    },


    saveKemajuan() {

      const formData = new FormData();
      formData.append("penelitian_id", this.itemID);
      formData.append("laporan_kemajuan", this.formBerkas.file);
      formData.append("status", "waiting");
      formData.append("catatan", this.formBerkas.keterangan);


      // Lanjutkan dengan permintaan POST yang sudah diperbarui
      axios
        .post("http://localhost:8000/api/laporankemajuan", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.fetchData();
          this.formBerkas.file = "";
          this.formBerkas.status = "";
          this.formBerkas.keterangan = "";

        })
        .catch((error) => {
          console.log(error);
        });

    },
    Akhir(item) {
      console.log(item);
      this.dialogUploadAkhir = true;
      this.itemID = item.detail;
      this.formBerkas.file = item.akhir.fileName;
      this.formBerkas.keterangan = item.akhir.keterangan;
      this.formBerkas.status = item.akhir.status;
      this.formBerkas.penilaian1 = item.akhir.penilaian1;
      this.formBerkas.penilaian2 = item.akhir.penilaian2;
      // this.titleUploadBerkas = "Laporan akhir";
      this.catatan_penilaian1 = item.akhir.penilaian.catatan_penilaian1;
      this.catatan_penilaian2 = item.akhir.penilaian.catatan_penilaian2;
    },
    saveAkhir() {

      const formData = new FormData();
      formData.append("penelitian_id", this.itemID);
      formData.append("laporan_akhir", this.formBerkas.file);
      formData.append("status", "waiting");
      formData.append("catatan", this.formBerkas.keterangan);


      // Lanjutkan dengan permintaan POST yang sudah diperbarui
      axios
        .post("http://localhost:8000/api/laporanakhir", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.fetchData();
          this.formBerkas.file = "";
          this.formBerkas.status = "";
          this.formBerkas.keterangan = "";

        })
        .catch((error) => {
          console.log(error);
        });

    },
    Publikasi(item) {
      this.dialogPublikasi = true;
      this.formPublikasi.status = item.publikasi.status;
      this.formPublikasi.jenisPublkasi = item.publikasi.jenis;
      console.log(item);
      this.itemID = item.detail;

    },
    savePublikasi() {

      const formData = new FormData();
      formData.append("jenis", "jurnal");
      formData.append("penelitian_id", this.itemID);
      formData.append("tahun_publikasi", this.formPublikasi.jurnal.tahun);
      formData.append("jenis_publikasi_jurnal", this.formPublikasi.jurnal.jenis);
      formData.append("judul_publikasi", this.formPublikasi.jurnal.judul);
      formData.append("nama_jurnal", this.formPublikasi.jurnal.nama);
      formData.append("issn_jurnal", this.formPublikasi.jurnal.issn);
      formData.append("volume", this.formPublikasi.jurnal.volume);
      formData.append("nomor", this.formPublikasi.jurnal.nomor);
      formData.append("halaman", this.formPublikasi.jurnal.halaman);
      formData.append("url", this.formPublikasi.jurnal.url);;
      formData.append("status", "aprove");
      formData.append("file_jurnal", this.formPublikasi.jurnal.file_jurnal);
      formData.append("user_id", this.currentUser.id);


      // Lanjutkan dengan permintaan POST yang sudah diperbarui
      axios
        .post("http://localhost:8000/api/publikasi", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          this.fetchData();
          this.dialogPublikasi = false
          // this.formPublikasi.jurnal.tahun = "";
          // this.formPublikasi.jurnal.jenis = "";
          // this.formPublikasi.jurnal.judul = "";
          // this.formPublikasi.jurnal.nama = "";
          // this.formPublikasi.jurnal.issn = "";
          // this.formPublikasi.jurnal.volume = "";
          // this.formPublikasi.jurnal.nomor = "";
          // this.formPublikasi.jurnal.halaman = "";
          // this.formPublikasi.jurnal.url = "";
          // this.formPublikasi.jurnal.file_jurnal = "";

        })
        .catch((error) => {
          console.log(error);
        });
    },
    checkDisable(status) {
      if (status == "rejected" || status == "aprove" || status == "success") {
        console.log(status);
        return true;
      }
      return false;
    },

    onJenisPublikasi(value) {
      console.log("value: ", value);
      this.showFormSelect.forEach((value) => {
        value.status = false;
      });
      const index = this.showFormSelect.findIndex(
        (select) => select.name == value
      );

      this.showFormSelect[index].status = true;
    },
    onCheckSelectFormStatus(nameStatus) {
      let data = this.showFormSelect.find((s) => {
        return s.name === nameStatus;
      });
      return data ? data.status : false;
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

    addNew(value) {
      console.log(value);
      this.showAdd = value;
    },
    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${month}/${day}/${year}`;
    },
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
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