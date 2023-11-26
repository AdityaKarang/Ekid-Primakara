<template>
  <b-card>
    <div class="mt-3">
      <v-row justify="center">
        <v-dialog v-model="confirmasi" max-width="300">
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin Ingin Menyimpan Data?</v-card-title>

            <v-card-text> pastikan anda mengis data dengan benar </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasi = false">
                Cancel
              </v-btn>

              <v-btn color="green darken-1" text @click="onClick();
              confirmasi = false;
              showAdd = false;
              ">
                Save
              </v-btn>
            </v-card-actions>
          </v-card>
        </v-dialog>
        <v-dialog v-model="confirmasiDelete" max-width="300">
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin Menghapus data?</v-card-title>

            <v-card-text>
              pastikan anda menghapus data dengan benar
            </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasiDelete = false">
                Cancel
              </v-btn>

              <v-btn color="green darken-1" text @click="onDelete();
              confirmasiDelete = false;
              showAdd = false;
              ">
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
              Tambah Sumber Dana
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
                  <v-text-field v-model="form.sumber_dana" label="Sumber Dana" required></v-text-field>
                </v-col>
              </v-row>
              <b-button type="button" class="mr-2" variant="primary" @click="confirmasi = true">Save</b-button>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <v-dialog v-model="showEdit" max-width="400px">
        <v-card class="">
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Edit Sumber Dana
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="showEdit = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <v-form>
              <v-row>
                <v-col md="6">
                  <v-text-field v-model="form.sumber_dana" label="Sumber Dana" required></v-text-field>
                </v-col>
              </v-row>
              <b-button type="button" class="mr-2" variant="primary" @click="onSave()">Save</b-button>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <CustomCard title="Daftar Sumber Dana" deskripsi="List Daftar Sumber Dana Yang Telah Di Inputkan" :headers="headers"
        :contentTable="contentTables" :isDetail="false" @detailItem="detailData" @editItem="editData"
        @deleteItem="deleteData" @addNew="addNew" />
    </div>
  </b-card>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "Sumberdana",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        sumber_danas: [],
      },

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showEdit: false,
      showAdd: false,
      confirmasi: false,
      confirmasiDelete: false,
      contentTables: [],
      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Sumber Dana", value: "sumber_dana" },
        { text: "Actions", value: "detail" },
      ],
    };
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user.data
    }
  },
  mounted() {
    this.getsumber_danas();
    console.log(this.currentUser);
  },
  methods: {
    getsumber_danas() {
      axios.get('http://localhost:8000/api/sumberdana').then(res => {
        this.contentTables = res.data.data.map((bf, index) => {
          return {
            no: index + 1,
            sumber_dana: bf.sumber_dana,
            detail: bf.id
          }
        })
        console.log()
      })
    },
    addNew(value) {
      this.showAdd = value;
    },
    onClick() {
      axios.post('http://localhost:8000/api/sumberdana', {
        sumber_dana: this.form.sumber_dana,
      })
        .then(response => {
          // this.confirmasi = true;
          this.getsumber_danas();
          this.form.sumber_dana = '';
        })
        .catch(error => {
          console.log(error);
        });
    },

    editData(item) {
      console.log(item);
      this.form = { sumber_dana: item.sumber_dana };
      this.showEdit = true;
      this.confirmasi = false;
      this.editItemId = item.detail; // Set the id of the item being edited

      // Remove the axios.put call here
    },
    onSave() {
      axios.put(`http://localhost:8000/api/sumberdana/${this.editItemId}`, {
        sumber_dana: this.form.sumber_dana
      }).then(res => {
        console.log(res.data);
        this.getsumber_danas();
        this.form.sumber_dana = '';
        this.showEdit = false;
      }).catch(error => {
        console.error(error);
      });
    },
    detailData(item) {
      this.$router.push({
        name: "detail-penelitian",
        params: { data: item },
      });
    },

    deleteData(item) {
      console.log(item);
      this.confirmasiDelete = true;
      this.deleteId = item.detail; // Set the id of the item being edited

    },
    onDelete() {
      axios.delete(`http://localhost:8000/api/sumberdana/${this.deleteId}`)
        .then(response => {
          console.log(response.data);
          this.confirmasiDelete = false;
          this.getsumber_danas();
        })
        .catch(error => {
          console.error(error);
          this.confirmasiDelete = false;
        });
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
  },
};
</script>

<!-- methods:{
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
    this.form.sumberdana = item.sumberdana;
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
  } -->