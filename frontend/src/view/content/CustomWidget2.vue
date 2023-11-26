<template>
  <!--begin::Advance Table Widget 2-->
  <div class="card card-custom card-stretch gutter-b">
    <!--begin::Header-->
    <div class="card-header border-0 pt-5">
      <h3 class="card-title align-items-start flex-column">
        <span class="card-label font-weight-bolder text-dark">
          {{ title }}
        </span>
        <span class="text-muted mt-3 font-weight-bold font-size-sm">
          {{ descritpion }}
        </span>
      </h3>
      <div class="card-toolbar">
        <ul class="nav nav-pills nav-pills-sm nav-dark-75">
          <li class="" v-for="(tab, i) in dataTabs" :key="'tab_' + i">
            <a
              class="nav-link py-2 px-4"
              data-toggle="tab"
              :class="{ active: show === tab }"
              @click="show = tab"
              >{{ tab }}</a
            >
          </li>
        </ul>
      </div>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-3 pb-0">
      <div class="d-flex flex-column">
        <div class="d-flex justify-content-end">
          <slot name="filter"></slot>
          <div class="w-30">
            <b-input-group class="mt-3" v-if="getData().addAction">
              <v-btn color="success" small @click="getData().addAction()"
                ><v-icon>mdi-plus</v-icon> Tambah Jadwal Baru
              </v-btn>
            </b-input-group>
          </div>
          <div class="w-30">
            <b-input-group class="mt-3">
              <b-form-input
                id="input-search"
                v-model="search"
                append-icon="search"
                placeholder="Search"
              ></b-form-input>
              <!-- <b-input-group-append>
                <b-button variant="primary">Search</b-button>
              </b-input-group-append> -->
            </b-input-group>
          </div>
        </div>
        <!--begin::Table-->
        <v-data-table
          :headers="getData().data.headers"
          :items="getData().data.content"
          :search="search"
        >
          <template v-slot:[`item.aksi`]="{ item }">
            <div class="d-flex">
              <v-icon
                small
                color="warning"
                class="mr-2"
                v-if="isDetail"
                @click="getData().aksi.detail(item)"
              >
                mdi-eye
              </v-icon>
              <v-icon
                small
                color="warning"
                class="mr-2"
                v-if="isEdit"
                @click="getData().aksi.edit(item)"
              >
                mdi-pencil
              </v-icon>
            </div>
            <slot name="aksi" :data="getData()" :item="item"></slot>
          </template>
          <template v-slot:[`item.tahun_ajaran_semester`]="{ item }">
            <td>{{ item.tahun_ajaran + "/" + item.semester }}</td>
          </template>
          <template v-slot:[`item.status`]="{ item }">
            <td class="text-right">
              <span
                class="label label-lg label-inline"
                v-bind:class="`label-light-${changeStatus(item)}`"
              >
                {{ item.status }}
              </span>
            </td>
            <slot name="Status"></slot>
          </template>
        </v-data-table>
        <!--end::Table-->
      </div>
    </div>
    <!--end::Body-->
    <!--end::Advance Table Widget 2-->
  </div>
</template>

<script>
import { mapGetters } from "vuex";

export default {
  name: "CustomWidget2",
  props: {
    title: String,
    descritpion: String,
    contentTable: Array,
    dataTabs: Array,
    isEdit: { type: Boolean, default: true },
    isDetail: { type: Boolean, default: true },
    isDelete: { type: Boolean, default: true },
  },
  data() {
    return {
      show: "penelitian",
      search: "",
      month: [
        {
          text0: "media/svg/misc/015-telegram.svg",
          text1: "Application Development",
          text2: "app@dev.com",
          text3: "$4,600,000",
          text4: "Python, MySQL",
          text5: "In Progress",
          text6: "warning",
        },
        {
          text0: "media/svg/misc/006-plurk.svg",
          text1: "Sant Outstanding",
          text2: "bprow@bnc.cc",
          text3: "$2,000,000",
          text4: "ReactJs, HTML",
          text5: "Approved",
          text6: "primary",
        },
        {
          text0: "media/svg/misc/003-puzzle.svg",
          text1: "Payrol Application",
          text2: "company@dev.com",
          text3: "$560,000",
          text4: "Laravel, Metronic",
          text5: "Success",
          text6: "success",
        },
        {
          text0: "media/svg/misc/005-bebo.svg",
          text1: "HR Management System",
          text2: "hr@demo.com",
          text3: "$57,000",
          text4: "AngularJS, C#",
          text5: "Rejected",
          text6: "danger",
        },
        {
          text0: "media/svg/misc/014-kickstarter.svg",
          text1: "KTR Mobile Application",
          text2: "ktr@demo.com",
          text3: "$45,200,000",
          text4: "ReactJS, Ruby",
          text5: "In Progress",
          text6: "warning",
        },
      ],
      week: [
        {
          text0: "media/svg/misc/014-kickstarter.svg",
          text1: "KTR Mobile Application",
          text2: "ktr@demo.com",
          text3: "$45,200,000",
          text4: "ReactJS, Ruby",
          text5: "In Progress",
          text6: "warning",
        },
        {
          text0: "media/svg/misc/006-plurk.svg",
          text1: "Sant Outstanding",
          text2: "bprow@bnc.cc",
          text3: "$2,000,000",
          text4: "ReactJs, HTML",
          text5: "Approved",
          text6: "primary",
        },
        {
          text0: "media/svg/misc/015-telegram.svg",
          text1: "Application Development",
          text2: "app@dev.com",
          text3: "$4,600,000",
          text4: "Python, MySQL",
          text5: "In Progress",
          text6: "warning",
        },
        {
          text0: "media/svg/misc/003-puzzle.svg",
          text1: "Payrol Application",
          text2: "company@dev.com",
          text3: "$560,000",
          text4: "Laravel, Metronic",
          text5: "Success",
          text6: "success",
        },
        {
          text0: "media/svg/misc/005-bebo.svg",
          text1: "HR Management System",
          text2: "hr@demo.com",
          text3: "$57,000",
          text4: "AngularJS, C#",
          text5: "Rejected",
          text6: "danger",
        },
      ],
      day: [
        {
          text0: "media/svg/misc/003-puzzle.svg",
          text1: "Payrol Application",
          text2: "company@dev.com",
          text3: "$560,000",
          text4: "Laravel, Metronic",
          text5: "Success",
          text6: "success",
        },
        {
          text0: "media/svg/misc/006-plurk.svg",
          text1: "Sant Outstanding",
          text2: "bprow@bnc.cc",
          text3: "$2,000,000",
          text4: "ReactJs, HTML",
          text5: "Approved",
          text6: "primary",
        },
        {
          text0: "media/svg/misc/015-telegram.svg",
          text1: "Application Development",
          text2: "app@dev.com",
          text3: "$4,600,000",
          text4: "Python, MySQL",
          text5: "In Progress",
          text6: "warning",
        },
        {
          text0: "media/svg/misc/005-bebo.svg",
          text1: "HR Management System",
          text2: "hr@demo.com",
          text3: "$57,000",
          text4: "AngularJS, C#",
          text5: "Rejected",
          text6: "danger",
        },
        {
          text0: "media/svg/misc/014-kickstarter.svg",
          text1: "KTR Mobile Application",
          text2: "ktr@demo.com",
          text3: "$45,200,000",
          text4: "ReactJS, Ruby",
          text5: "In Progress",
          text6: "warning",
        },
      ],
    };
  },
  components: {},
  methods: {
    addData() {
      this.$emit("addAction");
    },
    getData() {
      if (!this.contentTable) return;

      return this.contentTable.find((d) => {
        return d.name == this.show;
      });
    },
    changeStatus(item) {
      if (item.status == "Selesai") {
        return "success";
      } else if (item.status == "Waiting") {
        return "warning";
      } else {
        return "danger";
      }
    },
  },

  computed: {
    ...mapGetters(["layoutConfig"]),
    hasAddAction() {
      return this.$listeners && this.$listeners.addAction;
    },
  },
  mounted() {},
};
</script>
