 <template>
  <div>
    <CustomCard
      title="Hasil Evaluasi Kinerja Dosen"
      :headers="headers"
      :contentTable="contentTables"
      :additionalData="additionalData"
      :isTopAction="false"
      :isEdit="false"
      :isDelete="false"
      @detailItem="detailData"
    >
      <template v-slot:filter>
        <div class="w-30 mr-2">
          <v-select
            :items="dataFilterTahunAkademikSemester"
            v-model="filterTahunAkademik"
            label="Tahun Akademik dan semester"
          ></v-select>
        </div>
      </template>
    </CustomCard>
    <v-card flat>
      <v-card-text>
        <table>
          <tbody>
            <tr>
              <td><h5>Rata - Rata</h5></td>
              <td>
                <h5>: {{ getRataRata() }}</h5>
              </td>
            </tr>
            <tr>
              <td><h5>Nilai Tertinggi</h5></td>
              <td>
                <h5>: {{ getNilaiTertinggi() }}</h5>
              </td>
            </tr>
            <tr>
              <td><h5>Nilai Terendah</h5></td>
              <td>
                <h5>: {{ getNilaiTerendah() }}</h5>
              </td>
            </tr>
          </tbody>
        </table>
      </v-card-text>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";

export default {
  name: "KaprodiRekapitulasi",
  components: {
    CustomCard,
  },
  data() {
    return {
      showPublikasi: false,
      datalistPublikasi: [],
      filterTahunAkademik: "2021/2022-Genap",
      dataFilterTahunAkademikSemester: [
        "2021/2022-Genap",
        "2021/2022-Ganjil",
        "2020/2021-Genap",
        "2020/2021-Ganjil",
        "2019/2020-Genap",
        "2019/2020-Ganjil",
      ],
      additionalData: {
        timReviewer: ["I Putu Satwika", "Eka Grana aristya dewi"],
      },

      headers: [
        { text: "No", value: "no" },
        { text: "NIDN", value: "nidn" },
        {
          text: "Tahun Akademik",
          value: "tahun_akademik",
          sortable: false,
          filter: (f) => {
            if (!this.filterTahunAkademik) return true;
            return (f + "")
              .toLowerCase()
              .includes(this["filterTahunAkademik"].toLowerCase());
          },
        },
        { text: "Nama", value: "nama" },
        { text: "Nilai Pendidikan", value: "nilai_pendidkan" },
        { text: "Nilai Penelitian", value: "nilai_penelitian" },
        { text: "Nilai Pengabdian", value: "nilai_pengabdian" },
        { text: "Nilai Penunjang", value: "nilai_penunjang" },
        { text: "Nilai Akhir", value: "nilai_akhir" },
      ],
      contentTables: [
        {
          no: "1",
          tahun_akademik: "2021/2022-Genap",
          nidn: "0801088901",
          nama: "I Putu Satwika, M.Kom",
          nilai_pendidikan: 80,
          nilai_penelitian: 10,
          nilai_pengabdian: 20,
          nilai_penunjang: 20,
          nilai_akhir: 20,
        },

        {
          no: "2",
          tahun_akademik: "2021/2022-Genap",
          nidn: "0811078902",
          nama: "I Nyoman Yudi Anggara Wijaya, S.Kom., M.T",
          nilai_pendidikan: 10,
          nilai_penelitian: 70,
          nilai_pengabdian: 80,
          nilai_penunjang: 30,
          nilai_akhir: 10,
        },

        {
          no: "3",
          tahun_akademik: "2019/2020-Ganjil",
          nidn: "0802078402",
          nama: "I Gede Juliana Eka Putra, S.T., M.T",
          nilai_pendidikan: 20,
          nilai_penelitian: 90,
          nilai_pengabdian: 10,
          nilai_penunjang: 30,
          nilai_akhir: 20,
        },

        {
          no: "4",
          tahun_akademik: "2019/2020-Ganjil",
          nidn: "0817028803",
          nama: "Eka Grana Aristyana Dewi, M.Pd",
          nilai_pendidikan: 25,
          nilai_penelitian: 92,
          nilai_pengabdian: 10,
          nilai_penunjang: 70,
          nilai_akhir: 20,
        },
      ],
    };
  },
  methods: {
    detailData(item) {
      this.$router.push({
        name: "kaprodi-penunjang-detindieheiindo23@gmail.comail",
        params: { data: item },
      });
    },
    getRataRata() {
      let dataFilter = this.contentTables.filter((e) => {
        return e.tahun_akademik == this.filterTahunAkademik;
      });
      if (dataFilter.length <= 0) {
        return 0;
      }

      console.log(dataFilter);
      let total = 0;
      dataFilter.forEach((val) => {
        total += val.nilai_akhir;
      });
      return total / dataFilter.length;
    },
    getNilaiTertinggi() {
      let dataFilter = this.contentTables.filter((e) => {
        return e.tahun_akademik == this.filterTahunAkademik;
      });
      if (dataFilter.length <= 0) {
        return 0;
      }

      console.log(dataFilter);
      dataFilter.sort((a, b) => {
        return b.nilai_akhir - a.nilai_akhir;
      });
      return dataFilter[0].nilai_akhir;
    },
    getNilaiTerendah() {
      let dataFilter = this.contentTables.filter((e) => {
        return e.tahun_akademik == this.filterTahunAkademik;
      });
      if (dataFilter.length <= 0) {
        return 0;
      }

      dataFilter.sort((a, b) => {
        return a.nilai_akhir - b.nilai_akhir;
      });
      return dataFilter[0].nilai_akhir;
    },
  },
  mounted() {
    this.$store.dispatch(SET_BREADCRUMB, [{ title: "Rekapitulasi" }]);
  },
};
</script> 