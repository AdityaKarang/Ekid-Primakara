<template>
  <div>
    <v-card flat>
      <div class="w-30 mr-2">
        <v-select :items="dataFilterTahunAkademikSemester" v-model="filterTahunAkademiks"
          label="Tahun Akademik"></v-select>
      </div>
    </v-card>
    <v-card flat>
      <div class="w-30 mr-2">
        <v-select :items="dataFilterSemester" v-model="filterSemester" label="Semester" @change="changeData"></v-select>
      </div>
    </v-card>
    <div class="card card-custom card-transparent">
      <div class="row">
        <div class="col-12 col-md-6" v-for="(diagram, i) in diagrams" :key="i">
          <apexchart :ref="diagram.ref" class="card-rounded-bottom" :options="diagram.chartOptions"
            :series="diagram.series"></apexchart>
        </div>
      </div>
    </div>
    <v-card flat>
      <CustomWidget2 title="Rekapitulasi" descritpion="List Data Rekapitulasi Dosen Yang Telah Diinputkan"
        :dataTabs="tabTable" :contentTable="contentTablesProposal" :isEdit="false" :isDetail="false">
      </CustomWidget2>
    </v-card>
  </div>
</template>
<style lang="scss">
@import "@/assets/sass/pages/wizard/wizard-4.scss";
</style>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomWidget2 from "@/view/content/CustomWidget2";
import axios from "axios";
import { mapGetters } from 'vuex';


export default {
  name: "Dashboard",
  components: {
    CustomWidget2,
  },

  data() {
    return {
      filterTahunAkademik: "2022/2023-ganjil",
      filterTahunAkademiks: "2022/2023",
      filterSemester: "ganjil",
      dataFilterTahunAkademikSemester: [
        "2022/2023",
        "2023/2024",
        "2024/2025",
      ],
      dataFilterSemester: [
        "ganjil",
        "genap",
      ],
      dataDiagram: [
        // {
        //   tahunAkademik: "2021/2022-ganjil",
        //   penelitian: [
        //     {
        //       type: "IF",
        //       prodi: "Infromatika(IF)",
        //       data: 30,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 10,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 10,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 10,
        //         },
        //       ],
        //       // jenisPublikasi: [
        //       //   {
        //       //     publikasi: "Buku",
        //       //     data: 1,
        //       //   },
        //       //   { publikasi: "Majalah", data: 7 },
        //       //   {
        //       //     publikasi: "Media Masa",
        //       //     data: 1,
        //       //   },
        //       //   {
        //       //     publikasi: "Jurnal",
        //       //     data: 1,
        //       //   },
        //       // ],
        //     },
        //     {
        //       type: "SI",
        //       prodi: "Sistem Informasi(SI)",
        //       data: 20,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 5,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 5,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 10,
        //         },
        //       ],
        //       // jenisPublikasi: [
        //       //   {
        //       //     publikasi: "Buku",
        //       //     data: 5,
        //       //   },
        //       //   { publikasi: "Majalah", data: 5 },
        //       //   {
        //       //     publikasi: "Media Masa",
        //       //     data: 5,
        //       //   },
        //       //   {
        //       //     publikasi: "Jurnal",
        //       //     data: 5,
        //       //   },
        //       // ],
        //     },
        //     {
        //       type: "SIA",
        //       prodi: "Sistem Informasi Akuntansi (SIA)",
        //       data: 10,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 3,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 3,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       // jenisPublikasi: [
        //       //   {
        //       //     publikasi: "Buku",
        //       //     data: 1,
        //       //   },
        //       //   { publikasi: "Majalah", data: 5 },
        //       //   {
        //       //     publikasi: "Media Masa",
        //       //     data: 2,
        //       //   },
        //       //   {
        //       //     publikasi: "Jurnal",
        //       //     data: 2,
        //       //   },
        //       // ],
        //     },
        //   ],
        //   pegabdian: [
        //     {
        //       type: "IF",

        //       prodi: "Infromatika(IF)",
        //       data: 40,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 20,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 10,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 10,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 5,
        //         },
        //         { publikasi: "Majalah", data: 10 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 10,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 15,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SI",

        //       prodi: "Sistem Informasi (SI)",
        //       data: 10,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 3,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 3,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 2,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 2,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 1,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SIA",

        //       prodi: "Sistem Informasi Akuntansi (SIA)",
        //       data: 15,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 5,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 6,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 4,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 3,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 3,
        //         },
        //       ],
        //     },
        //   ],
        // },

        // {
        //   tahunAkademik: "2021/2022-genap",
        //   penelitian: [
        //     {
        //       type: "IF",
        //       prodi: "Infromatika(IF)",
        //       data: 50,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 25,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 10,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 15,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 5,
        //         },
        //         { publikasi: "Majalah", data: 10 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 15,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 20,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SI",
        //       prodi: "Sistem Informasi(SI)",
        //       data: 20,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 5,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 5,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 10,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 5,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 5,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 5,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SIA",
        //       prodi: "Sistem Informasi Akuntansi (SIA)",
        //       data: 10,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 3,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 3,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 1,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 2,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 2,
        //         },
        //       ],
        //     },
        //   ],
        //   pegabdian: [
        //     {
        //       type: "IF",

        //       prodi: "Infromatika(IF)",
        //       data: 40,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 20,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 10,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 10,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 5,
        //         },
        //         { publikasi: "Majalah", data: 10 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 10,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 15,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SI",

        //       prodi: "Sistem Informasi (SI)",
        //       data: 10,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 3,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 3,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 2,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 2,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 1,
        //         },
        //       ],
        //     },
        //     {
        //       type: "SIA",

        //       prodi: "Sistem Informasi Akuntansi (SIA)",
        //       data: 15,
        //       bidangFokus: [
        //         {
        //           fokus: "technopreneur",
        //           data: 5,
        //         },
        //         {
        //           fokus: "IOT",
        //           data: 6,
        //         },
        //         {
        //           fokus: "Sistem Informasi",
        //           data: 4,
        //         },
        //       ],
        //       jenisPublikasi: [
        //         {
        //           publikasi: "Buku",
        //           data: 4,
        //         },
        //         { publikasi: "Majalah", data: 5 },
        //         {
        //           publikasi: "Media Masa",
        //           data: 3,
        //         },
        //         {
        //           publikasi: "Jurnal",
        //           data: 3,
        //         },
        //       ],
        //     },
        //   ],
        // },
      ],
      diagrams: [
        {
          ref: "prodi1",
          type: "penelitian",
          name: "prodi",
          series: [
            {
              name: "Teknik Informatika",
              data: [50, 100, 50, 30, 40],
            },
            {
              name: "Sistem Informasi",

              data: [20, 10, 50, 10, 30],
            },
            {
              name: "Sistem Informasi Akuntansi",
              data: [10, 5, 50, 10, 30],
            },
          ],
          chartOptions: {
            chart: {
              type: "bar",
              height: 700,
            },
            plotOptions: {
              bar: {
                dataLabels: {
                  position: "top",
                },
                horizontal: true,
              },
            },
            dataLabels: {
              enabled: true,
              offsetX: -6,
              style: {
                fontSize: "10px",
                colors: ["#fff"],
              },
            },
            title: {
              text: "Penelitian",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan periode dan prodi",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },

            xaxis: {
              categories: [
                "2022/2023-ganjil",
                "2022/2023-genap",
                "2023/2024-ganjil",
                "2023/2024-genap",
                "2024/2025-ganjil",
                "2024/2025-genap",
              ],
            },
          },
        },
        {
          ref: "prodi2",
          type: "pengabdian",
          name: "prodi",

          series: [
            {
              name: "Teknik Informatika",
              data: [50, 30, 50, 40, 20],
            },
            {
              name: "Sistem Informasi",
              data: [20, 10, 40, 10, 20],
            },
            {
              name: "Sistem Informasi Akuntansi",
              data: [10, 5, 50, 20, 10],
            },
          ],
          chartOptions: {
            chart: {
              type: "bar",
              height: 700,
            },
            plotOptions: {
              bar: {
                horizontal: true,
                dataLabels: {
                  position: "top",
                },
              },
            },
            dataLabels: {
              enabled: true,
              offsetX: -6,
              style: {
                fontSize: "10px",
                colors: ["#fff"],
              },
            },
            title: {
              text: "Pengabdian",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan periode dan prodi",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },

            xaxis: {
              categories: [
              "2022/2023-ganjil",
                "2022/2023-genap",
                "2023/2024-ganjil",
                "2023/2024-genap",
                "2024/2025-ganjil",
                "2024/2025-genap",
              ],
            },
          },
        },
        {
          ref: "bidangfokus_if",
          type: "penelitian",
          name: "bidang_fokus_IF",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "50%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Penelitian IF",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan bidang fokus",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },
        {
          type: "pengabdian",
          name: "pengabdian_bidang_fokus_IF",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "100%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Pengabdian IF",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan bidang fokus",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },
        {
          type: "penelitian",
          name: "bidang_fokus_SI",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "100%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Penelitian SI",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan bidang fokus",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },
        {
          type: "pengabdian",
          name: "pengabdian_bidang_fokus_SI",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "100%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Pengabdian SI",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan bidang fokus",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },
        {
          type: "penelitian",
          name: "bidang_fokus_SIA",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "100%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Penelitian SIA",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan tahun akademik dan prodi",

              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },
        {
          type: "pengabdian",
          name: "bidang_fokus_SIA",
          series: [0,0,0],
          chartOptions: {
            chart: {
              width: "100%",
              type: "pie",
            },
            labels: ["Technopreneur", "IOT", "Data Mining"],
            title: {
              text: "Pengabdian SIA",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 0,
              floating: false,
              style: {
                fontSize: "14px",
                fontWeight: "bold",
                fontFamily: "roboto",
                color: "#263238",
              },
            },
            subtitle: {
              text: "berdasarkan bidang fokus",
              align: "left",
              margin: 10,
              offsetX: 0,
              offsetY: 20,
              floating: false,
              style: {
                fontSize: "12px",
                fontWeight: "normal",
                fontFamily: "roboto",
                color: "#9699a2",
              },
            },
            responsive: [
              {
                breakpoint: 480,
                options: {
                  chart: {
                    width: 200,
                  },
                  legend: {
                    position: "bottom",
                  },
                },
              },
            ],
          },
        },

        // {
        //   type: "penelitian",
        //   name: "jenis_publikasi_IF",

        //   series: [4, 55, 10, 30],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Penelitian IF",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "berdasarkan jenis publikasi",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
        // {
        //   type: "pengabdian",
        //   name: "jenis_publikasi_IF",
        //   series: [44, 5, 13, 43],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Pengabdian IF",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "berdasarkan tahun akademik dan prodi",

        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
        // {
        //   type: "penelitian",
        //   name: "jenis_publikasi_SI",

        //   series: [4, 55, 10, 30],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Penelitian SI",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "berdasarkan jenis publikasi",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
        // {
        //   type: "pengabdian",
        //   name: "jenis_publikasi_SI",
        //   series: [44, 5, 13, 43],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Pengabdian SI",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "berdasarkan jenisi pulbikasi",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
        // {
        //   type: "penelitian",
        //   name: "jenis_publikasi_SIA",

        //   series: [4, 55, 10, 30],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Jenis Publikasi Penelitian SIA",

        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
        // {
        //   type: "pengabdian",
        //   name: "jenis_publikasi_SIA",
        //   series: [44, 5, 13, 43],
        //   chartOptions: {
        //     chart: {
        //       width: "100%",
        //       type: "pie",
        //     },
        //     labels: ["Buku", "Majalan", "Media Masa", "Jurnal"],
        //     title: {
        //       text: "Jenis Publikasi Pengabdian SIA",

        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 0,
        //       floating: false,
        //       style: {
        //         fontSize: "14px",
        //         fontWeight: "bold",
        //         fontFamily: "roboto",
        //         color: "#263238",
        //       },
        //     },
        //     subtitle: {
        //       text: "",
        //       align: "left",
        //       margin: 10,
        //       offsetX: 0,
        //       offsetY: 20,
        //       floating: false,
        //       style: {
        //         fontSize: "12px",
        //         fontWeight: "normal",
        //         fontFamily: "roboto",
        //         color: "#9699a2",
        //       },
        //     },
        //     responsive: [
        //       {
        //         breakpoint: 480,
        //         options: {
        //           chart: {
        //             width: 200,
        //           },
        //           legend: {
        //             position: "bottom",
        //           },
        //         },
        //       },
        //     ],
        //   },
        // },
      ],
      tabTable: ["penelitian", "pengabdian"],
      contentTablesProposal: [
        {
          name: "penelitian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                // filter: (f) => {
                //   if (!this.filterTahunAkademik) return true;
                //   return (f + "")
                //     .toLowerCase()
                //     .includes(this["filterTahunAkademik"].toLowerCase());
                // },
              },
            ],
            content: [],
          },
          aksi: {
            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-proposal-detail",
                params: { data: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-proposal",
                params: { data: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),
          },
        },
        {
          name: "pengabdian",
          data: {
            headers: [
              { text: "No", value: "no", width: "70px" },
              { text: "Nama", value: "nama" },
              { text: "Judul", value: "judul" },
              {
                text: "Tahun Akademik",
                value: "tahun_ajaran",
                width: "130px",
                sortable: false,
                // filter: (f) => {
                //   if (!this.filterTahunAkademik) return true;
                //   return (f + "")
                //     .toLowerCase()
                //     .includes(this["filterTahunAkademik"].toLowerCase());
                // },
              },
            ],
            content: [
          
            ],
          },
          aksi: {
            edit: function (item) {
              console.log(item);
              this.$router.push({
                name: "detail-proposal",
                params: { data: item, tabName: "Proposal Penelitan" },
              });
            }.bind(this),

            detail: function (item) {
              console.log(item);
              this.$router.push({
                name: "rekapitulasi-proposal-detail",
                params: { data: item, tabName: "Proposal Pengabdian" },
              });
            }.bind(this),
          },
        },
      ],
    };
  },
  methods: {

    fetchDataPenelitian() {
  axios.post('http://localhost:8000/api/penelitian-diagram', {
    tahun_akademik: this.filterTahunAkademiks,
    semester: this.filterSemester,
  })
    .then(response => {
      console.log(response.data);
      if (Array.isArray(response.data)) {
        this.dataDiagram = response.data;
      } else {
        // Convert the non-array response to an array
        this.dataDiagram = [response.data];
      }
      console.log(this.dataDiagram);
      this.changeData(); // Panggil fungsi changeData setelah data diperbarui

    })
    .catch(error => {
      console.log(error);
    });
    },
    changeData() {
      this.filterTahunAkademik = this.filterTahunAkademiks + "-" + this.filterSemester;
      this.diagrams.forEach((diagram) => {
        diagram.series = this.setDataDiagram(diagram.name, diagram.type);
        if (diagram.chartOptions.xaxis) {
          diagram.chartOptions.xaxis.categories = this.setAxsist();
          diagram.chartOptions.chart.height = 200;
          console.log(this.$refs.prodi1);
          if (diagram.ref === "prodi1") {
            this.$refs.prodi1[0].updateOptions(diagram.chartOptions);
          } else if (diagram.ref === "prodi2") {
            this.$refs.prodi2[0].updateOptions(diagram.chartOptions);
          }
        }
      });


      console.log(this.diagrams);
    },
    setAxsist() {
      return [this.filterTahunAkademik];
    },
    setDataDiagram(nameDiagram, type) {

      let data = this.dataDiagram.find((d) => {
        return d.tahunAkademik == this.filterTahunAkademik;
      });
      console.log(data);
      let series = [];
      if (!data) {
        console.log("data not found");
        return [];
      }
      if (type == "penelitian") {
        data.penelitian.forEach((d) => {
          if (nameDiagram == "prodi") {
            console.log("Debug: ", d.prodi, d.data);
            series.push({ name: d.prodi, data: [d.data] });
          } else if (nameDiagram == "bidang_fokus_IF" && d.type == "IF") {
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "bidang_fokus_SI" && d.type == "SI") {
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "bidang_fokus_SIA" && d.type == "SIA") {
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "jenis_publikasi_IF" && d.type == "IF") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          } else if (nameDiagram == "jenis_publikasi_SI" && d.type == "SI") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          } else if (nameDiagram == "jenis_publikasi_SIA" && d.type == "SIA") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          }
        });
        return series;
      }
      if (type == "pengabdian") {
        console.log("pengabdian");
        data.pengabdian.forEach((d) => {
          // console.log(d.type, nameDiagram);
          if (nameDiagram == "prodi") {
            // console.log(d.prodi);
            series.push({ name: d.prodi, data: [d.data] });
          } else if (
            nameDiagram == "pengabdian_bidang_fokus_IF" &&
            d.type == "IF"
          ) {
            console.log("masuk bidan fokus if");
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "bidang_fokus_SI" && d.type == "SI") {
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "bidang_fokus_SIA" && d.type == "SIA") {
            d.bidangFokus.forEach((f) => {
              series.push(f.data);
            });
          } else if (nameDiagram == "jenis_publikasi_IF" && d.type == "IF") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          } else if (nameDiagram == "jenis_publikasi_SI" && d.type == "SI") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          } else if (nameDiagram == "jenis_publikasi_SIA" && d.type == "SIA") {
            d.jenisPublikasi.forEach((p) => {
              series.push(p.data);
            });
          }
        });
      }
      console.log("series ", nameDiagram, series);
      return series;
    },
    fetchPenelitian() {
      axios.get('http://localhost:8000/api/penelitian').then(res => {
        console.log("API Response:", res.data.data); // Log the API response

        this.contentTablesProposal[0].data.content = res.data.data
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
            };
          });

        console.log("Content Tables:",  this.contentTablesProposal[0]); // Log the updated contentTables array
        this.loading = false; // Set loading to false when data is fetched
      })
      .catch(error => {
      console.error("Error fetching data:", error);
      this.loading = false; // Set loading to false in case of an error
    });
    
    },
    fetchPengabdian() {
      axios.get('http://localhost:8000/api/pengabdian').then(res => {
        console.log("API Response:", res.data.data); // Log the API response

        this.contentTablesProposal[1].data.content = res.data.data
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              nama: bf.name_user,
              judul: bf.judul,
              tahun_ajaran: bf.tahun_akademik,
            };
          });

        console.log("Content Tables:",  this.contentTablesProposal[1]); // Log the updated contentTables array
        this.loading = false; // Set loading to false when data is fetched
      })
      .catch(error => {
      console.error("Error fetching data:", error);
      this.loading = false; // Set loading to false in case of an error
    });
    
    },
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user; // Make sure 'user' is the correct property
    },
  },
  mounted() {
    this.fetchDataPenelitian();
    this.changeData();
    this.fetchPenelitian();
    this.fetchPengabdian();
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Dashboard" }]);
    console.log('Current User:', this.currentUser);
  },
};
</script>
