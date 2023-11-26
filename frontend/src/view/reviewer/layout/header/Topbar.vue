<template>
  <!-- begin:: Header Topbar -->
  <div class="topbar">
    <!--begin: User Bar -->
    <KTQuickUser></KTQuickUser>
    <!--end: User Bar -->
  </div>
  <!-- end:: Header Topbar -->
</template>

<style lang="scss">
.topbar {
  .dropdown-toggle {
    padding: 0;
    &:hover {
      text-decoration: none;
    }

    &.dropdown-toggle-no-caret {
      &:after {
        content: none;
      }
    }
  }

  .dropdown-menu {
    margin: 0;
    padding: 0;
    outline: none;
    .b-dropdown-text {
      padding: 0;
    }
  }
}
</style>

<script>
// import KTSearchDefault from "@/view/EKID/admin/layout/extras/dropdown/SearchDefault.vue";
// import KTDropdownNotification from "@/view/EKID/admin/layout/extras/dropdown/DropdownNotification.vue";
// import KTDropdownQuickAction from "@/view/EKID/admin/layout/extras/dropdown/DropdownQuickAction.vue";
// import KTDropdownMyCart from "@/view/EKID/admin/layout/extras/dropdown/DropdownMyCart.vue";
// import KTDropdownLanguage from "@/view/EKID/admin/layout/extras/dropdown/DropdownLanguage.vue";
import KTQuickUser from "@/view/lppm/layout/extras/offcanvas/QuickUser.vue";
// import KTQuickPanel from "@/view/EKID/admin/layout/extras/offcanvas/QuickPanel.vue";
import i18nService from "@/core/services/i18n.service.js";

export default {
  name: "KTTopbar",
  data() {
    return {
      languageFlag: "",
      languages: i18nService.languages,
    };
  },
  components: {
    // KTSearchDefault,
    // KTDropdownNotification,
    // KTDropdownQuickAction,
    // KTDropdownMyCart,
    // KTDropdownLanguage,
    KTQuickUser,
    // KTQuickPanel,
  },
  methods: {
    onLanguageChanged() {
      this.languageFlag = this.languages.find((val) => {
        return val.lang === i18nService.getActiveLanguage();
      }).flag;
    },
  },
  computed: {
    getLanguageFlag() {
      return this.onLanguageChanged();
    },
  },
};
</script>
