<template>
  <b-card>
    <div class="mt-3">
      <v-row justify="center">
        <v-dialog v-model="confirmasi" max-width="300">
          <v-card>
            <v-card-title class="headline">Apakah Anda Yakin Ingin Menyimpan Data?</v-card-title>

            <v-card-text> pastikan anda mengisi data dengan benar </v-card-text>

            <v-card-actions>
              <v-spacer></v-spacer>

              <v-btn color="green darken-1" text @click="confirmasi = false">
                Cancel
              </v-btn>

              <v-btn color="green darken-1" text @click="OnClick();
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
            <v-card-title class="headline">Apakah Anda Yakin Menghapus User?</v-card-title>

            <v-card-text>
              pastikan anda menghapus user dengan benar
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
              Tambah User
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
                  <v-text-field v-model="form.name" label="Name" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.username" label="Username" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.email" label="Email" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field type="password" ref="password" v-model="form.password" label="Password" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-select :items="role" label="Role" v-model="form.role"></v-select>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.nidn" label="NIDN" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.prodi" label="Prodi" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.jabatan_fungsional" label="Jabatan Fungsional" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.level_jabatan" label="Level Jabatan" required></v-text-field>
                </v-col>
              </v-row>
              <b-button type="button" class="mr-2" variant="primary" @click="onClick()">Save</b-button>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <v-dialog v-model="showEdit" max-width="400px">
        <v-card class="">
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Edit User
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
                <v-col md="12">
                  <v-text-field v-model="form.name" label="Name" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.username" label="Username" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.email" label="Email" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.password" label="Password" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-select :items="role" label="Role" v-model="form.role"></v-select>
                </v-col>
              </v-row>
              <v-row>
              <v-col md="12">
                  <v-text-field v-model="form.nidn" label="NIDN" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.prodi" label="Prodi" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.jabatan_fungsional" label="Jabatan Fungsional" required></v-text-field>
                </v-col>
              </v-row>
              <v-row>
                <v-col md="12">
                  <v-text-field v-model="form.level_jabatan" label="Level Jabatan" required></v-text-field>
                </v-col>
              </v-row>
              <b-button type="button" class="mr-2" variant="primary" @click="onSave()">Save</b-button>
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <CustomCard title="Daftar User" deskripsi="List User Yang Telah Terdaftar" :headers="headers"
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
  name: "Users",
  components: {
    CustomCard,
  },
  data() {
    return {
      form: {
        name: "",
        username: "",
        password: "",
        role_id: "",
        nidn: "",
        jabatan_fungsional: "",
        level_jabatan: "",
        prodi: "", 
      },
      role: [
        "dosen",
        "reviewer",
        "kaprodi",
        "hrd"
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      showEdit: false,
      confirmasi: false,
      confirmasiDelete: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Nama", value: "name" },
        { text: "Username", value: "username" },
        { text: "Role", value: "role" },
        { text: "Actions", value: "detail" },
      ],
      contentTables: [
        // {
        //   no: "1",
        //   nama: "Gede Juliana Eka Putra",
        //   username: "gedejep",
        //   active: "Active"
        // },

        // {
        //   no: "2",
        //   nama: "Tiawan",
        //   username: "tiawan",
        //   active: "Active"
        // },

      ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Master Data" }]);
    this.fetchData();
  },
  methods: {
    async fetchData() {
      await axios.get('http://localhost:8000/api/user').then(res => {
        console.log("API Response:", res.data.data); // Log the API response
        this.contentTables = res.data.data.map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          return {
            no: index + 1,
            name: bf.name,
            username: bf.username,
            role: bf.role,
            email: bf.email,
            detail: bf.id
          }
        })
        console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
      })
    },

    async OnClick() {
      await axios.post('http://localhost:8000/api/user/create', {
        name: this.form.name,
        username: this.form.username,
        email: this.form.email,
        password: this.form.password,
        nidn: this.form.nidn,
        prodi: this.form.prodi,
        jabatan_fungsional: this.form.jabatan_fungsional,
        level_jabatan: this.form.level_jabatan,
        role: this.form.role,
      })
        .then(response => {
          // this.confirmasi = true;
          console.log(response.data);
          this.fetchData();
          this.form.name = '';
          this.form.username = '';
          this.form.email = '';
          this.form.password = '';
          this.form.nidn = '';
          this.form.prodi = '';
          this.form.jabatan_fungsional = '';
          this.form.level_jabatan = '';
          this.form.role = '';
        })
        .catch(error => {
          console.log(error);
        });
    },

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
      console.log(item);
      this.showEdit = true;
      this.form.name = item.name;
      this.form.username = item.username;
      this.form.email = item.email;
      this.form.password = item.password;
      this.form.role = item.role;
      this.form.nidn = item.nidn;
      this.form.prodi = item.prodi
      this.form.jabatan_fungsional = item.jabatan_fungsional
      this.editItemId = item.detail;
    },
    async onSave() {
      await axios.put(`http://localhost:8000/api/user/update/${this.editItemId}`, {
        name: this.form.name,
        username: this.form.username,
        email: this.form.email,
        password: this.form.password,
        role: this.form.role,
        nidn: this.form.nidn,
        prodi: this.form.prodi,
        jabatan_fungsional: this.form.jabatan_fungsional,
        level_jabatan: this.form.level_jabatan,
      })
        .then(response => {
          // this.confirmasi = true;
          console.log(response.data);
          this.fetchData();
          this.showEdit = false;
          this.form.name = '';
          this.form.username = '';
          this.form.email = '';
          this.form.password = '';
          this.form.role = '';
          this.form.nidn = '';
          this.form.prodi = '';
          this.form.jabatan_fungsional = '';
          this.form.level_jabatan = '';
        })
        .catch(error => {
          console.log(error);
        });
    },
    deleteData(item) {
      this.confirmasiDelete = true;
      this.deleteId = item.detail; // Set the id of the item being edited
    },

    async onDelete() {
      await axios.delete(`http://localhost:8000/api/user/delete/${this.deleteId}`)
        .then(response => {
          console.log(response.data);
          this.confirmasiDelete = false;
          this.fetchData();
        })
        .catch(error => {
          console.error(error);
          this.confirmasiDelete = false;
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


};
</script>