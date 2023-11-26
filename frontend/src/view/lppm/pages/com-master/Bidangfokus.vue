<!-- <template>
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
              Tambah Bidang Fokus
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
                    v-model="form.bidangfokus"
                    label="Bidang Fokus"
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
        title="Daftar Bidang Fokus"
        deskripsi="List Daftar Bidang Fokus Yang Telah Di Inputkan"
        :headers="headers"
        :contentTable="contentTables"
        :isDetail="false"
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
import axios from "axios";

export default {
  name: "bidang_fokuses",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        bidang_fokuses: [],
      },
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,
      confirmasiDelete: false,
      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Bidang Fokus", value: "bidang_fokus" },
        { text: "Actions", value: "detail" },
      ],
    };
  },
  mounted() {
    console.log('im here')
  },
};
</script>

<!-- <script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
export default {
  name: "Bidangfokus",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        bidang_fokus: "",
      },

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,
      confirmasiDelete: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Bidang Fokus", value: "bidang_fokus" },
        { text: "Actions", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          bidangfokus: "Technopreneur",
        },

        {
          no: "2",
          bidangfokus: "Sistem Informasi",
        },

        {
          no: "3",
          bidangfokus: "IOT",
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
    editData(item) {
      console.log("test");
      this.showAdd = true;
      this.form.bidangfokus = item.bidangfokus;
    },
    deleteData(item) {
      this.confirmasiDelete = true;
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
</script> --> -->