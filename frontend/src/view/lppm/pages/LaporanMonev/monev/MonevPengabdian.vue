<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="nilaiPopup" max-width="500">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Hasil Penilaian Monev
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="nilaiPopup = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>

          <v-data-table
            :headers="headerPenilaian"
            :items="dataNilai"
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
                  <!-- <v-text-field v-model="item.nilai" type="number"></v-text-field> -->
                </tr>
              </template>
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
              <v-textarea
                name="input-keterangan"
                label="Catatan"
                outlined
                v-model="keterangan"
                value=""
                disabled
              ></v-textarea>
            </v-col>
          </v-row>
        </v-card>
      </v-dialog>
    </v-row>

    <CustomCard
      title="Daftar Monev Pengabdian"
      deskripsi="List Daftar Monev Pengabdian Yang Telah Di Inputkan"
      :headers="headers"
      :contentTable="filterDataContentTable"
      :additionalData="additionalData"
      :isTopAction="false"
      :isEdit="false"
      :isDelete="false"
      :isDetail="false"
    >
      <template v-slot:filter>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterTahunAkademikSemester"
            v-model="filterTahunAkademik"
            label="Tahun Ajaran dan semester"
          ></v-select>
        </div>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterProdi"
            label="Prodi"
            v-model="filterProdi"
          ></v-select>
        </div>
      </template>
      <template v-slot:additioalFilter>
        <div class="ml-2">
          <CountDashboard
            v-bind:count="countDataMasuk"
            title="Laporan Monev Masuk"
            icon="./media/svg/files/doc.svg"
            textButton="Lihat Semua Data"
            @clickData="filterDataMasuk"
          ></CountDashboard>
        </div>
        <div class="ml-2">
          <CountDashboard
            v-bind:count="countTelahDiPlot"
            title="Set Reviewer"
            icon="./media/svg/files/doc.svg"
            textButton="Lihat  Belum Di Set"
            @clickData="filterBelumDiPlot"
          ></CountDashboard>
        </div>
        <div class="ml-2">
          <CountDashboard
            v-bind:count="countTelahDiNilai"
            title="Telah Di Nilai"
            icon="./media/svg/files/doc.svg"
            textButton="Lihat  Belum Di Nilai"
            @clickData="filterBelumDiNilai"
          ></CountDashboard>
        </div>
      </template>

      <template v-slot:Detail="{ item }">
        <v-tooltip left v-if="checkStatus(item.status, 'aprove')">
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="green"
              class="mr-2"
              v-bind="attrs"
              v-on="on"
              @click="btnAprove(item)"
            >
              mdi-check-circle-outline
            </v-icon>
          </template>
          <span>Approve</span>
        </v-tooltip>
        <v-tooltip left v-if="checkStatus(item.status, 'rejected')">
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="red"
              class="mr-2"
              v-bind="attrs"
              v-on="on"
              @click="btnRejected(item)"
            >
              mdi-close-circle-outline
            </v-icon>
          </template>
          <span>Rejected</span>
        </v-tooltip>
        <v-tooltip left v-if="checkStatus(item.status, 'cancel')">
          <template v-slot:activator="{ on, attrs }">
            <v-icon
              color="red"
              class="mr-2"
              v-bind="attrs"
              v-on="on"
              @click="btnCancel(item)"
            >
              mdi-cancel</v-icon
            >
          </template>
          <span>Cancel</span>
        </v-tooltip>
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

export default {
  name: "MonevPengabdian",
  components: {
    CustomCard,
    CountDashboard,
  },
  data() {
    return {
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
      additionalData: {
        timReviewer: ["I Putu Satwika", "Eka Grana aristya dewi"],
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
        { text: "Team Reviewer", value: "plot_reviewer" },
        { text: "Nilai", value: "plot_reviewer_nilai" },
        { text: "Grade", value: "rata_rata" },
        { text: "Action", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021-Genap",
          prodi: "Teknik Informatika",

          nama: "i putu satwika",
          judul: "Perancangan Sistem Informasi Perpustakaan Digital ",
          berkas: "example.pdf",
          mitra: "ITB",
          bidangFokus: "Sistem Informasi",
          dana: [
            {
              sumberDana: "Luar Perguruan Tinggi",
              bentukDana: "In-Cash",
              jumlahDana: "5.000.000",
            },
          ],
          plot_reviewer: {
            reviewers: [
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
            ],
          },
          status: "Aprove",
        },

        {
          no: "2",
          tahun_akademik: "2020/2021-Genap",
          prodi: "Sistem Informasi",

          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun ",
          berkas: "example.pdf",
          mitra: "-",
          bidangFokus: "IOT",
          dana: [
            {
              sumberDana: "Mandiri",
              bentukDana: "In-Cash",
              jumlahDana: "2.500.000",
            },
          ],
          plot_reviewer: {
            reviewers: [
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
            ],
          },
          status: "Rejected",
        },

        {
          no: "3",
          tahun_akademik: "2019/2020-Ganjil",
          prodi: "Sistem Informasi Akuntansi",

          judul: "Usability Testing Sistem Informasi Akademik ",

          kontrak: "example.pdf",
          berkas: "exmaple.pdf",
          mitra: "Stmik Primakara",
          bidangFokus: "Sistem Informasi",
          dana: [
            {
              sumberDana: "Perguruan Tinggi",
              bentukDana: "In-Cash",
              jumlahDana: "4.000.000",
            },
          ],
          plot_reviewer: {
            reviewers: [
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
              {
                nama: "",
                nilai: 0,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
            ],
          },

          status: "Aprove",
        },

        {
          no: "4",
          tahun_akademik: "2019/2020-Ganjil",
          judul: "Perancangan Sistem Informasi Kinerja Dosen ",
          berkas: "exmaple.pdf",
          mitra: "Stmik Primakara",
          bidangFokus: "Sistem Informasi",
          dana: [
            {
              sumberDana: "Perguruan Tinggi",
              bentukDana: "In-Cash",
              jumlahDana: "4.000.000",
            },
          ],
          plot_reviewer: {
            reviewers: [
              {
                nama: "",
                nilai: 10,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
              {
                nama: "",
                nilai: 10,
                detailNilai: {
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
                          name: "indikator 2 ",
                          prefix_radio: "indikator 2 ",
                          bobot: "25",
                          nilai: 0,
                        },
                      ],
                    },
                  ],
                  keterangan: "",
                },
              },
            ],
          },

          status: "empty",
        },
      ],
    };
  },
  methods: {
    checkStatus(status, typeButton) {
      let sts = status.toLowerCase();
      if (sts == "aprove" && typeButton == "aprove") {
        return true;
      } else if (sts == "rejected" && typeButton == "rejected") {
        return true;
      } else if (
        (sts == "rejected" || sts == "aprove") &&
        typeButton == "cancel"
      ) {
        return true;
      } else if (sts == "empty" && typeButton != "cancel") {
        return true;
      }
      return false;
    },
    btnAprove(item) {
      item.status = "Aprove";
    },
    btnCancel(item) {
      item.status = "Empty";
    },
    btnRejected(item) {
      item.status = "Rejected";
    },
    detailData(item) {
      this.nilaiPopup = true;
      console.log(item);
      this.dataNilai = item.detailNilai.dataNilai;
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
    filterDataMasuk() {
      this.filterDataContentTable = this.contentTables;
    },
    filterBelumDiPlot() {
      this.filterDataContentTable = this.contentTables.filter(
        (c) =>
          c.plot_reviewer.reviewers[0].nama == "" ||
          c.plot_reviewer.reviewers[1].nama == ""
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
  mounted() {
    this.filterDataContentTable = this.contentTables;
  },
  computed: {
    countDataMasuk() {
      return this.contentTables.length;
    },
    countTelahDiPlot() {
      let data = this.contentTables.filter(
        (c) =>
          c.plot_reviewer.reviewers[0].nama != "" &&
          c.plot_reviewer.reviewers[1].nama != ""
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