<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Waiting" active>
        <Detailwaiting></Detailwaiting>
      </b-tab>
      <b-tab title="Valid">
        <Detailvalid></Detailvalid>
      </b-tab>
      <b-tab title="Invalid">
        <Detailinvalid></Detailinvalid>
      </b-tab>
    </b-tabs>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import Detailwaiting from "@/view/hrd/LaporanPenunjang/comp-detail/Detailwaiting.vue";
import Detailvalid from "@/view/hrd/LaporanPenunjang/comp-detail/Detailvalid.vue";
import Detailinvalid from "@/view/hrd/LaporanPenunjang/comp-detail/Detailinvalid.vue";
export default {
  components: {
    CustomCard,
    Detailwaiting,
    Detailvalid,
    Detailinvalid,
  },
};
</script>