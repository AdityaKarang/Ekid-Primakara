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
      <slot name="toolbar"></slot>
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
              <b-form-input id="input-search" v-model="search" append-icon="search" placeholder="Search"></b-form-input>
              <!-- <b-input-group-append>
                <b-button variant="primary">Search</b-button>
              </b-input-group-append> -->
            </b-input-group>
          </div>
        </div>
        <div class="d-flex justify-content-end">
          <slot name="additioalFilter"></slot>
        </div>
        <!--begin::Table-->
        <v-data-table :headers="headers" :items="contentTable" :search="search" :loading="loading">
          <template v-slot:[`item.proses`]="{ item }">
            <td class="text-right">
              <span class="label label-lg label-inline" v-bind:class="`label-light-${changeProses(item)}`">
                {{ item.proses }}
              </span>
            </td>
            <slot name="Status"></slot>
          </template>
          <template v-slot:[`item.status`]="{ item }">
            <td class="text-right">
              <span class="label label-lg label-inline" v-bind:class="`label-light-${changeStatus(item)}`">
                {{ item.status }}
              </span>
            </td>
            <slot name="Status"></slot>
          </template>
          <template v-slot:[`item.ket`]="{ item }">
            <td class="text-right">
              <span class="label label-lg label-inline" v-bind:class="`label-light-${changeKet(item)}`">
                {{ item.ket }}
              </span>
            </td>
            <slot name="Status"></slot>
          </template>

          <template v-slot:[`item.berkas`]="{ item }">
            <template v-if="item.berkas">
              <a :href="getFileUrl(item.berkas, item.tipe)" target="__blank">
                <!-- <a :href="getBerkasUrl(item.berkas)" target="__blank"> -->
                <i class="flaticon-file-2 text-primary"></i>
              </a>
            </template>
          </template>
          <template v-slot:[`item.kontrak`]="{ item }">
            <template v-if="item.kontrak">
              <a :href="getKontrakUrl(item.kontrak, item.tipe)" target="__blank">
                <i class="flaticon-file-2 text-primary"></i>
              </a>
            </template>
          </template>
          <template v-slot:[`item.proposal`]="{ item }">
            <template v-if="item.proposal">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-icon dark small v-bind="attrs" v-on="on" @click="proposal(item)"
                    :color="checkStatus(item.proposal).buttonColor">{{ checkStatus(item.proposal).icon }}</v-icon>
                </template>
                <span> {{ getTooltip(item.proposal.status) }}</span>
              </v-tooltip>
            </template>
          </template>

          <template v-slot:[`item.kemajuan`]="{ item }">
            <template v-if="item.kemajuan">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-icon dark small v-bind="attrs" v-on="on" @click="kemajuan(item)"
                    :color="checkStatus(item.kemajuan).buttonColor">{{ checkStatus(item.kemajuan).icon }}</v-icon>
                </template>
                <span> {{ getTooltip(item.kemajuan.status) }}</span>
              </v-tooltip>
            </template>
          </template>
          <template v-slot:[`item.akhir`]="{ item }">
            <template v-if="item.akhir">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-icon dark small v-bind="attrs" v-on="on" @click="akhir(item)"
                    :color="checkStatus(item.akhir).buttonColor">{{ checkStatus(item.akhir).icon }}</v-icon>
                </template>
                <span> {{ getTooltip(item.akhir.status) }}</span>
              </v-tooltip>
            </template>
          </template>
          <template v-slot:[`item.publikasi`]="{ item }">
            <template v-if="item.publikasi">
              <v-tooltip top>
                <template v-slot:activator="{ on, attrs }">
                  <v-icon dark small v-bind="attrs" v-on="on" @click="publikasi(item)"
                    :color="checkStatus(item.publikasi).buttonColor">{{ checkStatus(item.publikasi).icon }}</v-icon>
                </template>
                <span> {{ getTooltip(item.publikasi.status) }}</span>
              </v-tooltip>
            </template>
          </template>
          <!-- plot tim reviewer begin  -->
          <!-- <template v-slot:[`item.plot_reviewer`]="{ item }">
            <template v-if="item.plot_reviewer">
              <div class="d-flex flex-column mt-2">
                <v-tooltip
                  top
                  v-for="(reviewer, i) in item.plot_reviewer.reviewers"
                  :key="i"
                >
                  <template v-slot:activator="{ on, attrs }">
                    <v-autocomplete
                      v-model="reviewer.nama"
                      :items="additionalData.timReviewer"
                      :label="`Reviewer ${i + 1}`"
                      v-on="on"
                      v-bind="attrs"
                    ></v-autocomplete>
                  </template>

                  <span v-if="reviewer.nama">{{ reviewer.nama }}</span>
                  <span v-else>data kosong</span>
                </v-tooltip>
              </div>
            </template>
          </template> -->

          <template v-slot:[`item.plot_reviewer`]="{ item }">
  <template v-if="item.plot_reviewer">
    <div class="d-flex flex-column mt-2">
      <v-dialog v-model="item.dialog" max-width="500px">
        <template v-slot:activator="{ on }">
          <v-icon color="light-blue lighten-1" dark v-on="on">mdi-account-edit</v-icon>
        </template>
        <v-card>
          <v-card-title>Daftar Reviewer</v-card-title>
          <v-card-text>
            <v-row>
              <v-col cols="6">
                <v-autocomplete v-model="item.reviewer_1" :items="additionalData.timReviewer"
                  :label="`Reviewer 1`" item-text="name" item-value="id">
                </v-autocomplete>
              </v-col>
              <v-col cols="6">
                <v-autocomplete v-model="item.reviewer_2" :items="additionalData.timReviewer"
                  :label="`Reviewer 2`" item-text="name" item-value="id">
                </v-autocomplete>
              </v-col>
            </v-row>
          </v-card-text>
          <v-card-actions>
            <v-btn color="primary" text @click="saveReviewers(item)" :disabled="!isSaveButtonEnabled(item)">Simpan</v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </div>
  </template>
</template>

          <template v-slot:[`item.reviewer`]="{ item }">
            <template v-if="item.reviewer">
              <div class="d-flex flex-column mt-2">
                <div class="d-flex" v-for="(reviewer, i) in item.reviewer.reviewers" :key="i">
                  <v-text-field v-model="reviewer.name" :label="`Reviewer ${i + 1}`" item-text="name"
                    readonly></v-text-field>
                </div>
              </div>
            </template>
          </template>

          <template v-slot:[`item.plot_reviewer_nilai`]="{ item }">
            <template v-if="item.plot_reviewer">
              <div class="d-flex flex-column mt-2">
                <div class="d-flex" v-for="(reviewer, i) in item.plot_reviewer.reviewers" :key="i">
                  <v-text-field v-model="reviewer.nilai" :label="`Nilai ${i + 1}`" disabled></v-text-field>
                  <slot name="detailnilai" :item="reviewer"></slot>
                </div>
              </div>
            </template>
          </template>
          <template v-slot:[`item.rata_rata`]="{ item }">
            <template v-if="item.plot_reviewer">
              {{ rataRataNilai(item.plot_reviewer.reviewers) }}
            </template>
          </template>

          <!-- plot tim  reviewer end -->
          <template v-slot:[`item.detail`]="{ item }">
            <div class="d-flex">
              <v-icon small color="warning" v-if="isEdit" class="mr-2" @click="editItem(item)">
                mdi-pencil
              </v-icon>
              <v-icon color="success" small v-if="isDetail" class="mr-2" @click="detailItem(item)">
                mdi-eye
              </v-icon>
              <v-icon color="error" small v-if="isDelete" class="mr-2" @click="deleteItem(item)">
                mdi-delete
              </v-icon>
            </div>
            <slot name="Detail" :item="item"></slot>
          </template>
          <template v-slot:[`item.customAksi`]="{ item }">
            <slot name="customAksi" :item="item"></slot>
          </template>
        </v-data-table>
        <!--end::Table-->
      </div>
    </div>
  </div>
</template>
<script>
import axios from "axios";

export default {
  name: "CustomCard",
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
      reviewerTmp: [],
      dialog: false,
      loading: false,
      selectedReviewer1: null,
      selectedReviewer2: null,
    };
  },
  methods: {
    saveReviewers(item) {
    // Periksa apakah kedua reviewer telah dipilih dan tidak sama
    if (item.reviewer_1 && item.reviewer_2 && item.reviewer_1 !== item.reviewer_2) {
      // Lakukan logika penyimpanan di sini
      // ...
      // Tutup dialog jika perlu
      item.dialog = false;
    } else {
      // Tampilkan pesan kesalahan atau tangani kasus di mana reviewer tidak dipilih atau sama
      console.error("Pemilihan tidak valid. Reviewer harus berbeda dan keduanya harus dipilih.");
    }
  },

  isSaveButtonEnabled(item) {
    // Aktifkan tombol jika kedua reviewer telah dipilih dan tidak sama
    return item.reviewer_1 && item.reviewer_2 && item.reviewer_1 !== item.reviewer_2;
  },

    getFileUrl(berkas, tipe) {
      let baseUrl = "";
      if (tipe === "penelitian") {
        baseUrl = "http://localhost:8000/storage/penelitian/proposal/";
      } else if (tipe === "kemajuanpenelitian") {
        baseUrl = "http://localhost:8000/storage/penelitian/laporan/";
      } else if (tipe === "akhirpenelitian") {
        baseUrl = "http://localhost:8000/storage/pengabdian/laporan/";
      } else if (tipe === "pengabdian") {
        baseUrl = "http://localhost:8000/storage/pengabdian/proposal/";
      } else if (tipe === "kemajuanpengabdian") {
        baseUrl = "http://localhost:8000/storage/pengabdian/laporan/";
      } else if (tipe === "akhirpengabdian") {
        baseUrl = "http://localhost:8000/storage/pengabdian/laporan/";
      }
      return baseUrl + berkas;
    },
    getKontrakUrl(kontrak, tipe) {
      let baseUrl = "";
      if (tipe === "penelitian") {
        baseUrl = "http://localhost:8000/storage/penelitian/kontrak/";
      } else if (tipe === "pengabdian") {
        baseUrl = "http://localhost:8000/storage/pengabdian/kontrak/";
      } 
      return baseUrl + kontrak;
    },

    saveReviewers(item) {
      this.$emit("saveReviewers", item);
    },
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
    proposal(item) {
      this.$emit("onProposal", item);
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
    getTooltip(status) {
      console.log(status);
      if (status == "aprove" || status == "success") {
        return "Success";
      }
      if (status == "rejected") {
        return "Reject";
      }
      if (status == "revisi") {
        return "Revisi";
      }
      if (status == "empty") {
        return "Input";
      }
      if (status == "waiting") {
        return "Waiting";
      }
    },
    changeStatus(item) {
      if (item.status == "Aproved") {
        return "success";
      } else if (item.status == "Draft") {
        return "primary";
      } else if (item.status == "Revisi") {
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
    changePenilaian(item) {
      if (item.penilaian == "Waiting") {
        return "primary";
      } else if (item.penilaian == "Selesai") {
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
      } else if (item.status == "revisi") {
        return {
          icon: "mdi-pencil-circle-outline",
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
  mounted() { },
};
</script>