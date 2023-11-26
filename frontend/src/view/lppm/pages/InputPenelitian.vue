<template>
  <div>
    <div>
      <b-tabs content-class="mt-3">
        <b-tab title="Proposal" :active="this.$route.query.tab === 'proposal'">
          <b-card class="" header="Form input proposal">
            <b-form @submit="onSubmit" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Tahun Akademik"
                label-for="input-1"
              >
                <b-form-select
                  id="input-1"
                  v-model="form.tahunAkademik"
                  :options="tahunAkademiks"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Semester"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.semester"
                  :options="semesters"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group id="input-group-3" label="Nama" label-for="input-3">
                <b-form-input
                  id="input-3"
                  v-model="form.nama"
                  required
                  placeholder="Masukan Nama"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-4"
                label="Prodi"
                label-for="input-4"
              >
                <b-form-select
                  id="input-4"
                  v-model="form.prodi"
                  :options="prodis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-5"
                label="Judul"
                label-for="input-5"
              >
                <b-form-input
                  id="input-5"
                  v-model="form.judul"
                  required
                  placeholder="Masukan Judul"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-6"
                label="Bidang Fokus"
                label-for="input-6"
              >
                <b-form-input
                  id="input-6"
                  v-model="form.bidangFokus"
                  required
                  placeholder="Masukan Bidang Fokus"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-7"
                label="Sumber Dana"
                label-for="input-7"
              >
                <b-form-input
                  id="input-7"
                  v-model="form.sumberDana"
                  required
                  placeholder="Masukan Sumbar Dana"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-8"
                label="Upload Proposal"
                label-for="input-8"
              >
                <b-form-file
                  v-model="file"
                  class="mt-3"
                  id="input-8"
                  plain
                ></b-form-file>
              </b-form-group>
              <b-button type="submit" variant="primary">Simpan</b-button>
            </b-form>
          </b-card>
        </b-tab>
        <b-tab
          title="Laporan Kemajuan"
          :active="this.$route.query.tab === 'kemajuan'"
        >
          <b-card class="" header="Form input laporan kemajuan">
            <b-form @submit="onSubmit" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Tahun Akademik"
                label-for="input-1"
              >
                <b-form-select
                  id="input-1"
                  v-model="form.tahunAkademik"
                  :options="tahunAkademiks"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Semester"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.semester"
                  :options="semesters"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group id="input-group-3" label="Nama" label-for="input-3">
                <b-form-input
                  id="input-3"
                  v-model="form.nama"
                  required
                  placeholder="Masukan Nama"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-4"
                label="Prodi"
                label-for="input-4"
              >
                <b-form-select
                  id="input-4"
                  v-model="form.prodi"
                  :options="prodis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-5"
                label="Judul"
                label-for="input-5"
              >
                <b-form-input
                  id="input-5"
                  v-model="form.judul"
                  required
                  placeholder="Masukan Judul"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-8"
                label="Upload Laporan Kemajuan"
                label-for="input-8"
              >
                <b-form-file
                  v-model="file"
                  class="mt-3"
                  id="input-8"
                  plain
                ></b-form-file>
              </b-form-group>
              <b-button type="submit" variant="primary">Simpan</b-button>
            </b-form>
          </b-card></b-tab
        >
        <b-tab
          title="Laporan Akhir"
          :active="this.$route.query.tab === 'akhir'"
        >
          <b-card class="" header="Form input laporan akhir">
            <b-form @submit="onSubmit" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Tahun Akademik"
                label-for="input-1"
              >
                <b-form-select
                  id="input-1"
                  v-model="form.tahunAkademik"
                  :options="tahunAkademiks"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Semester"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.semester"
                  :options="semesters"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group id="input-group-3" label="Nama" label-for="input-3">
                <b-form-input
                  id="input-3"
                  v-model="form.nama"
                  required
                  placeholder="Masukan Nama"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-4"
                label="Prodi"
                label-for="input-4"
              >
                <b-form-select
                  id="input-4"
                  v-model="form.prodi"
                  :options="prodis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-5"
                label="Judul"
                label-for="input-5"
              >
                <b-form-input
                  id="input-5"
                  v-model="form.judul"
                  required
                  placeholder="Masukan Judul"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-8"
                label="Upload Laporan akhir"
                label-for="input-8"
              >
                <b-form-file
                  v-model="file"
                  class="mt-3"
                  id="input-8"
                  plain
                ></b-form-file>
              </b-form-group>
              <b-button type="submit" variant="primary">Simpan</b-button>
            </b-form>
          </b-card>
        </b-tab>
        <b-tab
          title="Publikasi"
          :active="this.$route.query.tab === 'publikasi'"
        >
          <b-card class="" header="Form input publikasi">
            <b-form @submit="onSubmit" v-if="show">
              <b-form-group
                id="input-group-1"
                label="Tahun Akademik"
                label-for="input-1"
              >
                <b-form-select
                  id="input-1"
                  v-model="form.tahunAkademik"
                  :options="tahunAkademiks"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-2"
                label="Semester"
                label-for="input-2"
              >
                <b-form-select
                  id="input-2"
                  v-model="form.semester"
                  :options="semesters"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group id="input-group-3" label="Nama" label-for="input-3">
                <b-form-input
                  id="input-3"
                  v-model="form.nama"
                  required
                  placeholder="Masukan Nama"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-4"
                label="Prodi"
                label-for="input-4"
              >
                <b-form-select
                  id="input-4"
                  v-model="form.prodi"
                  :options="prodis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-5"
                label="Judul Publikasi"
                label-for="input-5"
              >
                <b-form-input
                  id="input-5"
                  v-model="form.judul"
                  required
                  placeholder="Masukan Judul"
                ></b-form-input>
              </b-form-group>
              <b-form-group
                id="input-group-6"
                label="Jenis Publikasi"
                label-for="input-6"
              >
                <b-form-select
                  id="input-6"
                  v-model="form.jenisPublkasi"
                  :options="jenisPublkasis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-7"
                label="Tingkat Publikasi"
                label-for="input-7"
              >
                <b-form-select
                  id="input-7"
                  v-model="form.tingkatPublikasi"
                  :options="tingkatPublikasis"
                  required
                ></b-form-select>
              </b-form-group>
              <b-form-group
                id="input-group-8"
                label="Upload Laporan akhir"
                label-for="input-8"
              >
                <b-form-file
                  v-model="file"
                  class="mt-3"
                  id="input-8"
                  plain
                ></b-form-file>
              </b-form-group>
              <b-button type="submit" variant="primary">Simpan</b-button>
            </b-form>
          </b-card></b-tab
        >
      </b-tabs>
    </div>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
export default {
  name: "InputPenelitian",
  data() {
    return {
      form: {
        tahunAkademik: "",
        semester: "",
        prodi: "",
        nama: "",
        judul: "",
        bidangFokus: "",
        sumberDana: "",
        jenisPublkasi: "",
        tingkatPublikasi: "",
      },
      jenisPublkasis: [
        { text: "Select One", value: null },
        "buku",
        "jurnal",
        "HKI",
        "Majalah",
      ],
      tingkatPublikasis: [
        { text: "Select One", value: null },
        "internasional",
        "nasional",
        "lokal",
      ],
      tahunAkademiks: [
        { text: "Select One", value: null },
        "2021/2022",
        "2020/2021",
        "2019/2020",
        "2018/2019",
      ],
      prodis: [
        { text: "Pilih Prodi", value: null },
        "Informatika",
        "Sistem Informasi",
        "Sistem Informasi Ankuntansi",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      show: true,
      file: null,
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
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Penelitian" }]);
  },
};
</script>