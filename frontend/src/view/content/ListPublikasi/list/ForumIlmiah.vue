<template>
  <v-row>
    <v-col cols="12">
      <v-text-field
        label="Tahun Pelaksanaan"
        v-model="tahunPelaksanaan"
        readonly
      >
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Tingkat Forum Ilmiah"
        v-model="tingkatForumIlmiah"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="Nama Forum" v-model="namaForum" readonly>
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Judul Makalah"
        v-model="judulMakalah"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Institusi Penyelenggara"
        v-model="institusiPenyelenggara"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Waktu Pelaksanaan"
        v-model="waktuPelaksanaan"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Tempat Pelaksanaan"
        v-model="tempatPelaksanaan"
        readonly
      ></v-text-field>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "ForumIlmiah",
  props: {
    jenis: String,
    tahunPelaksanaan: String,
    tingkatForumIlmiah: String,
    namaForum: String,
    judulMakalah: String,
    institusiPenyelenggara: String,
    waktuPelaksanaan: String,
    tempatPelaksanaan: String,
  },
};
</script>
