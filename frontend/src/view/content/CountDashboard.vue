<template>
  <!--begin::Stats Widget 11-->
  <div class="card card-custom gutter-b border border-primary">
    <!--begin::Body-->
    <div class="card-body p-0">
      <div
        class="
          d-flex
          align-items-center
          justify-content-center
          card-spacer
          flex-grow-1
        "
      >
        <span class="symbol symbol-75 symbol-light-success mr-2">
          <span class="symbol-label">
            <span class="svg-icon svg-icon-xl vg-icon-success">
              <inline-svg :src="icon" />
            </span>
          </span>
        </span>
        <div class="d-flex flex-column text-left ml-2">
          <span class="text-dark-75 font-size-h3 mb-2">{{ count }}</span>
          <span class="text-dark-75 font-size-h5">{{ title }}</span>
        </div>
      </div>
      <div class="d-flex justify-content-center mb-3 mt-0" v-if="isDetail">
        <v-chip color="green" class="ma-2" label outlined @click="onClick">
          <v-icon class="mr-2">mdi-eye</v-icon> {{ textButton }}
        </v-chip>
      </div>
    </div>
    <!--end::Body-->
  </div>
</template>
<script>
export default {
  name: "CounDashboard",
  props: {
    count: Number,
    title: String,
    icon: String,
    textButton: String,
    isDetail: {
      type: Boolean,
      default: true,
    },
  },
  methods: {
    onClick() {
      this.$emit("clickData");
    },
  },
};
</script>