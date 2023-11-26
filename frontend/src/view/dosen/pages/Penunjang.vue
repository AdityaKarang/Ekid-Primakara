<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="confirmasi" max-width="290">
        <v-card>
          <v-card-title class="headline">Apakah Anda Yakin Ingin Submit Data?</v-card-title>

          <v-card-text> pastikan anda mengis data dengan benar </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="confirmasi = false">
              batal
            </v-btn>

            <v-btn color="green darken-1" text @click="onClick()
              confirmasi = false;
            showAdd = false;
            ">
              submit
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-dialog v-model="showAdd" max-width="800px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-file</v-icon>
          <v-toolbar-title class="font-weight-light">
            Tambah Penunjang
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
                <v-text-field v-model="form.tahun_akademik" label="Tahun Akademik" required
                  :readonly="checkStatusKet(form.ket)"></v-text-field>
              </v-col>
              <!-- <v-col md="6">
                <v-text-field
                  v-model="form.semester"
                  label="Semester"
                  disabled
                  required
                ></v-text-field>
              </v-col> -->
              <v-col sm="12" md="12">
                <v-text-field v-model="form.nama_kegiatan" label="Nama Kegiatan" required
                  :readonly="checkStatusKet(form.ket)"></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-autocomplete v-model="form.peran" :items="jenis" dense filled label="Peran" item-text="detail.name"
                  item-value="detail" :readonly="checkStatusKet(form.ket)" @change="SelectChange">
                  <template v-slot:selection="data">
                    {{ data.item.detail.name }}
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content v-text="data.item"></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title>{{ data.item.detail.name }}</v-list-item-title>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>

              <v-col cols="12" v-if="form.peran">
                <v-row>
                  <v-col cols="4">
                    <v-text-field label="Nilai" v-model="form.nilai" readonly>
                    </v-text-field>
                  </v-col>
                </v-row>
              </v-col>

              <b-col cols="12">
                <v-file-input v-model="form.bukti_kegiatan" label="Upload Bukti Kegiatan" @change="handleFileUpload" :disabled="checkStatusKet(form.ket)"></v-file-input>
              </b-col>
              <b-col cols="12" v-if="isedit">
                <v-textarea outlined name="input-7-4" label="Catatan" v-model="form.keterangan" value=""
                  :readonly="checkStatusKet(form.ket)"></v-textarea>
              </b-col>
            </v-row>
            <b-button type="button" class="mr-2" variant="success" @click="showAdd = false">Draft</b-button>
            <b-button type="button" variant="primary" @click="confirmasi = true">Submit</b-button>
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <CustomCard title="Daftar Kegiatan Penunjang" deskripsi="List Daftar Kegiatan Penunjang Yang Telah Di Inputkan"
      :headers="headers" :contentTable="contentTables" :isDelete="false" :isEdit="false" @addNew="addNew"
      @detailItem="editData" />
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";

export default {
  name: "Penunjang",
  components: {
    CustomCard,
  },
  data() {
    return {
      totalKriteria: 1,
      isedit: false,
      form: {
        penunjangs: [],
        // tahunAkademik: "2020/2021-Genap",
        // namakegiatan: "",
        // jenisKegiatan: "",
        // nilai: "",
        // ket: "",
        // keterangan: "",
      },
      jenis: [
        // {
        //   detail: {
        //     name: "Select One",
        //     nilai: null,
        //   },
        // },
        // {
        //   detail: {
        //     name: "Sebagai Ketua/Wakil Ketua dan Anggota Pada Perguruan Tinggi",
        //     nilai: 20,
        //   },
        // },
        // {
        //   detail: {
        //     name:
        //       "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //     nilai: 15,
        //   },
        // },
        // {
        //   detail: {
        //     name: "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //     nilai: 10,
        //   },
        // },
        // {
        //   detail: {
        //     name: "Sebagai Anggota, Kepanitiaan Daerah Pada Lembaga Pemerintah",
        //     nilai: 50,
        //   },
        // },
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Nama Kegiatan", value: "nama_kegiatan" },
        { text: "Status", value: "ket" },
        { text: "Berkas", value: "berkas" },
        { text: "Aksi", value: "detail" },
      ],
      contentTables: [
        // {
        //   no: "1",
        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Seminar Literasi Digital",
        //   jenis: {
        //     detail: {
        //       name:
        //         "Sebagai Ketua/Wakil Ketua dan Anggota Pada Perguruan Tinggi",
        //       nilai: 20,
        //     },
        //   },
        //   ket: "Waiting",
        //   keterangan: "",
        //   berkas: "example.pdf",
        // },

        // {
        //   no: "2",
        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Lomba Startup",
        //   jenis: {
        //     detail: {
        //       name:
        //         "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //       nilai: 10,
        //     },
        //   },
        //   ket: "Invalid",
        //   keterangan:
        //     "Bukti Kegiatan tidak sama dengan nama kegiatan yang diinputkan",
        //   berkas: "example.pdf",
        // },

        // {
        //   no: "3",
        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Pelatihan Pembuatan Jurnal International",
        //   jenis: {
        //     detail: {
        //       name:
        //         "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //       nilai: 10,
        //     },
        //   },
        //   ket: "Valid",
        //   keterangan: "-",
        //   berkas: "example.pdf",
        // },
      ],
    };
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Input Penunjang" }]);
    this.fetchData();
    this.fetchPeran();
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user.data
    },
  },
  methods: {
    fetchData() {
      axios.get('/penunjang').then(res => {
        console.log("API Response:", res.data.data); // Log the API response

        const currentUserID = this.currentUser.id; // Get the ID of the current user

        this.contentTables = res.data.data.filter(bf => bf.user_id === currentUserID).map((bf, index) => {
          console.log("Current Data:", bf); // Log the current data object being mapped
          return {
            no: index + 1,
            tahun_akademik: bf.tahun_akademik,
            nama_kegiatan: bf.nama_kegiatan,
            ket: bf.status,
            berkas: bf.bukti_kegiatan,
            detail: bf.id,
          }
        })
        console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
      })
    },

    fetchPeran() {
      axios.get('/kriteriapenunjang')
        .then(res => {
          // Assuming the response data structure is an array of objects with 'detail' property
          this.jenis = res.data.data.map(data => ({
            name: data.peran,
            // nilai: data.nilai
            detail: {
              name: data.peran,
              nilai: data.nilai
            }
          }));
        })
        .catch(error => {
          console.error(error);
        });
    },
    SelectChange(e) {
      console.log(e.nilai);
      this.form.nilai = e.nilai;
    },
    handleFileUpload(file) {
      this.form.proposal = file; // Simpan file yang diunggah ke dalam data form

      // Optional: Tampilkan informasi file yang diunggah
      console.log("File Name:", file.name);
      console.log("File Size:", file.size);
      console.log("File Type:", file.type);
    },
    onClick() {
      const formData = new FormData();
      formData.append("tahun_akademik", this.form.tahun_akademik);
      formData.append("nama_kegiatan", this.form.nama_kegiatan);
      formData.append("peran", this.form.peran.name);
      formData.append("nilai", this.form.nilai);
      formData.append("bukti_kegiatan", this.form.bukti_kegiatan);
      formData.append("keterangan", null);
      formData.append("status", null);
      formData.append("user_id", this.currentUser.id);

      axios
        .post("http://localhost:8000/api/penunjang", formData, {
          headers: {
            "Content-Type": "multipart/form-data",
          },
        })
        .then((response) => {
          // this.confirmasi = true;
          this.fetchData();
        })
        .catch((error) => {
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
        name: "",
        params: { data: item },
      });
    },
    editData(item) {
      this.form.tahunAkademik = item.tahun_akademik;
      this.form.semester = item.semester;
      this.form.namakegiatan = item.namakegiatan;
      this.form.jenisKegiatan = item.jenis;
      this.form.keterangan = item.keterangan;
      this.form.nilaiKegiatan = item.jenis.detail.nilai;
      this.form.ket = item.ket;
      this.showAdd = true;
      this.isedit = true;
      console.log(this.form);
    },
    addNew(value) {
      this.showAdd = value;
      this.form.tahunAkademik = "";
      this.form.semester = "";
      this.form.namakegiatan = "";
      this.form.jenisKegiatan = "";
      this.form.keterangan = "";
      this.form.ket = "";
      this.isedit = false;
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },

    checkStatusKet(ket) {
      if (!ket) return false;
      let ketr = ket.toLowerCase();
      if (ketr == "valid") {
        return true;
      }
      return false;
    },
    // SelectChange(e) {
    //   console.log(e.nilai);
    //   this.form.nilaiKegiatan = e.nilai;
    // },
  },

};
</script>
