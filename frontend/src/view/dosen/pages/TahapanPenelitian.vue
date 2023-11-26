<template>
  <div>
    <b-form @submit="onSubmit">
      <b-row>
        <b-col cols="6">
          <b-form-group
            id="input-group-1"
            label="Tahun Akademik"
            label-for="input-1"
          >
            <b-form-input
              id="input-1"
              v-model="form.tahunAkademik"
              required
              readonly
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col cols="6">
          <b-form-group id="input-group-2" label="Semester" label-for="input-2">
            <b-form-input
              id="input-2"
              v-model="form.semester"
              :options="semesters"
              required
              readonly
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col cols="12">
          <b-form-group id="input-group-5" label="Judul" label-for="input-5">
            <b-form-input
              id="input-5"
              v-model="form.judul"
              required
              placeholder="Masukan Judul"
            ></b-form-input>
          </b-form-group>
        </b-col>
        <b-col cols="6">
          <b-row>
            <b-col cols="12">
              <b-form-group
                id="input-group-9"
                label="Anggota Penelitian Dosen 1"
                label-for="input-9"
              >
                <b-form-select
                  id="input-9"
                  v-model="form.anggota1.nama"
                  required
                  placeholder="Masukan Anggota 1"
                  @change="changeAnggota1($event)"
                >
                  <option disabled>Pilih Anggota 1</option>
                  <option
                    :selected="form.anggota1.nama == data.nama"
                    v-for="(data, i) in Dosen"
                    :key="i"
                    :value="data.nama"
                  >
                    {{ data.nama }}
                  </option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <template v-if="showAnggota1">
              <CustomInput
                cols="12"
                InputLabel="NIDN"
                InputId="input-nidn-1"
                :contentValue="form.anggota1.nidn"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="Jabatan Fungsional"
                :contentValue="form.anggota1.jabatanFunsional"
                InputId="input-nidn-1"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="Program Studi"
                InputId="input-nidn-1"
                :contentValue="form.anggota1.programStudi"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="No Hp/Email"
                InputId="input-nidn-1"
                :contentValue="form.anggota1.noHPEmail"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
            </template>
          </b-row>
        </b-col>
        <b-col cols="6">
          <b-row>
            <b-col cols="12">
              <b-form-group
                id="input-group-9"
                label="Anggota Penelitian Dosen 2"
                label-for="input-9"
              >
                <b-form-select
                  id="input-9"
                  v-model="form.anggota2.nama"
                  required
                  placeholder="Masukan Anggota 2"
                  @change="changeAngota2($event)"
                >
                  <option disabled>Pilih Anggota 2</option>
                  <option
                    :selected="form.anggota2 == data.nama"
                    v-for="(data, i) in Dosen"
                    :key="i"
                    :value="data.nama"
                  >
                    {{ data.nama }}
                  </option>
                </b-form-select>
              </b-form-group>
            </b-col>
            <template v-if="showAnggota2">
              <CustomInput
                cols="12"
                InputLabel="NIDN"
                InputId="input-nidn"
                :contentValue="form.anggota2.nidn"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="Jabatan Fungsional"
                :contentValue="form.anggota2.jabatanFunsional"
                InputId="input-nidn"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="Program Studi"
                InputId="input-nidn"
                :contentValue="form.anggota2.programStudi"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
              <CustomInput
                cols="12"
                InputLabel="No Hp/Email"
                InputId="input-nidn"
                :contentValue="form.anggota2.noHPEmail"
                InputGroupId="input-group-nidn"
                PlaceHolder="input holder"
              />
            </template>
          </b-row>
        </b-col>
        <b-col cols="12">
          <b-row>
            <b-col cols="4">
              <b-row>
                <b-col cols="12">
                  <b-form-group
                    id="input-group-10"
                    label="Mahasiswa 1"
                    label-for="input-10"
                  >
                    <b-form-select
                      id="input-10"
                      v-model="form.mahasiswa1.nama"
                      required
                      placeholder="Masukan Anggota 1"
                      @change="changeMahasiswa1($event)"
                    >
                      <option
                        :selected="form.mahasiswa1 == data.nama"
                        v-for="(data, i) in DataMahasiswa"
                        :key="i"
                        :value="data.nama"
                      >
                        {{ data.nama }}
                      </option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <template v-if="showMahasiswa1">
                  <CustomInput
                    cols="12"
                    InputLabel="NIM"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa1.nim"
                    InputGroupId="input-group-nim"
                    PlaceHolder="input nim" />
                  <CustomInput
                    cols="12"
                    InputLabel="Prodi"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa1.prodi"
                    InputGroupId="input-group-prodi"
                    PlaceHolder="input prodi"
                /></template>
              </b-row>
            </b-col>
            <b-col cols="4">
              <b-row>
                <b-col cols="12">
                  <b-form-group
                    id="input-group-10"
                    label="Mahasiswa 2"
                    label-for="input-10"
                  >
                    <b-form-select
                      id="input-10"
                      v-model="form.mahasiswa2.nama"
                      required
                      placeholder="Masukan Anggota 2"
                      @change="changeMahasiswa2($event)"
                    >
                      <option
                        :selected="form.mahasiswa2.nama == data.nama"
                        v-for="(data, i) in DataMahasiswa"
                        :key="i"
                        :value="data.nama"
                      >
                        {{ data.nama }}
                      </option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <template v-if="showMahasiswa2">
                  <CustomInput
                    cols="12"
                    InputLabel="NIM"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa2.nim"
                    InputGroupId="input-group-nim"
                    PlaceHolder="input nim" />
                  <CustomInput
                    cols="12"
                    InputLabel="Prodi"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa2.prodi"
                    InputGroupId="input-group-prodi"
                    PlaceHolder="input prodi"
                /></template>
              </b-row>
            </b-col>
            <b-col cols="4">
              <b-row>
                <b-col cols="12">
                  <b-form-group
                    id="input-group-10"
                    label="Mahasiswa 3"
                    label-for="input-10"
                  >
                    <b-form-select
                      id="input-10"
                      v-model="form.mahasiswa3.nama"
                      required
                      placeholder="Masukan Anggota 3"
                      @change="changeMahasiswa3($event)"
                    >
                      <option
                        :selected="form.mahasiswa3.nama == data.nama"
                        v-for="(data, i) in DataMahasiswa"
                        :key="i"
                        :value="data.nama"
                      >
                        {{ data.nama }}
                      </option>
                    </b-form-select>
                  </b-form-group>
                </b-col>
                <template v-if="showMahasiswa3">
                  <CustomInput
                    cols="12"
                    InputLabel="NIM"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa3.nim"
                    InputGroupId="input-group-nim"
                    PlaceHolder="input nim" />
                  <CustomInput
                    cols="12"
                    InputLabel="Prodi"
                    InputId="input-nim"
                    :contentValue="form.mahasiswa3.prodi"
                    InputGroupId="input-group-prodi"
                    PlaceHolder="input prodi"
                /></template>
              </b-row>
            </b-col>
          </b-row>
        </b-col>

        <b-col cols="12">
          <b-form-group
            id="input-group-6"
            label="Bidang Fokus"
            label-for="input-6"
          >
            <b-form-select
              id="input-6"
              v-model="form.bidangFokus"
              :options="bidangfokuss"
              required
              placeholder="Masukan Bidang Fokus"
            ></b-form-select>
          </b-form-group>
        </b-col>

        <b-col cols="12">
          <b-form-group id="input-group-11" label="Mitra" label-for="input-11">
            <b-form-input
              id="input-11"
              v-model="form.mitra"
              required
              placeholder="Masukan Mitra"
            ></b-form-input>
          </b-form-group>
        </b-col>

        <div v-for="kriteria in totalKriteria" :key="kriteria">
          <b-row class="px-4">
            <b-col cols="3">
              <b-form-group
                id="input-group-7"
                label="Sumber Dana"
                label-for="input-7"
              >
                <b-form-select
                  id="input-7"
                  v-model="form.sumberDana"
                  :options="sumberdanas"
                  required
                  placeholder="Masukan Sumbar Dana"
                ></b-form-select>
              </b-form-group>
            </b-col>
            <b-col cols="4">
              <b-form-group
                id="input-group-12"
                label="Bentuk Dana"
                label-for="input-12"
              >
                <b-form-select
                  id="input-12"
                  v-model="form.bentukDana"
                  :options="bentukdanas"
                  required
                  placeholder="Masukan Bentuk Dana"
                ></b-form-select>
              </b-form-group>
            </b-col>

            <b-col cols="4">
              <b-form-group
                id="input-group-13"
                label="Jumlah Dana"
                label-for="input-13"
              >
                <b-form-input
                  id="input-13"
                  v-model="form.jumlahDana"
                  required
                  placeholder="Masukan Jumlah Dana"
                ></b-form-input>
              </b-form-group>
            </b-col>
            <b-col cols="1" class="pt-4">
              <b-button variant="success" class="mt-1" @click="totalKriteria++">
                <i class="flaticon-plus"></i></b-button
            ></b-col>
          </b-row>
        </div>

        <b-col cols="12">
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
        </b-col>
      </b-row>
      <b-button
        type="button"
        class="mr-2"
        variant="primary"
        @click="showAdd = false"
        >Close</b-button
      >

      <b-button type="button" variant="success" @click="showAdd = false"
        >Simpan</b-button
      >
    </b-form>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import CustomInput from "@/view/dosen/component/InputForm";
export default {
  name: "InputPenelitian",
  components: {
    CustomCard,
    CustomInput,
  },
  data() {
    return {
      totalKriteria: 1,
      form: {
        tahunAkademik: "2020/2021",
        semester: "Ganjil",
        judul: "",
        bidangFokus: "",
        mitra: "",
        sumberDana: "",
        bentukDana: "",
        jumlahDana: "",
        anggota1: {
          nama: "I Putu Satwika, S.Kom, M.Kom",
          nidn: "0801088891",
          jabatanFunsional: "rektor",
          programStudi: "Teknik Informatika",
          noHPEmail: "satwika@primakara.ac.id",
        },
        anggota2: {
          nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
          nidn: "0817028803",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Sistem Informasi Akuntansi",
          noHPEmail: "aris@primakara.ac.id",
        },
        mahasiswa1: {
          nama: "Yurina",
          nim: "17010100001",
          prodi: "sistem informasi",
        },
        mahasiswa2: {
          nama: "Anggela",
          nim: "17010100002",
          prodi: "sistem informasi akuntasni",
        },
        mahasiswa3: {
          nama: "Oktaviana",
          nim: "17010100003",
          prodi: "Teknik Infomatika",
        },
      },
      showAnggota2: false,
      showAnggota1: false,
      showMahasiswa1: false,
      showMahasiswa2: false,
      showMahasiswa3: false,
      DataMahasiswa: [
        {
          nama: "Yurina",
          nim: "17010100001",
          prodi: "sistem informasi",
        },
        {
          nama: "Anggela",
          nim: "17010100002",
          prodi: "sistem informasi akuntasni",
        },
        {
          nama: "Oktaviana",
          nim: "17010100003",
          prodi: "Teknik Infomatika",
        },
      ],
      Dosen: [
        {
          nama: "I Putu Satwika, S.Kom, M.Kom",
          nidn: "0801088891",
          jabatanFunsional: "rektor",
          programStudi: "Teknik Informatika",
          noHPEmail: "satwika@primakara.ac.id",
        },
        {
          nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
          nidn: "0817028803",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Sistem Informasi Akuntansi",
          noHPEmail: "aris@primakara.ac.id",
        },
        {
          nama: "Putu Trisna Hadi Permana, S.Pd, M.Pd",
          nidn: "0824049101",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Teknik Informatika",
          noHPEmail: "trisna@primakara.ac.id",
        },
      ],
      jenisPublkasis: [
        { text: "Select One", value: null },
        "Buku",
        "Jurnal",
        "HKI",
        "Majalah",
        "Media Massa",
      ],
      tingkatPublikasis: [
        { text: "Select One", value: null },
        "Lokal",
        "Nasional",
        "Internasional",
      ],
      tahunAkademiks: [
        { text: "Select One", value: null },
        "2021/2022",
        "2020/2021",
        "2019/2020",
        "2018/2019",
      ],
      sumberdanas: [
        { text: "Pilih Sumber Dana", value: null },
        "Perguruan Tinggi",
        "Kemenristek",
        "Mandiri",
        "Luar Perguruan Tinggi",
      ],
      bentukdanas: [
        { text: "Pilih Bentuk Dana", value: null },
        "In-Kind",
        "In-Cash",
      ],
      bidangfokuss: [
        { text: "Pilih Bidang Fokus", value: null },
        "Techopreneur",
        "Sistem Informasi",
        "IOT",
      ],
      prodis: [
        { text: "Pilih Prodi", value: null },
        "Informatika",
        "Sistem Informasi",
        "Sistem Informasi Ankuntansi",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      file: null,
      headers: [
        { text: "No", value: "no" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Semester", value: "semester" },
        { text: "Judul", value: "judul" },
        { text: "Status", value: "status" },
        { text: "Detail", value: "detail" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Perancangan Sistem Informasi Perpustakaan Digital ",
          status: "Submited",
        },

        {
          no: "2",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun ",
          status: "Aproved",
        },

        {
          no: "3",
          tahun_akademik: "2020/2021",
          semester: "Genap",
          judul: "Usability Testing Sistem Informasi Akademik ",
          status: "Rejected",
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
        path: "/dosen/tahapan-penelitian",
        query: { nama: item.judul },
      });
    },
    addNew(value) {
      this.showAdd = value;
    },
    changeAngota2(event) {
      let data = this.Dosen.find((dt) => dt.nama == this.form.anggota2.nama);
      this.form.anggota2.nidn = data.nidn;
      this.form.anggota2.jabatanFunsional = data.jabatanFunsional;
      this.form.anggota2.programStudi = data.programStudi;
      this.form.anggota2.noHPEmail = data.noHPEmail;
      this.showAnggota2 = true;
    },
    changeAnggota1(event) {
      let data = this.Dosen.find((dt) => dt.nama == this.form.anggota1.nama);
      this.form.anggota1.nidn = data.nidn;
      this.form.anggota1.jabatanFunsional = data.jabatanFunsional;
      this.form.anggota1.programStudi = data.programStudi;
      this.form.anggota1.noHPEmail = data.noHPEmail;
      this.showAnggota1 = true;
    },
    changeMahasiswa1(event) {
      let data = this.DataMahasiswa.find(
        (dt) => dt.nama == this.form.mahasiswa1.nama
      );
      this.form.mahasiswa1.nim = data.nim;
      this.form.mahasiswa1.prodi = data.prodi;
      this.showMahasiswa1 = true;
    },
    changeMahasiswa2(event) {
      let data = this.DataMahasiswa.find(
        (dt) => dt.nama == this.form.mahasiswa2.nama
      );
      this.form.mahasiswa2.nim = data.nim;
      this.form.mahasiswa2.prodi = data.prodi;
      this.showMahasiswa2 = true;
    },
    changeMahasiswa3(event) {
      let data = this.DataMahasiswa.find(
        (dt) => dt.nama == this.form.mahasiswa3.nama
      );
      this.form.mahasiswa3.nim = data.nim;
      this.form.mahasiswa3.prodi = data.prodi;
      this.showMahasiswa3 = true;
    },
  },
  mounted() {
    this.form.judul = this.$route.query.nama;
    console.log(this.form.judul);
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Detail Penelitian" }]);
  },
};
</script>