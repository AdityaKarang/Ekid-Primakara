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
                @click="onClick()
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
                @click="onDelete()
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
              Tambah Kriteria Penilaian Kemajuan
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
                    v-model="form.kriteria"
                    label="Kriteria Penilaian"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row v-for="(indikator, i) in form.indikators" :key="i">
                <v-col cols="4">
                  <v-text-field
                    v-model="indikator.value"
                    :label="indikator.name"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="4">
                  <v-text-field
                    v-model="indikator.weight"
                    :label="indikator.bobot"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="2"
                  class="mt-2"
                  v-if="i == form.indikators.length - 1"
                >
                  <b-button
                    small
                    type="button"
                    class="mr-2"
                    variant="primary"
                    @click="addLastIndikator()"
                    ><v-icon>mdi-plus</v-icon></b-button
                  >
                </v-col>
                <v-col
                  cols="2"
                  class="mt-2"
                  v-if="i != 0 && i == form.indikators.length - 1"
                >
                  <b-button
                    small
                    type="button"
                    class="mr-2"
                    variant="danger"
                    @click="removeLastIndikator()"
                    ><v-icon>mdi-close</v-icon></b-button
                  >
                </v-col>
              </v-row>
              <b-button
                type="button"
                class="mr-2"
                variant="primary"
                @click="confirmasi = true"
                >Save</b-button
              >
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <v-dialog v-model="showEdit" max-width="400px">
        <v-card class="">
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Edit Kriteria Penilaian Kemajuan
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
                  <v-text-field
                    v-model="form.kriteria"
                    label="Kriteria Penilaian"
                    required
                  ></v-text-field>
                </v-col>
              </v-row>
              <v-row v-for="(indikator, i) in form.indikators" :key="i">
                <v-col cols="4">
                  <v-text-field
                    v-model="indikator.value"
                    :label="indikator.name"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="4">
                  <v-text-field
                    v-model="indikator.weight"
                    :label="indikator.bobot"
                    required
                  ></v-text-field>
                </v-col>
                <v-col
                  cols="2"
                  class="mt-2"
                  v-if="i == form.indikators.length - 1"
                >
                  <b-button
                    small
                    type="button"
                    class="mr-2"
                    variant="primary"
                    @click="addLastIndikator()"
                    ><v-icon>mdi-plus</v-icon></b-button
                  >
                </v-col>
                <v-col
                  cols="2"
                  class="mt-2"
                  v-if="i != 0 && i == form.indikators.length - 1"
                >
                  <b-button
                    small
                    type="button"
                    class="mr-2"
                    variant="danger"
                    @click="removeLastIndikator()"
                    ><v-icon>mdi-close</v-icon></b-button
                  >
                </v-col>
              </v-row>
              <b-button
                type="button"
                class="mr-2"
                variant="primary"
                @click="onEdit()"
                >Save</b-button
              >
            </v-form>
          </v-card-text>
        </v-card>
      </v-dialog>
      <CustomCardMultyCategori
        title="Daftar Kriteria Penilaian Laporan Kemajuan"
        deskripsi="List Daftar Kriteria Penilaian Yang Telah Di Inputkan"
        :headers="headers"
        :contentTable="contentTables"
        @addNew="addNew"
      >
        <template v-slot:customdata="{ props }">
          <template v-for="(indikator, i) in props.item.indikators">
            <tr :key="i + '_' + props.item.no">
              <td
                class="text-start"
                v-if="i == 0"
                :rowspan="props.item.indikators.length"
              >
                {{ props.item.no }}
              </td>
              <td
                class="text-start"
                v-if="i == 0"
                :rowspan="props.item.indikators.length"
              >
                {{ props.item.kriteria }}
              </td>
              <td>{{ indikator.value }}</td>
              <td>{{ indikator.weight }}</td>
              <td
                class="stext-start"
                v-if="i == 0"
                :rowspan="props.item.indikators.length"
              >
                <div class="d-flex">
                  <v-icon
                    small
                    color="warning"
                    v-if="true"
                    class="mr-2"
                    @click="editData(props.item)"
                  >
                    mdi-pencil
                  </v-icon>
                  <v-icon
                    color="success"
                    small
                    v-if="false"
                    class="mr-2"
                    @click="detailData(props.item)"
                  >
                    mdi-eye
                  </v-icon>
                  <v-icon
                    color="error"
                    small
                    v-if="true"
                    class="mr-2"
                    @click="deleteData(props.item)"
                  >
                    mdi-delete
                  </v-icon>
                </div>
              </td>
              <!-- <v-text-field v-model="item.nilai" type="number"></v-text-field> -->
            </tr>
          </template>
        </template>
      </CustomCardMultyCategori>
    </div>
  </b-card>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCardMultyCategori from "@/view/content/CustomCardMultyCategori";
import axios from "axios";
export default {
  name: "Kriteriaproposal",
  components: {
    CustomCardMultyCategori,
  },
  data() {
    return {
      form: {
        kriteria: "",
        indikators: [
          {
            key: 0,
            name: "indikator 1",
            bobot: "bobot 1",
            value: "",
          },
        ],
      },

      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      showEdit: false,
      confirmasi: false,
      confirmasiDelete: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Kriteria Penilaian", value: "kriteria" },
        { text: "Indikator", value: "indikators" },
        { text: "Bobot", value: "bobot" },
        { text: "Actions", value: "detail" },
      ],
      contentTables: [
      // {
      //     no: "1",
      //     kriteria: "Perumusan Masalah",
      //     indikators: [
      //       {
      //         key: 0,
      //         name: "indikator 1",
      //         value: "Ketajaman Perumusan Maslaah dan Tujuan",
      //         bobot: "bobot 1",
      //         weight: "25"
      //       },
      //       {
      //         key: 1,
      //         name: "indikator 2",
      //         value: "Ketajaman Perumusan Maslaah ",
      //         bobot: "bobot 2",
      //         weight: "40"
      //       },
      //     ],
      //   },
      ],
      
    };
  },
  computed:{
    currentUser(){
      return this.$store.state.auth.user.data
    }
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Master Data" }]);
    console.log(this.currentUser)
    this.fetchData();
  },
  methods: {
    addLastIndikator() {
      let lastIdx = this.form.indikators.length + 1;
      this.form.indikators.push({
        key: lastIdx,
        name: "indikator " + lastIdx,
        bobot: "bobot " + lastIdx,
        value: "",
        weight: "",
      });
    },
    removeLastIndikator() {
      this.form.indikators.pop();
    },
    fetchData() {
    axios.get("http://localhost:8000/api/kriteria-penilaian/")
      .then(response => {
        // Menangani respons dari API jika diperlukan
        console.log(response.data);
        // Mengubah format data yang diterima ke format yang sesuai dengan struktur contentTables
        this.contentTables = response.data
        .filter(item => item.type === "kemajuan")
        .map((item, index) => ({
          no: (index + 1).toString(),
          kriteria: item.kriteria,
          detail: item.id,
          indikators: item.indikator_penilaians.map(indikator => ({
            value: indikator.indikator,
            weight: indikator.bobot.toString()
          
          }))
         
        }));
      })
      .catch(error => {
        // Menangani error jika terjadi
        console.error(error);
      });
  },
    onClick() {
    // Membuat objek payload untuk dikirim ke API
    const payload = {
      kriteria: this.form.kriteria,
      type: "kemajuan",
      indikators: this.form.indikators.map(indikator => ({
        indikator: indikator.value,
        bobot: indikator.weight,
      })),
    };

    // Mengirim permintaan POST ke API menggunakan Axios
    axios.post("http://localhost:8000/api/kriteria-penilaian", payload)
      .then(response => {
        this.fetchData();
        // Menangani respons dari API jika diperlukan
        console.log(response.data);
        // Reset nilai form setelah berhasil menambahkan kriteria
        this.form.kriteria = "";
        this.form.indikators = [
          {
            key: 0,
            name: "indikator 1",
            bobot: "bobot 1",
            value: "",
            weight: "",
          },
        ];
      })
      .catch(error => {
        // Menangani error jika terjadi
        console.error(error);
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
      this.form.kriteria = item.kriteria;
      this.form.indikators = item.indikators;
      this.id = item.detail;
    },
    onEdit() {
    // Membuat objek payload untuk dikirim ke API
    const payload = {
      kriteria: this.form.kriteria,
      type: "kemajuan",
      indikators: this.form.indikators.map(indikator => ({
        indikator: indikator.value,
        bobot: indikator.weight,
      })),
    };

    // Mengirim permintaan PUT ke API menggunakan Axios
    axios.put(`http://localhost:8000/api/kriteria-penilaian/${this.id}`, payload)
      .then(response => {
        this.showEdit = false;
        this.fetchData();
        // Menangani respons dari API jika diperlukan
        console.log(response.data);
        // Reset nilai form setelah berhasil memperbarui kriteria
        this.form.kriteria = "";
        this.form.indikators = [
          {
            key: 0,
            name: "indikator 1",
            bobot: "bobot 1",
            value: "",
            weight: "",
          },
        ];
      })
      .catch(error => {
        // Menangani error jika terjadi
        console.error(error);
      });
  },
    deleteData(item) {
      this.confirmasiDelete = true;
      this.id = item.detail;
    },
    onDelete() {
  axios.delete(`http://localhost:8000/api/kriteria-penilaian/${this.id}`)
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

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },


  },

};
</script>