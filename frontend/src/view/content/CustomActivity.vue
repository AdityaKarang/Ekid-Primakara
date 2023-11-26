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
      <div class="timeline timeline-6 mt-3">
        <template v-for="(item, i) in list">
          <!--begin::Item-->
          <div class="timeline-item align-items-start" v-bind:key="i">
            <!--begin::Label-->
            <div
              class="
                timeline-label
                font-weight-bolder
                text-dark-75
                font-size-lg
                mr-2
              "
            >
              {{ item.activity }}
            </div>
            <!--end::Label-->

            <!--begin::Badge-->
            <div class="timeline-badge">
              <i
                class="icon-xl"
                v-bind:class="CheckStatus(item.status).badge"
              ></i>
            </div>
            <!--end::Badge-->

            <!--begin::Text-->
            <div
              class="
                font-weight-mormal font-size-lg
                timeline-content
                text-muted
                pl-3
              "
            >
              <b-link
                v-bind:class="{
                  'font-weight-bolder text-dark-75': CheckStatus(item.status)
                    .isBold,
                  'mr-4': item.images,
                }"
                v-html="item.desc"
                :disabled="true"
              ></b-link>
            </div>
            <b-badge :variant="CheckStatus(item.status).variant">
              {{ item.status }}</b-badge
            >

            <!--end::Text-->
          </div>
          <!--end::Item-->
        </template>
      </div>
      <!--end: Items-->
    </div>
    <!--end: Card Body-->
  </div>
  <!--end: Card-->
  <!--end: List Widget 9-->
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "CustomActivity",
  props: {
    title: String,
    deskripsi: String,
    list: Array,
  },
  methods: {
    lastElement(i) {
      if (i === this.list.length - 1) {
        return false;
      } else {
        return true;
      }
    },

    CheckStatus(status) {
      if (status == "approve") {
        return {
          badge: "fa fa-genderless text-success",
          variant: "success",
          isBold: true,
        };
      } else if (status == "pending") {
        return {
          badge: "fa fa-genderless text-warning",
          variant: "warning",
          isBold: false,
        };
      } else if (status == "disable") {
        return {
          badge: "fa fa-genderless text-secondary",
          variant: "secondary",
          isBold: false,
        };
      } else if (status == "reject") {
        return {
          badge: "fa fa-genderless text-danger",
          variant: "danger",
          isBold: true,
        };
      } else {
        return {
          badge: "fa fa-genderless text-primary",
          variant: "primary",
          isBold: true,
        };
      }
    },
  },
  computed: {
    ...mapGetters(["layoutConfig"]),
  },
};
</script>