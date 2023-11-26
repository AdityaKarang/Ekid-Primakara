<template>
  <v-expansion-panels>
    <v-expansion-panel v-for="(item, i) in dataList" :key="i">
      <template v-if="item.jenis == 'buku'">
        <v-expansion-panel-header>
          <h4>{{ item.jenis }} : {{ item.judulBuku }}</h4>
          <v-spacer></v-spacer>
          <v-btn
            v-if="isDelete"
            @click="remove(item)"
            width="20px"
            small
            color="danger"
          >
            hapus</v-btn
          >
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <Buku
            :jenis="item.jenis"
            :tahunTerbit="item.tahunTerbit"
            :judulBuku="item.judulBuku"
            :jumlahHalaman="item.jumlahHalaman"
            :isbn="item.isbn"
            :Penerbit="item.penerbit"
          ></Buku>
        </v-expansion-panel-content>
      </template>
      <template v-if="item.jenis == 'jurnal'">
        <v-expansion-panel-header>
          <h4>{{ item.jenis }}: {{ item.judulPublikasi }}</h4>
          <v-spacer></v-spacer>
          <v-btn
            v-if="isDelete"
            @click="remove(item)"
            width="20px"
            small
            color="danger"
          >
            hapus</v-btn
          >
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <Jurnal
            :jenis="item.jenis"
            :tahunPublikasi="item.tahunPublikasi"
            :jenisPublikasi="item.jenisPublikasi"
            :judulPublikasi="item.judulPublikasi"
            :namaJurnal="item.namaJurnal"
            :issnJurnal="item.issnJurnal"
            :volume="item.volume"
            :nomor="item.nomor"
            :halamanJurnal="item.halamanJurnal"
            :url="item.url"
          ></Jurnal>
        </v-expansion-panel-content>
      </template>
      <template v-if="item.jenis == 'mediamassa'">
        <v-expansion-panel-header>
          <h4>{{ item.jenis }}: {{ item.judulPublikasi }}</h4>
          <v-spacer></v-spacer>
          <v-btn
            v-if="isDelete"
            @click="remove(item)"
            width="20px"
            small
            color="danger"
          >
            hapus</v-btn
          >
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <MediaMassa
            :jenis="item.jenis"
            :tanggalPublikasi="item.tanggalPublikasi"
            :judulPublikasi="item.judulPublikasi"
            :namaMedia="item.namaMedia"
            :url="item.url"
          ></MediaMassa>
        </v-expansion-panel-content>
      </template>

      <template v-if="item.jenis == 'forumilmiah'">
        <v-expansion-panel-header>
          <h4>{{ item.jenis }}: {{ item.judulMakalah }}</h4>
          <v-spacer></v-spacer>
          <v-btn
            v-if="isDelete"
            @click="remove(item)"
            width="20px"
            small
            color="danger"
          >
            hapus</v-btn
          >
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <ForumIlmiah
            :jenis="item.jenis"
            :tahunPelaksanaan="item.tahunPelaksanaan"
            :tingkatForumIlmiah="item.tingkatForumIlmiah"
            :namaForum="item.namaForum"
            :judulMakalah="item.judulMakalah"
            :institusiPenyelenggara="item.institusiPenyelenggara"
            :waktuPelaksanaan="item.waktuPelaksanaan"
            :tempatPelaksanaan="item.tempatPelaksanaan"
          ></ForumIlmiah>
        </v-expansion-panel-content>
      </template>
      <template v-if="item.jenis == 'hki'">
        <v-expansion-panel-header>
          <h4>{{ item.jenis }}: {{ item.judulHki }}</h4>
          <v-spacer></v-spacer>
          <v-btn
            v-if="isDelete"
            @click="remove(item)"
            width="20px"
            small
            color="danger"
          >
            hapus</v-btn
          >
        </v-expansion-panel-header>
        <v-expansion-panel-content>
          <Hki
            :jenis="item.jenis"
            :tahunPelaksanaan="item.tahunPelaksanaan"
            :judulHki="item.judulHki"
            :jenisHki="item.jenisHki"
            :nomorHki="item.nomorHki"
            :status="item.status"
            :nomorPendaftaran="item.nomorPendaftaran"
          ></Hki>
        </v-expansion-panel-content>
      </template>
    </v-expansion-panel>
  </v-expansion-panels>
</template>
<script>
import Buku from "@/view/content/ListPublikasi/list/Buku.vue";
import Jurnal from "@/view/content/ListPublikasi/list/Jurnal.vue";
import MediaMassa from "@/view/content/ListPublikasi/list/MediaMassa.vue";
import ForumIlmiah from "@/view/content/ListPublikasi/list/ForumIlmiah.vue";
import Hki from "@/view/content/ListPublikasi/list/Hki.vue";

export default {
  name: "listPublikasi",
  props: {
    dataList: {
      type: Array,
      default: [],
    },
    isDelete: {
      type: Boolean,
      default: false,
    },
  },
  components: {
    Buku,
    Jurnal,
    MediaMassa,
    ForumIlmiah,
    Hki,
  },
  methods: {
    remove(item) {
      const index = this.dataList.indexOf(item);
      if (index >= 0) this.dataList.splice(index, 1);
    },
  },
  mounted() {
    console.log(this.dataList);
  },
};
</script>