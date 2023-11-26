<template>
  <!--begin::List Widget 9-->
  <div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header align-items-center border-0 mt-4">
      <h3 class="card-title align-items-start flex-column">
        <span class="font-weight-bolder text-dark"> {{ title }}</span>
        <span class="text-muted mt-3 font-weight-bold font-size-sm">
          {{ deskripsi }}
        </span>
      </h3>
    </div>
    <!--end::Header-->

    <!--begin::Body-->
    <div class="card-body pt-4">
      <div class="mt-3">
        <div class="timeline">
          <template v-for="(data, i) in timeline">
            <div :class="`container ${checkLeftRight(i)}`" :key="i">
              <v-icon class="icon">mdi-calendar-clock</v-icon>
              <div
                :class="
                  `content ${dateCalculation(
                    data.waktu_mulai.text,
                    data.waktu_akhir.text
                  )} `
                "
              >
                <h2>Jadwal {{ data.title }}</h2>
                <table>
                  <tr>
                    <td>{{ data.waktu_mulai.label }}</td>
                    <td>: {{ data.waktu_mulai.text }}</td>
                  </tr>
                  <tr>
                    <td>{{ data.waktu_akhir.label }}</td>
                    <td>: {{ data.waktu_akhir.text }}</td>
                  </tr>
                  <tr v-if="data.template">
                    <td>Download Template</td>
                    <td>
                      :
                      <a
                        href="./berkas/example.pdf"
                        target="_blank"
                        rel="noopener noreferrer"
                        >Contoh.pdf</a
                      >
                    </td>
                  </tr>
                  <tr>
                    <td colspan="2">{{ data.diff }}</td>
                  </tr>
                </table>
              </div>
            </div>
          </template>
        </div>
      </div>
      <!--end: Items-->
    </div>
  </div>
  <!--end: Card-->
  <!--end: List Widget 9-->
</template>
<style lang="css" scoped>
*,
*::before,
*::after {
  box-sizing: border-box;
}

body {
  margin: 1;
  font-family: Arial, Helvetica, sans-serif;
  background: #ffffff;
}

.timeline {
  position: relative;
  width: 100%;
  max-width: 1140px;
  margin: 0 auto;
  padding: 15px 0;
}

.timeline::after {
  content: "";
  position: absolute;
  width: 3px;
  background: #4e5e59;
  top: 0;
  bottom: 0;
  left: 50%;
  margin-left: -1px;
}

.container {
  padding: 15px 30px;
  position: relative;
  background: inherit;
  width: 50%;
}

.container.left {
  left: 0;
  margin-left: 0;
}

.container.right {
  left: 50%;
  margin-left: 0;
}

.container::after {
  content: "";
  position: absolute;
  width: 16px;
  height: 16px;
  top: calc(50% - 8px);
  right: -8px;
  background: #ffffff;
  border: 2px solid black;
  border-radius: 16px;
  z-index: 1;
}

.container.right::after {
  left: -8px;
}

.container::before {
  content: "";
  position: absolute;
  width: 50px;
  height: 2px;
  top: calc(50% - 1px);
  right: 8px;
  background: #000000;
  z-index: 1;
}

.container.right::before {
  left: 8px;
}

.container .date {
  position: absolute;
  display: inline-block;
  top: calc(50% - 8px);
  text-align: center;
  font-size: 14px;
  font-weight: bold;
  color: #000000;
  text-transform: uppercase;
  letter-spacing: 1px;
  z-index: 1;
}

.container.left .date {
  right: -75px;
}

.container.right .date {
  left: -75px;
}

.container .icon {
  position: absolute;
  display: inline-block;
  width: 40px;
  height: 40px;
  padding: 9px 0;
  top: calc(50% - 20px);
  background: #ffffff;
  border: 2px solid #000000;
  border-radius: 0px;
  text-align: center;
  font-size: 18px;
  color: #000000;
  z-index: 1;
}

.container.left .icon {
  right: 56px;
}

.container.right .icon {
  left: 56px;
}

.container .content {
  padding: 30px 90px 30px 30px;
  background: transparent;
  position: relative;
  border: 2px solid;
}

.container .passed {
  background-color: rgb(228, 112, 112);
}
.container .upcomming {
  background-color: rgb(232, 243, 76);
}
.container .process {
  background-color: rgb(0, 183, 255);
}
.container.right .content {
  padding: 30px 30px 30px 90px;
  border-radius: 0px;
}

.container .content h2 {
  margin: 0 0 10px 0;
  font-size: 18px;
  font-weight: normal;
  color: #000000;
}

.container .content p {
  margin: 0;
  font-size: 16px;
  line-height: 22px;
  color: #000000;
}

@media (max-width: 767.98px) {
  .timeline::after {
    left: 90px;
  }

  .container {
    width: 100%;
    padding-left: 120px;
    padding-right: 30px;
  }

  .container.right {
    left: 0%;
  }

  .container.left::after,
  .container.right::after {
    left: 82px;
  }

  .container.left::before,
  .container.right::before {
    left: 100px;
    border-color: transparent #000000 transparent transparent;
  }

  .container.left .date,
  .container.right .date {
    right: auto;
    left: 15px;
  }

  .container.left .icon,
  .container.right .icon {
    right: auto;
    left: 146px;
  }

  .container.left .content,
  .container.right .content {
    padding: 30px 30px 30px 90px;
    border-radius: 0;
  }
}
</style>
<script>
import { mapGetters } from "vuex";
export default {
  name: "CustomActivity",
  props: {
    title: String,
    deskripsi: String,
    dataTimeLine: Array,
  },
  data() {
    return {
      timeline: [],
    };
  },
  methods: {
    checkLeftRight(i) {
      return i != 0 && (i + 1) % 2 == 0 ? "right" : "left";
    },
    dateCalculation(start, end) {
      let dateStart = new Date(start);
      let dateEnd = new Date(end);
      let dateNow = new Date();
      if (dateStart > dateNow) {
        //upcomming
        return "upcomming";
      }
      if (dateStart < dateNow && dateEnd > dateNow) {
        //process
        return "process";
      }
      if (dateNow > dateEnd) {
        //passed
        return "passed";
      }
    },
    timeCalculation(start, end) {
      let dateNow = new Date();
      let diff = dateNow - dateNow;
      let dateStart = new Date(start);
      let dateEnd = new Date(end);
      dateNow = new Date();
      // console.log(dateStart, ":", dateEnd, ":", dateNow);
      if (dateStart > dateNow) {
        //upcomming
        diff = dateStart.getTime() - dateNow.getTime();
      }
      if (dateStart < dateNow && dateEnd > dateNow) {
        //process
        diff = dateNow.getTime() - dateEnd.getTime();
      }
      if (dateNow > dateEnd) {
        //passed
        diff = dateEnd.getTime() - dateEnd.getTime();
      }
      return diff;
    },
  },
  watch: {},
  computed: {
    ...mapGetters(["layoutConfig"]),
  },
  mounted() {
    setInterval(
      function() {
        this.timeline = [];
        this.dataTimeLine.forEach((value) => {
          let dataTemp = {
            title: "Penilaian Laporan Akhir",
            decription: "Pengajuan Laporan Akhir Penelitian dan Pengabdian",
            waktu_mulai: {
              label: "waktu mulai",
              text: "2021-12-20",
            },
            waktu_akhir: {
              label: "waktu akhir",
              text: "2022-01-30",
            },
            diff: "",
          };
          dataTemp.title = value.title;
          dataTemp.decription = value.deskription;
          dataTemp.waktu_mulai = value.waktu_mulai;
          dataTemp.waktu_akhir = value.waktu_akhir;

          let distance = this.timeCalculation(
            value.waktu_mulai.text,
            value.waktu_mulai.text
          );

          var days = Math.floor(distance / (1000 * 60 * 60 * 24));
          var hours = Math.floor(
            (distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60)
          );
          var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
          var seconds = Math.floor((distance % (1000 * 60)) / 1000);
          this.timeline.push(dataTemp);
          dataTemp.diff =
            days + "d " + hours + "h " + minutes + "m " + seconds + "s ";
        });
      }.bind(this),
      1000
    );
  },
};
</script>
