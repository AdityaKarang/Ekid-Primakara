<template>
  <v-row>
    <v-col cols="12">
      <v-text-field label="Tahun Terbit" v-model="tahunTerbit" readonly>
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="Judul Buku" v-model="judulBuku" readonly>
      </v-text-field>
    </v-col>

    <v-col cols="12">
      <v-text-field
        label="Jumlah Halaman"
        v-model="jumlahHalaman"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="ISBN" v-model="isbn" readonly></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Penerbit"
        v-model="Penerbit"
        readonly
      ></v-text-field> </v-col
  ></v-row>
</template>
<script>
export default {
  name: "buku",
  props: {
    jenis: String,
    tahunTerbit: String,
    judulBuku: String,
    jumlahHalaman: String,
    isbn: String,
    Penerbit: String,
  },
};
</script>