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

              <v-btn color="green darken-1" text @click="onClick()
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

              <v-btn color="green darken-1" text @click=" onDelete()
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
              {{ titlePopoup }} Data Penunjang
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="showAdd = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <v-form>
              <v-col cosl="12">
                <v-text-field v-model="form.peran" label="Peran" required></v-text-field>
              </v-col>
              <v-col cosl="12">
                <v-text-field v-model="form.nilai" label="Nilai" required></v-text-field>
              </v-col>
              <v-col cosl="12">
                <v-text-field v-model="form.angka_kredit" label="Angka Kredit" required></v-text-field>
              </v-col>
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
              {{ titlePopoup }} Data Penunjang
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="showEdit = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>
          <v-divider></v-divider>
          <v-card-text>
            <v-form>
              <v-col cosl="12">
                <v-text-field v-model="form.peran" label="Peran" required></v-text-field>
              </v-col>
              <v-col cosl="12">
                <v-text-field v-model="form.nilai" label="Nilai" required></v-text-field>
              </v-col>
              <v-col cosl="12">
                <v-text-field v-model="form.angka_kredit" label="Angka Kredit" required></v-text-field>
              </v-col>
              <b-button type="button" class="mr-2" variant="primary" @click="onSave()">Save</b-button>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <CustomCard title="Daftar Kriteria Peran" deskripsi="List Daftar Kriteria Peran Yang Telah Di Inputkan"
        :headers="headers" :contentTable="contentTables" :isDetail="false" @detailItem="detailData" @editItem="editData"
        @deleteItem="deleteData" @addNew="addNew" />
    </div>
  </b-card>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "MasterPenunjang",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        kriteria_penunjangs: [],
      },

      titlePopoup: "Tambah",
      showAdd: false,
      showEdit: false,
      confirmasi: false,
      confirmasiDelete: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Peran", value: "peran" },
        { text: "Nilai", value: "nilai" },
        { text: "Angka Kredit", value: "angka_kredit" },
        { text: "Actions", value: "detail" },
      ],
      contentTables: [],
    };
  },
  mounted() {
    this.getkriteria_penunjangs();
  },
  methods: {
    getkriteria_penunjangs() {
      axios.get('http://localhost:8000/api/kriteriapenunjang').then(res => {
        this.contentTables = res.data.data.map((bf, index) => {
          return {
            no: index + 1,
            peran: bf.peran,
            nilai: bf.nilai,
            angka_kredit: bf.angka_kredit,
            detail: bf.id
          }
        })
        console.log()
      })
    },
    // onSubmit(evt) {
    //   evt.preventDefault();
    //   alert(JSON.stringify(this.form));
    // },
    // onReset(evt) {
    //   evt.preventDefault();
    //   // Reset our form values
    //   // Trick to reset/clear native browser form validation state
    //   this.show = false;
    //   this.$nextTick(() => {
    //     this.show = true;
    //   });
    // },
    detailData(item) {
      this.$router.push({
        name: "detail-penelitian",
        params: { data: item },
      });
    },
    editData(item) {
      console.log("test");
      this.showEdit = true;
      this.titlePopoup = "Edit";
      this.form = { peran: item.peran, nilai: item.nilai, angka_kredit: item.angka_kredit };
      this.editItemId = item.detail
    },
    onSave() {
      axios.put(`http://localhost:8000/api/kriteriapenunjang/${this.editItemId}`, {
        peran: this.form.peran,
        nilai: this.form.nilai,
        angka_kredit: this.form.angka_kredit,
      }).then(res => {
        console.log(res.data);
        this.getkriteria_penunjangs();
        this.form.peran = '';
        this.form.nilai = '';
        this.form.angka_kredit = '';
        this.showEdit = false;
      }).catch(error => {
        console.error(error);
      });
    },
    deleteData(item) {
      console.log(item);
      this.confirmasiDelete = true;
      this.deleteId = item.detail; // Set the id of the item being edited

    },
    onDelete() {
      axios.delete(`http://localhost:8000/api/kriteriapenunjang/${this.deleteId}`)
        .then(response => {
          console.log(response.data);
          this.confirmasiDelete = false;
          this.getkriteria_penunjangs();

        })
        .catch(error => {
          console.error(error);
          this.confirmasiDelete = false;
        });
    },
    addNew(value) {
      this.titlePopoup = "Tambah";
      this.showAdd = value;
    },
    onClick() {
      axios.post('http://localhost:8000/api/kriteriapenunjang', {
        peran: this.form.peran,
        nilai: this.form.nilai,
        angka_kredit: this.form.angka_kredit,
      })
        .then(response => {
          // this.confirmasi = true;
          this.getkriteria_penunjangs();
          this.form.peran = '';
          this.form.nilai = '';
          this.form.angka_kredit = '';
        })
        .catch(error => {
          console.log(error);
        });
    },


    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
  },

};
</script>