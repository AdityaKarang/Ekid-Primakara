<template>
  <b-card>
    <div class="mt-3">
      <v-row justify="center">
        <v-dialog v-model="confirmasi" max-width="300">
          <v-card>
            <v-card-title class="headline"
              >Apakah Anda Yakin Ingin Menyimpan Data?</v-card-title
            >

            <v-card-text> pastikan anda mengis data dengan benar </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasi = false">
                Cancel
              </v-btn>

              <v-btn
                color="green darken-1"
                text
                @click="
                  confirmasi = false;
                  showAdd = false;
                "
              >
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
      </v-row>
      <v-dialog v-model="showAdd" max-width="400px">
        <v-card class="">
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Tambah Jenis Jurnal
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="showAdd = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col md="6">
                  <v-text-field
                    v-model="form.jenisjurnal"
                    label="Jenis Jurnal"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              <b-button
                type="button"
                class="mr-2"
                variant="primary"
                @click="onClick()"
                >Save</b-button
              >
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <CustomCard
        title="Daftar Jenis Jurnal"
        deskripsi="List Daftar Jenis Jurnal Yang Telah Di Inputkan"
        :headers="headers"
        :contentTable="contentTables"
        @detailItem="detailData"
        @addNew="addNew"
      />
    </div>
  </b-card>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
export default {
  name: "Jenisjurnal",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        jenisjurnal: "",
      },

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Jenis Jurnal", value: "jenisjurnal" },
        { text: "Actions", value: "aksi" },
      ],
      contentTables: [
        {
          no: "1",
          jenisjurnal: "Nasional Terakreditasi",
        },

        {
          no: "2",
          jenisjurnal: "Nasional Tidak Terakreditasi",
        },

        {
          no: "3",
          jenisjurnal: "Internasional",
        },
      ],
    };
  },
  methods: {
    onSubmit(evt) {
      evt.preventDefault();
      alert(JSON.stringify(this.form));
    },
    onReset(evt) {
      evt.preventDefault();
      // Reset our form values
      // Trick to reset/clear native browser form validation state
      this.show = false;
      this.$nextTick(() => {
        this.show = true;
      });
    },
    detailData(item) {
      this.$router.push({
        name: "detail-penelitian",
        params: { data: item },
      });
    },
    addNew(value) {
      this.showAdd = value;
    },
    onClick() {
      this.confirmasi = true;
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Master Data" }]);
  },
};
</script>