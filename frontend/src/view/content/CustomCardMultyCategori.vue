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
          {{ deskripsi }}
        </span>
      </h3>
      <template v-if="isTopAction">
        <div class="card-toolbar">
          <ul class="nav nav-pills nav-pills-sm nav-dark-75">
            <li class="nav-item">
              <button class="btn btn-primary" @click="changed(true)">
                <i class="menu-icon flaticon2-add-1"></i> Tambah
              </button>
            </li>
          </ul>
        </div>
      </template>
    </div>
    <!--end::Header-->
    <!--begin::Body-->
    <div class="card-body pt-3 pb-0">
      <div class="d-flex flex-column">
        <div class="d-flex justify-content-end">
          <slot name="filter"></slot>
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
        <v-data-table :headers="headers" :items="contentTable" :search="search">
          <template slot="item" slot-scope="props">
            <slot name="customdata" :props="props"></slot>
          </template>
        </v-data-table>
        <!--end::Table-->
      </div>
    </div>
  </div>
</template>
<script>
export default {
  name: "CustomCardMultyCategori",
  props: {
    title: String,
    deskripsi: String,
    headers: Array,
    contentTable: Array,
    additionalData: Object,
    isTopAction: {
      type: Boolean,
      default: true,
    },
    isEdit: {
      type: Boolean,
      default: true,
    },
    isDelete: {
      type: Boolean,
      default: true,
    },
    isDetail: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      search: "",
    };
  },
  methods: {
    detailItem(item) {
      this.$emit("detailItem", item);
    },

    deleteItem(item) {
      this.$emit("deleteItem", item);
    },
    editItem(item) {
      this.$emit("editItem", item);
    },
    changed(value) {
      this.$emit("addNew", value);
    },
    kemajuan(item) {
      this.$emit("onKemajuan", item);
    },
    akhir(item) {
      this.$emit("onAkhir", item);
    },
    publikasi(item) {
      this.$emit("onPublikasi", item);
    },

    changeStatus(item) {
      if (item.status == "Aproved") {
        return "success";
      } else if (item.status == "Draft") {
        return "primary";
      } else if (item.status == "Submited") {
        return "warning";
      } else {
        return "danger";
      }
    },
    changeProses(item) {
      if (item.proses == "InProgress") {
        return "primary";
      } else if (item.proses == "Selesai") {
        return "success";
      } else {
        return "danger";
      }
    },
    changeKet(item) {
      if (item.ket == "Valid") {
        return "success";
      } else if (item.ket == "Waiting") {
        return "warning";
      } else {
        return "danger";
      }
    },
    checkStatus(item) {
      if (item.status == "aprove" || item.status == "success") {
        return {
          icon: "mdi-check-circle-outline",
          buttonColor: "green lighten-1",
        };
      } else if (item.status == "rejected") {
        return {
          icon: "mdi-close-circle-outline",
          buttonColor: "red lighten-1",
        };
      } else if (item.status == "empty") {
        return {
          icon: "mdi-plus-circle-outline",
          buttonColor: "light-blue lighten-1",
        };
      } else if (item.status == "waiting") {
        return {
          icon: "mdi-calendar-clock",
          buttonColor: "yellow lighten-1",
        };
      }
    },
    rataRataNilai(array) {
      let rata = 0;
      array.forEach((e) => {
        rata += e.nilai;
      });
      console.log(rata);
      return rata / array.length;
    },
  },
  mounted() {},
};
</script>