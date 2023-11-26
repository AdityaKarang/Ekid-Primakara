<template>
  <div>
    <v-card>
      <ul type="disc">
        <li v-for="(pendidikan, i) in isiPendidikan" :key="i">
          {{ pendidikan }}
        </li>
      </ul>
      <!-- <v-list>
        <v-item-group>
          <v-list-item v-for="(pendidikan, i) in isiPendidikan" :key="i">
            <v-list-item-icon>
              <v-icon> mdi-chevron-right</v-icon>
            </v-list-item-icon>
            <v-list-item-content>
              <v-list-item-title>{{ pendidikan }}</v-list-item-title>
            </v-list-item-content>
          </v-list-item>
        </v-item-group>
      </v-list> -->
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";

export default {
  name: "Kaprodi-Pendidikan",
  components: {},
  data() {
    return {
      isiPendidikan: [
        "Tabel absensi",
        "Tabel Edom",
        "Tabel nilai pengumpulan soal UTS",
        "Tabel nilai pengumpulan soal UAS",
        "Pengumpulan nilai UTS dan UAS",
        "Ketepatan SAP dan BAP",
      ],
    };
  },
  methods: {},
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Pendidikan" }]);
  },
};
</script>