<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="confirmasi" max-width="290">
        <v-card>
          <v-card-title class="headline"
            >Apakah Anda Yakin Ingin Submit Data?</v-card-title
          >

          <v-card-text> pastikan anda mengis data dengan benar </v-card-text>

          <v-card-actions>
            <v-spacer></v-spacer>

            <v-btn color="green darken-1" text @click="confirmasi = false">
              batal
            </v-btn>

            <v-btn
              color="green darken-1"
              text
              @click="
                confirmasi = false;
                showAdd = false;
              "
            >
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
            Edit Penunjang
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
                  v-model="form.tahunAkademik"
                  label="Tahun Akademik"
                  required
                  readonly
                ></v-text-field>
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
                <v-text-field
                  v-model="form.namakegiatan"
                  label="Nama Kegiatan"
                  required
                  readonly
                ></v-text-field>
              </v-col>

              <v-col cols="12">
                <v-autocomplete
                  v-model="form.jenisKegiatan"
                  :items="jenis"
                  dense
                  filled
                  label="Jenis Kegiatan"
                  readonly
                ></v-autocomplete>
              </v-col>

              <v-col sm="4" md="4">
                <v-text-field
                  v-model="form.nilai"
                  label="Nilai"
                  required
                  readonly
                ></v-text-field>
              </v-col>

              <b-col cols="12">
                <h6>Berkas</h6>
                <iframe
                  src="./berkas/example.pdf"
                  frameborder="1"
                  width="100%"
                  height="500px"
                ></iframe>
              </b-col>
              <b-col cols="12">
                <v-textarea
                  outlined
                  name="input-7-4"
                  label="Catatan"
                  v-model="form.keterangan"
                  value=""
                ></v-textarea>
              </b-col>
            </v-row>
            <b-button
              type="button"
              class="mr-2"
              variant="success"
              @click="showAdd = false"
              >Valid</b-button
            >
            <b-button type="button" variant="danger" @click="showAdd = false"
              >Unvalid</b-button
            >
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>
    <CustomCard
      title="Daftar Kegiatan Penunjang"
      deskripsi="List Daftar Kegiatan Penunjang Yang Telah Di Inputkan"
      :isTopAction="false"
      :headers="headers"
      :contentTable="contentTables"
      :isDetail="false"
      :isDelete="false"
      @addNew="addNew"
      @editItem="editData"
    />
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import axios from "axios";
export default {
  name: "dataPenunjang",
  components: {
    CustomCard,
  },
  data() {
    return {
      totalKriteria: 1,
      form: {
        namaDosen: "",
        tahunAkademik: "2020/2021-Genap",
        semester: "Ganjil",
        namakegiatan: "",
        jenisKegiatan: "",
        ket: "",
        keterangan: "",
      },
      jenis: [
        { text: "Select One", value: null },
        "Sebagai Ketua/Wakil Ketua dan Anggota Pada Perguruan Tinggi",
        "Sebagai Anggota Suatu Panitia/Badan Pada Perguruan Tinggi",
        "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        "Sebagai Ketua/Wakil Ketua, Kepanitiaan Daerah Anggota Pada Lembaga Pemerintah",
        "Sebagai Anggota, Kepanitiaan Daerah Pada Lembaga Pemerintah",
        "Sebagai Pengurus Organisasi Profesi Tingkat Internasional",
        "Sebagai Anggota atas permintaan Organisasi Profesi Tingkat Internasional",
        "Sebagai Anggota Organisasi Profesi Tingkat Internasional",
        "Sebagai Pengurus Organisasi Profesi Tingkat Nasional",
        "Sebagai Anggota atas permintaan Organisasi Profesi Tingkat Nasional",
        "Sebagai Anggota Organisasi Profesi Tingkat Nasional",
        "Sebagai Ketua Delegasi Nasional Ke Pertemuaan Internasional",
        "Sebagai Anggota Delegasi Nasional Ke Pertemuaan Internasional",
        "Berperan Serta Aktif Dalam Pertemuan Ilmiah Tinggkat Internasionl/Nasional/Regional Sebagai Ketua",
        "Penghargaan/Tanda Jasa Satya Lencana 30 Tahun ",
        "Penghargaan/Tanda Jasa Satya Lencana 20 Tahun ",
        "Menulis Buku SMTA atau Setingkat Yang Diterbitkan Secara Nasional",
        "Menulis Buku SD atau Setingkat Yang Diterbitkan Secara Nasional",
        "Mempunyai Prestasi Tingkat Internasional Di Bidang Olahraga atau Humaniora",
        "Memepunyai Prestasi Tingkat Nasional Di Bidang Olahraga atau Humaniora",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Nama Dosen", value: "nama_dosen" },
        { text: "Nama Kegiatan", value: "namakegiatan" },
        // { text: "Tanggal Pengajuan", value: "masuk" },
        { text: "Status", value: "ket" },
        { text: "Aksi", value: "detail" },
      ],
      contentTables: [
        // {
        //   no: "1",
        //   nama_dosen: "I Putu Satwika, M.Kom",
        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Seminar Literasi Digital",
        //   masuk: "4 Juli 2020",
        //   jenis:
        //     "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //   ket: "Waiting",
        //   nilai: "20",
        //   keterangan: "",
        //   berkas: "example.pdf",
        // },

        // {
        //   no: "2",
        //   nama_dosen: "Eka Grana Aristyana Dewi, M.Pd",

        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Lomba Startup",
        //   masuk: "17 Agustus 2020",
        //   jenis:
        //     "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //   ket: "Waiting",
        //   nilai: "25",
        //   keterangan: "",
        //   berkas: "example.pdf",
        // },

        // {
        //   no: "3",
        //   nama_dosen: "I Putu Satwika, M.Kom",

        //   tahun_akademik: "2020/2021-Genap",
        //   namakegiatan: "Pelatihan Pembuatan Jurnal International",
        //   masuk: "9 Juli 2020",
        //   jenis: "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
        //   ket: "Waiting",
        //   nilai: "30",
        //   keterangan: "",
        //   berkas: "example.pdf",
        // },
      ],
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.auth.user.data
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Penunjang" }]);
    this.fetchPenunjang();
  },
  methods: {
    
    fetchPenunjang() {
      axios.get('http://localhost:8000/api/penunjang').then(res => {
        console.log("API Response:", res.data.data); // Log the API response

        const currentUserID = this.currentUser.id; // Get the ID of the current user

        this.contentTables = res.data.data
          .map((bf, index) => {
            console.log("Current Data:", bf); // Log the current data object being mapped
            return {
              no: index + 1,
              tahun_akademik: bf.tahun_akademik,
              nama_dosen: bf.name.user,
              namakegiatan: bf.nama_kegiatan,
              ket: bf.status,
              detail: bf.id,
            };
          });

        console.log("Content Tables:", this.contentTables); // Log the updated contentTables array
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
      this.form.nilai = item.nilai;
      this.form.keterangan = item.keterangan;
      this.showAdd = true;
      console.log(this.form);
    },
    addNew(value) {
      this.showAdd = value;
      this.form.tahunAkademik = "";
      this.form.semester = "";
      this.form.namakegiatan = "";
      this.form.jenisKegiatan = "";
      this.form.nilai = "";
      this.form.keterangan = "";
      this.form.ket = "";
    },
    onClick() {
      this.confirmasi = true;
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
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Penunjang" }]);
  },
};
</script>