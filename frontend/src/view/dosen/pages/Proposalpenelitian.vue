<template>
  <div>
    <b-tabs content-class="mt-3">
      <b-tab title="Laporan Kemajuan"
        ><b-card header="Laporan Kemajuan">
          <b-card header="Filter">
            <b-form @submit="onSubmit" v-if="show">
              <b-row>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    id="input-group-3"
                    label="Nama"
                    label-for="input-3"
                  >
                    <b-form-input
                      id="input-3"
                      v-model="form.nama"
                      required
                      placeholder="Masukan Nama"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-button type="submit" class="float-right" variant="primary"
                >Filter</b-button
              >
            </b-form>
          </b-card>
          <DataTableCustom
            class="mt-3"
            title="Pengabdian"
            :headers="headers"
            :contentTable="contentTables"
            @editData="editDataKemajuan"
            @detailData="editDataKemajuan"
          />
        </b-card>
      </b-tab>
      <b-tab title="Laporan Akhir">
        <b-card header="Laporan Akhir">
          <b-card header="Filter">
            <b-form @submit="onSubmit" v-if="show">
              <b-row>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
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
                </b-col>
                <b-col cols="6">
                  <b-form-group
                    id="input-group-3"
                    label="Nama"
                    label-for="input-3"
                  >
                    <b-form-input
                      id="input-3"
                      v-model="form.nama"
                      required
                      placeholder="Masukan Nama"
                    ></b-form-input>
                  </b-form-group>
                </b-col>
              </b-row>
              <b-button type="submit" class="float-right" variant="primary"
                >Filter</b-button
              >
            </b-form>
          </b-card>
          <DataTableCustom
            class="mt-3"
            title="Pengabdian"
            :headers="headers"
            :contentTable="contentTables"
            @editData="editDataAkhir"
            @detailData="editDataAkhir"
          />
        </b-card>
      </b-tab>
    </b-tabs>
  </div>
</template>

<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
// import DataTableCustom from "@/view/dosen/content/DataTableCustom";

export default {
  name: "Penilaian/penelitian",
  components: {
    DataTableCustom,
  },
  data() {
    return {
      form: {
        tahunAkademik: "",
        semester: "",
        prodi: "",
        nama: "",
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
      headers: [
        { text: "No", value: "no" },
        { text: "Nama", value: "nidn" },
        { text: "prodi", value: "nama" },
        { text: "Judul", value: "judul" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Semester", value: "semester" },
        { text: "Aksi", value: "aksi" },
      ],
      contentTables: [
        {
          no: "1",
          nama: "Test",
          prodi: "informatika",
          judul: "test judul",
          tahun_akademik: "2021/2022",
          semester: "Genap",
        },
        {
          no: "2",
          nama: "Test",
          prodi: "informatika",
          judul: "test judul",
          tahun_akademik: "2021/2022",
          semester: "Genap",
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

    editDataKemajuan(item) {
      console.log(item);
      this.$router.push({
        path: "/dosen/penilaian-penelitian",
        query: { tab: "kemajuan" },
      });
    },

    editDataAkhir(item) {
      console.log(item);
      this.$router.push({
        path: "/dosen/penilaian-penelitian",
        query: { tab: "akhir" },
      });
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [
      { title: "Penilaian Laporan Penelitian" },
    ]);
  },
};
</script>