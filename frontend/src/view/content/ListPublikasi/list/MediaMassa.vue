<template>
  <v-row>
    <v-col cols="12">
      <v-text-field
        label="Tanggal Publikasi"
        v-model="tanggalPublikasi"
        readonly
      ></v-text-field>
    </v-col>

    <v-col cols="12">
      <v-text-field
        label="Judul Publikasi"
        v-model="judulPublikasi"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="Nama Media" v-model="namaMedia" readonly>
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="URL" v-model="url" readonly></v-text-field>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "MediaMassa",
  props: {
    jenis: String,
    tanggalPublikasi: String,
    judulPublikasi: String,
    namaMedia: String,
    url: String,
  },
};
</script>