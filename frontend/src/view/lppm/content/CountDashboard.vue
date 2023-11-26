<template>
  <!--begin::Stats Widget 11-->
  <div class="card card-custom gutter-b" style="border: 1px solid">
    <!--begin::Body-->
    <div class="card-body p-0">
      <div class="d-flex align-items-center card-spacer flex-grow-1">
        <span class="symbol symbol-50 symbol-light-success mr-2">
          <span class="symbol-label">
            <span class="svg-icon svg-icon-xl svg-icon-success">
              <inline-svg :src="icon" />
            </span>
          </span>
        </span>
        <div class="d-flex flex-column text-left ml-2">
          <span class="text-dark-75 font-weight-bolder font-size-h3">{{
            count
          }}</span>
          <span class="text-dark-75 font-size-h5 font-weight-bold">{{
            title
          }}</span>
        </div>
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
  },
};
</script>