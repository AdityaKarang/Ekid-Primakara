<template>
  <div>
    <v-card class="p-5">
      <v-row>
        <v-col md="4" v-for="(dasboard, i) in dataDashboard" :key="i">
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
                <span class="symbol symbol-50 symbol-light-success mr-2">
                  <span class="symbol-label">
                    <span class="svg-icon svg-icon-xl svg-icon-success">
                      <inline-svg src="./media/svg/files/doc.svg" />
                    </span>
                  </span>
                </span>
                <div class="d-flex flex-column text-left ml-2">
                  <span class="text-dark-75 font-size-h5 font-weight-bolder">{{
                    dasboard.count
                  }}</span>
                  <span class="text-dark-75 font-size-h6 font-weight-bolder">{{
                    dasboard.title
                  }}</span>
                </div>
              </div>
            </div>
          </div>
        </v-col>
      </v-row>
    </v-card>
  </div>
</template>

<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";

export default {
  name: "DashboardHRD",
  data() {
    return {
      dataDashboard: [
        { count: "30", title: "jumlah valid" },
        { count: "30", title: "jumlah waiting" },
        { count: "30", title: "jumlah invalid" },
      ],
    };
  },

  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Dashboard" }]);
  },
};
</script>