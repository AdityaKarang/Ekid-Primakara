<template>
  <div>
    <v-card class="mb-2">
      <div class="m-5 mt-2 p-5">
        <h5>Nama: {{ nama }}</h5>
        <h6>NIDN: {{ nidn }}</h6>
      </div>
    </v-card>
    <v-card>
      <v-card-title>
        Hasil Penilaian Penunjang
        <v-spacer></v-spacer>
        <v-spacer></v-spacer>
        <v-select
          :items="dataFilterTahunAkademikSemester"
          v-model="filterTahunAkademik"
          label="Tahun Akademik dan semester"
          @change="onChangeFilter"
        ></v-select>
        <v-spacer></v-spacer>
        <v-text-field
          v-model="search"
          append-icon="search"
          label="Search"
          single-line
        ></v-text-field>
      </v-card-title>
      <v-data-table
        :headers="headerPenunjang"
        :items="penunjangs"
        hide-default-footer
      >
        <template slot="body.append">
          <tr>
            <th colspan="6" class="text-end">Total</th>
            <th>{{ getTotalNilai() }}</th>
          </tr>
          <tr>
            <th colspan="6" class="text-end">Predikat</th>
            <th>{{ getPredikat() }}</th>
          </tr>
          <tr>
            <th colspan="6" class="text-end">Konversi</th>
            <th>{{ getKonversi() }}</th>
          </tr>
        </template>
      </v-data-table>
    </v-card>
  </div>
</template>
<script>
export default {
  name: "KaprodiDetailPenunjang",
  data() {
    return {
      search: "",
      nama: "",
      nidn: "",
      filterTahunAkademik: "2021/2022-Genap",
      dataFilterTahunAkademikSemester: [
        "2021/2022-Genap",
        "2021/2022-Ganjil",
        "2020/2021-Genap",
        "2020/2021-Ganjil",
        "2019/2020-Genap",
        "2019/2020-Ganjil",
      ],
      headerPenunjang: [
        { text: "Jenis Kegiatan", value: "jenis" },
        { text: "Tingkat Kegiatan", value: "tingkat" },
        { text: "Nama Kegiatan", value: "namakegiatan" },
        { text: "Tahun Akademik", value: "tahun_akademik" },
        { text: "Bobot", value: "bobot" },
        { text: "Jumlah Kegitan", value: "jumlah_kegiatan" },
        { text: "Nilai", value: "nilai" },
      ],
      penunjangs: [
        {
          tahun_akademik: "2020/2021-Genap",
          namakegiatan: "Seminar Literasi Digital",
          jenis:
            "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          ket: "Waiting",
          tingkat: "International",
          nilai: "20",
          keterangan: "",
          berkas: "example.pdf",
        },
        {
          tahun_akademik: "2020/2021-Ganjil",
          namakegiatan: "Lomba Startup",
          jenis:
            "Sebagai Ketua/Wakil Ketua, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          ket: "Waiting",
          nilai: "25",
          tingkat: "Daerah",
          keterangan:
            "Bukti Kegiatan tidak sama dengan nama kegiatan yang diinputkan",
          berkas: "example.pdf",
        },
        {
          tahun_akademik: "2020/2021-Genap",
          namakegiatan: "Pelatihan Pembuatan Jurnal International",
          jenis: "Sebagai Anggota, Kepanitiaan Pusat Pada Lembaga Pemerintah",
          ket: "Waiting",
          tingkat: "International",
          nilai: "30",
          keterangan: "-",
          berkas: "example.pdf",
        },
      ],
      dataPenunjangUnfilter: [],
    };
  },
  methods: {
    setDataPenunjang() {
      let filterPenunjang = this.dataPenunjangUnfilter.filter((e) => {
        return e.tahun_akademik == this.filterTahunAkademik;
      });
      this.penunjangs = [];
      filterPenunjang.forEach((penunjang) => {
        let jenis = penunjang.jenis;
        let namaKegiatan = penunjang.namakegiatan;
        let tingkat = penunjang.tingkat;
        let bobot = penunjang.nilai;
        let tahun_akademik = penunjang.tahun_akademik;
        let jumlah = 0;
        filterPenunjang.forEach((p) => {
          let A = jenis.split(" ").join("");
          let B = p.jenis.split(" ").join("");
          if (A.toLowerCase() == B.toLowerCase()) {
            jumlah += 1;
          }
        });
        let nilai = jumlah * bobot;
        let findSame = this.penunjangs.find((f) => {
          return f.jenis == jenis;
        });
        if (!findSame) {
          this.penunjangs.push({
            jenis: jenis,
            namakegiatan: namaKegiatan,
            tingkat: tingkat,
            tahun_akademik: tahun_akademik,
            bobot: bobot,
            jumlah_kegiatan: jumlah,
            nilai: nilai,
          });
        }
      });
    },
    onChangeFilter() {
      this.setDataPenunjang();
    },
    getTotalNilai() {
      let total = 0;
      if (this.penunjangs.length <= 0) {
        return 0;
      }
      this.penunjangs.forEach((e) => {
        total += e.nilai;
      });
      return total;
    },
    getPredikat() {
      if (this.penunjangs.length <= 0) {
        return "Data Kosong";
      }
      let total = this.getTotalNilai();
      if (total >= 5) {
        return "Sangat Baik";
      } else if (total >= 3.5) {
        return "Baik";
      } else if (total >= 2) {
        return "Cukup";
      } else {
        return "Kurang";
      }
    },
    getKonversi() {
      return this.getTotalNilai();
    },
  },
  mounted() {
    this.nama = this.$route.params.data.nama;
    this.nidn = this.$route.params.data.nidn;
    this.dataPenunjangUnfilter = this.$route.params.data.penunjangs;
    this.setDataPenunjang();
  },
};
</script>