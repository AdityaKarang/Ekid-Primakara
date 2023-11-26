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
        <v-dialog v-model="confirmasiDelete" max-width="300">
          <v-card>
            <v-card-title class="headline"
              >Apakah Anda Yakin Menghapus data?</v-card-title
            >

            <v-card-text>
              pastikan anda menghapus data dengan benar
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn
                color="green darken-1"
                text
                @click="confirmasiDelete = false"
              >
                Cancel
              </v-btn>

              <v-btn
                color="green darken-1"
                text
                @click="
                  confirmasiDelete = false;
                  showAdd = false;
                "
              >
                Hapus
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
              Tambah Team Reviewer
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
                <v-col md="12">
                  <v-text-field
                    v-model="form.nama"
                    label="Nama Dosen"
                    required
                  ></v-text-field>
                </v-col>
                <v-col md="12">
                  <v-select
                    v-model="form.bidangfokus"
                    label="Bidang Fokus"
                    :items="bidangfokus"
                    required
                  ></v-select>
                </v-col>
                <v-col md="12">
                  <v-text-field
                    v-model="form.username"
                    label="Username"
                    required
                  ></v-text-field>
                </v-col>
                <v-col md="12">
                  <v-text-field
                    v-model="form.password"
                    label="Password"
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
        title="Daftar Team Reviewer"
        deskripsi="List Daftar Team Reviewer Yang Telah Di Inputkan"
        :headers="headers"
        :contentTable="contentTables"
        @detailItem="detailData"
        @editItem="editData"
        @deleteItem="deleteData"
        @addNew="addNew"
      />
    </div>
  </b-card>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
export default {
  name: "Managereviewer",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        nama: "",
        bidangfokus: "",
        username: "",
        password: "",
      },
      bidangfokus: [
        { text: "Pilih Bidang Fokus", value: null },
        "Techopreneur",
        "Sistem Informasi",
        "IOT",
      ],

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,
      confirmasiDelete: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Nama Dosen", value: "nama" },
        { text: "Bidang Fokus", value: "bidangfokus" },
        { text: "Username", value: "username" },
        { text: "Password", value: "password" },
        { text: "Actions", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          nama: "I Putu Satwika,S.Kom., M.Kom",
          bidangfokus: "Sistem Informasi",
          username: "satwika",
          password: "12345",
        },

        {
          no: "2",
          nama: "I Nyoman Yudi Anggara, S.Kom., M.T",
          bidangfokus: "IOT",
          username: "yudi",
          password: "45289",
        },

        {
          no: "3",
          nama: "Ketut Queena Fredlina,S.Si., M.Si",
          bidangfokus: "Technopreneur",
          username: "queena",
          password: "67021",
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
        name: "",
        params: { data: item },
      });
    },
    editData(item) {
      console.log("test");
      this.showAdd = true;
      this.form.nama = item.nama;
      this.form.bidangfokus = item.bidangfokus;
      this.form.username = item.username;
      this.form.password = item.password;
    },
    deleteData(item) {
      this.confirmasiDelete = true;
    },
    addNew(value) {
      this.showAdd = value;
      this.form.nama = "";
      this.form.bidangfokus = "";
      this.form.username = "";
      this.form.password = "";
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