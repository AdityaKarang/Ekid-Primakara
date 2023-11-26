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
        label="Judul HKI"
        v-model="judulHki"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="Jenis HKI" v-model="jenisHki" readonly>
      </v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Nomor HKI"
        v-model="nomorHki"
        readonly
      ></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field label="Status" v-model="status" readonly></v-text-field>
    </v-col>
    <v-col cols="12">
      <v-text-field
        label="Nomor Pendaftaran"
        v-model="nomorPendaftaran"
        readonly
      ></v-text-field>
    </v-col>
  </v-row>
</template>
<script>
export default {
  name: "HKI",
  props: {
    jenis: String,
    tahunPelaksanaan: String,
    judulHki: String,
    jenisHki: String,
    nomorHki: String,
    status: String,
    nomorPendaftaran: String,
  },
};
</script>