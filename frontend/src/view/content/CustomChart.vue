<template>
  <div>
    <div class="card card-custom gutter-b">
      <div class="card-header">
        <div
          class="
            d-flex
            flex-column
            align-items-end
            card-title
            font-weight-bolder
          "
        >
          <h3 class="text-dark text-left">{{ title }}</h3>
        </div>
      </div>
      <!--begin::Body-->
      <div class="card-body p-0">
        <!--begin::Chart-->
        <apexchart
          class="card-rounded-bottom"
          :options="option"
          type="area"
          width="100%"
        ></apexchart>
        <!--end::Chart-->
      </div>
      <!--end::Body-->
    </div>
  </div>
</template>
<script>
import { mapGetters } from "vuex";
export default {
  name: "CustomChart",
  props: {
    title: String,
    option: Object,
  },
  computed: {
    ...mapGetters(["layoutConfig"]),
  },
};
</script>