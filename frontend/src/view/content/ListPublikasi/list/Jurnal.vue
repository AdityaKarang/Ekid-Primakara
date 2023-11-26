<template>
  <v-row>
    <v-col cols="12">
      <v-text-field label="Tahun Publikasi" v-model="tahunPublikasi" readonly>
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Jenis Publikasi Jurnal"
        v-model="jenisPublikasi"
        readonly
      >
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Judul Publikasi"
        v-model="judulPublikasi"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Nama Jurnal"
        v-model="namaJurnal"
        readonly
      ></v-text-field>
      <v-text-field
        label="ISSN Jurnal"
        v-model="issnJurnal"
        readonly
      ></v-text-field>
      <v-col cols="12">
        <v-text-field label="Volume" v-model="volume" readonly></v-text-field>
      </v-col>
      <v-col cols="12">
        <v-text-field label="Nomor" v-model="nomor" readonly></v-text-field>
      </v-col>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Halaman Jurnal"
        v-model="halamanJurnal"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="URL" v-model="url" readonly></v-text-field>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "Jurnal",
  props: {
    jenis: String,
    tahunPublikasi: String,
    jenisPublikasi: String,
    judulPublikasi: String,
    namaJurnal: String,
    issnJurnal: String,
    volume: String,
    nomor: String,
    halamanJurnal: String,
    url: String,
  },
};
</script>