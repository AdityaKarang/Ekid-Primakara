<template>
  <div>
    <v-row justify="center">
      <v-dialog v-model="dialogPublikasi" persistent max-width="800px">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Form Publikasi
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="dialogPublikasi = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-select
                    v-model="formPublikasi.jenisPublkasi"
                    :items="listPublikasi"
                    label="Jenis Publikasi"
                    required
                    @change="onJenisPublikasi"
                  >
                  </v-select>
                </v-col>
                <template v-if="onCheckSelectFormStatus('Buku')">
                  <v-col cols="12">
                    <v-text-field
                      label="Tahun Terbit"
                      v-model="formPublikasi.buku.tahunTerbit"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Judul Buku"
                      v-model="formPublikasi.buku.judul"
                      required
                    >
                    </v-text-field>
                  </v-col>

                  <v-col cols="12">
                    <v-text-field
                      label="Jumlah Halaman"
                      v-model="formPublikasi.buku.halaman"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="ISBN"
                      v-model="formPublikasi.buku.isbn"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Penerbit"
                      v-model="formPublikasi.buku.penerbit"
                      required
                    ></v-text-field>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('Jurnal')">
                  <v-col cols="12">
                    <v-text-field
                      label="Tahun Publikasi"
                      v-model="formPublikasi.jurnal.tahun"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select
                      label="Jenis Publikasi Jurnal"
                      v-model="formPublikasi.jurnal.jenis"
                      :items="jenisjurnal"
                      required
                    >
                    </v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Judul Publikasi"
                      v-model="formPublikasi.jurnal.judul"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Nama Jurnal"
                      v-model="formPublikasi.jurnal.nama"
                      required
                    ></v-text-field>
                    <v-text-field
                      label="ISSN Jurnal"
                      v-model="formPublikasi.jurnal.issn"
                      required
                    ></v-text-field>
                    <v-col cols="12">
                      <v-text-field
                        label="Volume"
                        v-model="formPublikasi.jurnal.volume"
                        required
                      ></v-text-field>
                    </v-col>
                    <v-col cols="12">
                      <v-text-field
                        label="Nomor"
                        v-model="formPublikasi.jurnal.nomor"
                        required
                      ></v-text-field>
                    </v-col>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Halaman Jurnal"
                      v-model="formPublikasi.jurnal.halaman"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="URL"
                      v-model="formPublikasi.jurnal.url"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input label="Upload Jurnal"></v-file-input>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('Media Massa')">
                  <v-col cols="12">
                    <v-menu
                      ref="waktuBuka"
                      v-model="formPublikasi.mediamasa.calendar"
                      :close-on-content-click="false"
                      transition="scale-transition"
                      offset-y
                      max-width="290px"
                      min-width="auto"
                    >
                      <template v-slot:activator="{ on, attrs }">
                        <v-text-field
                          v-model="formPublikasi.mediamasa.tanggal"
                          label="Tanggal Publikasi"
                          hint="MM/DD/YYYY format"
                          persistent-hint
                          prepend-icon="mdi-calendar"
                          v-bind="attrs"
                          @blur="
                            formPublikasi.mediamasa.tanggal = parseDate(
                              formPublikasi.mediamasa.tanggal
                            )
                          "
                          v-on="on"
                        ></v-text-field>
                      </template>
                      <v-date-picker
                        v-model="formPublikasi.mediamasa.tanggal"
                        no-title
                        @input="formPublikasi.mediamasa.calendar = false"
                      ></v-date-picker>
                    </v-menu>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Judul Publikasi"
                      v-model="formPublikasi.mediamasa.judul"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Nama Media"
                      v-model="formPublikasi.mediamasa.media"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="URL"
                      v-model="formPublikasi.mediamasa.url"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input
                      label="Upload Dokumen Pendukung lainnya"
                    ></v-file-input>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('Forum Ilmiah')">
                  <v-col cols="12">
                    <v-text-field
                      label="Tahun Pelaksanaan"
                      v-model="formPublikasi.forumilmiah.tahun"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select
                      label="Tingkat Forum Ilmiah"
                      v-model="formPublikasi.forumilmiah.tingkat"
                      :items="tingkatilmiah"
                      required
                    ></v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Nama Forum"
                      v-model="formPublikasi.forumilmiah.namaforum"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Judul Makalah"
                      v-model="formPublikasi.forumilmiah.makalah"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Institusi Penyelenggara"
                      v-model="formPublikasi.forumilmiah.institusi"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Waktu Pelaksanaan"
                      v-model="formPublikasi.forumilmiah.waktu"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Tempat Pelaksanaan"
                      v-model="formPublikasi.forumilmiah.tempat"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input
                      label="Upload Dokumen Forum Ilmiah"
                    ></v-file-input>
                  </v-col>
                </template>

                <template v-if="onCheckSelectFormStatus('HKI')">
                  <v-col cols="12">
                    <v-text-field
                      label="Tahun Pelaksanaan"
                      v-model="formPublikasi.hki.tahun"
                      required
                    >
                    </v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Judul HKI"
                      v-model="formPublikasi.hki.judul"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-select
                      label="Jenis HKI"
                      v-model="formPublikasi.hki.jenis"
                      :items="jenishki"
                      required
                    >
                    </v-select>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Nomor HKI"
                      v-model="formPublikasi.hki.nomor"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Status"
                      v-model="formPublikasi.hki.status"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-text-field
                      label="Nomor Pendaftaran"
                      v-model="formPublikasi.hki.pendaftaran"
                      required
                    ></v-text-field>
                  </v-col>
                  <v-col cols="12">
                    <v-file-input label="Upload Dokumen HKI"></v-file-input>
                  </v-col>
                </template>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn color="blue darken-1" text @click="dialogPublikasi = false"
              >Submit</v-btn
            >
          </v-card-actions>
        </v-card>
      </v-dialog>
    </v-row>
    <v-row justify="center">
      <v-dialog v-model="dialogUploadBerkas" persistent max-width="600px">
        <v-card>
          <v-toolbar flat>
            <v-icon>mdi-file</v-icon>
            <v-toolbar-title class="font-weight-light">
              Upload {{ titleUploadBerkas }}
            </v-toolbar-title>
            <v-spacer></v-spacer>
            <v-btn color="white" fab small @click="dialogUploadBerkas = false">
              <v-icon> mdi-close </v-icon>
            </v-btn>
          </v-toolbar>

          <v-card-text>
            <v-container>
              <v-row>
                <v-col cols="12">
                  <v-file-input
                    show-size
                    counter
                    v-model="formBerkas.file"
                    label="Upload Berkas"
                    :disabled="checkDisable(formBerkas.status)"
                  ></v-file-input>
                </v-col>
                <v-col cols="12">
                  <v-textarea
                    name="input-keterangan"
                    label="Keterangan"
                    outlined
                    v-model="formBerkas.keterangan"
                    :disabled="checkDisable(formBerkas.status)"
                    value=""
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-container>
          </v-card-text>
          <v-card-actions>
            <v-spacer></v-spacer>
            <v-btn
              v-if="!checkDisable(formBerkas.status)"
              color="blue darken-1"
              text
              @click="dialogUploadBerkas = false"
              >Simpan</v-btn
            >
          </v-card-actions>
        </v-card>
        <v-expansion-panels
          v-if="formBerkas.penilaian && checkDisable(formBerkas.status)"
        >
          <v-expansion-panel>
            <v-expansion-panel-header>
              <h4>Hasil Penilaian</h4>
            </v-expansion-panel-header>
            <v-expansion-panel-content>
              <v-data-table
                :headers="formBerkas.penilaian.header"
                :items="formBerkas.penilaian.dataNilai"
                hide-default-footer
              >
                <template slot="item" slot-scope="props">
                  <template v-for="(indikator, i) in props.item.indikators">
                    <tr :key="i">
                      <td
                        class="text-start"
                        v-if="i == 0"
                        :rowspan="props.item.indikators.length"
                      >
                        {{ props.item.no }}
                      </td>
                      <td
                        class="text-start"
                        v-if="i == 0"
                        :rowspan="props.item.indikators.length"
                      >
                        {{ props.item.kriteria }}
                      </td>
                      <td>{{ indikator.name }}</td>
                      <td>{{ indikator.bobot }}</td>
                      <td>
                        {{ indikator.nilai }}
                      </td>
                      <!-- <v-text-field v-model="item.nilai" type="number"></v-text-field> -->
                    </tr>
                  </template>
                </template>

                <template slot="body.append">
                  <tr>
                    <th colspan="4" class="text-end">Total</th>
                    <th>
                      {{ getTotalValue(formBerkas.penilaian.dataNilai) }}
                    </th>
                  </tr>
                </template>
              </v-data-table>
              <v-row>
                <v-col cols="12">
                  <v-textarea
                    name="catatan"
                    label="catatan"
                    outlined
                    v-model="catatan_penilaian"
                    disabled
                    value=""
                  ></v-textarea>
                </v-col>
              </v-row>
            </v-expansion-panel-content>
          </v-expansion-panel>
        </v-expansion-panels>
      </v-dialog>
    </v-row>

    <v-dialog v-model="showPublikasi" max-width="400px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon> mdi-format-list-bulleted</v-icon>
          <v-toolbar-title class="font-weight-light">
            List Publikasi
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" small @click="dialogPublikasi = true">
            <v-icon> mdi-plus</v-icon> Tambah Publikasi
          </v-btn>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showPublikasi = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <ListPublikasi
            :dataList="datalistPublikasi"
            :isDelete="true"
            :isEdit="true"
          ></ListPublikasi>
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="showFormDosenLuar" max-width="400px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-file</v-icon>
          <v-toolbar-title class="font-weight-light">
            Tambah Dosen Luar Kampus
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showFormDosenLuar = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-row>
            <v-col md="12">
              <v-text-field
                v-model="formDosenLuar.nama"
                label="Nama"
                required
              ></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field
                v-model="formDosenLuar.nidn"
                label="NIDN"
                required
              ></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field
                v-model="formDosenLuar.noHPEmail"
                label="No HP atau Email"
                required
              ></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field
                v-model="formDosenLuar.falkultas"
                label="Fakultas"
                required
              ></v-text-field>
            </v-col>
            <v-col md="12">
              <v-text-field
                v-model="formDosenLuar.universitas"
                label="Universitas"
                required
              ></v-text-field>
            </v-col>
          </v-row>
          <b-button
            type="button"
            variant="primary"
            @click="addAnggotaDosenLuar()"
            >Simpan</b-button
          >
        </v-card-text>
      </v-card>
    </v-dialog>
    <v-dialog v-model="showAdd" max-width="800px">
      <v-card class="">
        <v-toolbar flat>
          <v-icon>mdi-file</v-icon>
          <v-toolbar-title class="font-weight-light">
            Tambah Proposal
          </v-toolbar-title>
          <v-spacer></v-spacer>
          <v-btn color="white" fab small @click="showAdd = false">
            <v-icon> mdi-close </v-icon>
          </v-btn>
        </v-toolbar>
        <v-divider></v-divider>
        <v-card-text>
          <v-form>
            <v-row>
              <v-col md="6">
                <v-text-field
                  v-model="form.tahunAkademik"
                  label="Tahun Akademik"
                  required
                ></v-text-field>
              </v-col>
              <v-col md="6">
                <v-text-field
                  v-model="form.semester"
                  label="Semester"
                  required
                ></v-text-field>
              </v-col>
              <v-col sm="12" md="12">
                <v-text-field
                  v-model="form.judul"
                  label="Judul"
                  required
                ></v-text-field>
              </v-col>
              <v-col sm="12" md="12">
                <v-autocomplete
                  v-model="searchDosen"
                  :items="Dosen"
                  dense
                  filled
                  item-text="nama"
                  item-value="nama"
                  label="Anggota Penelitian Dosen"
                  @change="onChangeDosenSelect($event)"
                >
                  <template v-slot:selection>
                    <!-- <v-chip
                      v-bind="data.attrs"
                      :input-value="data.item.nama"
                      close
                      @click="data.select"
                      @click:close="remove(data.item, form.anggotaDosen)"
                    >
                      <v-avatar left>
                        <v-img :src="data.item.avatar"></v-img>
                      </v-avatar>
                      {{ data.item }}
                    </v-chip> -->
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content
                        v-text="data.item"
                      ></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title
                          v-html="data.item.nama"
                        ></v-list-item-title>
                        <v-list-item-subtitle
                          v-html="data.item.nidn"
                        ></v-list-item-subtitle>
                        <v-list-item-subtitle
                          v-html="data.item.jabaranFungsional"
                        ></v-list-item-subtitle>
                        <v-list-item-subtitle
                          v-html="data.item.programStudi"
                        ></v-list-item-subtitle>
                        <v-list-item-subtitle
                          v-html="data.item.noHPEmail"
                        ></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col md="12" sm="12">
                <v-expansion-panels>
                  <v-expansion-panel
                    v-for="(item, i) in form.anggotaDosen"
                    :key="i"
                  >
                    <v-expansion-panel-header>
                      <div class="d-flex justify-content-between">
                        {{ item.nama }}
                        <v-spacer></v-spacer>
                        <v-btn
                          width="20px"
                          close
                          @click="removeAnggotaDosen(item, form.anggotaDosen)"
                        >
                          remove
                        </v-btn>
                      </div>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <v-row>
                        <v-col cols="12" v-if="item.nidn">
                          <v-text-field
                            :value="item.nidn"
                            label="NIDN"
                            readonly
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.jabatanFunsional">
                          <v-text-field
                            :value="item.jabatanFunsional"
                            label="Jabatan Fungsional"
                            readonly
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.programStudi">
                          <v-text-field
                            :value="item.programStudi"
                            label="Program Studi"
                            readonly
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.noHPEmail">
                          <v-text-field
                            :value="item.noHPEmail"
                            label="NO HP/Email"
                            readonly
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.falkultas">
                          <v-text-field
                            :value="item.falkultas"
                            label="fakultas"
                            readonly
                          ></v-text-field>
                        </v-col>
                        <v-col cols="12" v-if="item.universitas">
                          <v-text-field
                            :value="item.universitas"
                            label="Universitas"
                            readonly
                          ></v-text-field>
                        </v-col>
                      </v-row>
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-expansion-panels>
              </v-col>
              <v-col md="12" sm="12">
                <v-autocomplete
                  v-model="form.anggotaMahasiswa"
                  :items="DataMahasiswa"
                  dense
                  filled
                  item-text="nama"
                  item-value="nama"
                  label="Anggota Penelitian Mahasiswa "
                  multiple
                >
                  <template v-slot:selection="data">
                    <v-chip
                      v-bind="data.attrs"
                      :input-value="data.item.nama"
                      close
                      @click="data.select"
                      @click:close="remove(data.item, form.anggotaMahasiswa)"
                    >
                      <v-avatar left>
                        <v-img :src="data.item.avatar"></v-img>
                      </v-avatar>
                      {{ data.item.nama }}
                    </v-chip>
                  </template>
                  <template v-slot:item="data">
                    <template v-if="typeof data.item !== 'object'">
                      <v-list-item-content
                        v-text="data.item"
                      ></v-list-item-content>
                    </template>
                    <template v-else>
                      <v-list-item-content>
                        <v-list-item-title
                          v-html="data.item.nama"
                        ></v-list-item-title>
                        <v-list-item-subtitle
                          v-html="data.item.nim"
                        ></v-list-item-subtitle>
                        <v-list-item-subtitle
                          v-html="data.item.prodi"
                        ></v-list-item-subtitle>
                      </v-list-item-content>
                    </template>
                  </template>
                </v-autocomplete>
              </v-col>
              <v-col md="12" cols="12">
                <v-select
                  :items="bidangfokuss"
                  label="Bidang Fokus"
                  v-model="form.bidangFokus"
                ></v-select>
              </v-col>

              <v-col cols="12">
                <v-text-field
                  v-model="form.mitra"
                  label="Mitra"
                  required
                ></v-text-field>
              </v-col>
              <v-row
                class="p-4 d-flex justify-content-between"
                v-for="kriteria in totalKriteria"
                :key="kriteria"
              >
                <v-col cols="3">
                  <v-select
                    v-model="form.sumberDana"
                    :items="sumberdanas"
                    label="Sumber Dana"
                    required
                  >
                  </v-select>
                </v-col>
                <v-col cols="3">
                  <v-select
                    v-model="form.bentukDana"
                    :items="bentukdanas"
                    label="Bentuk Dana"
                    required
                  ></v-select>
                </v-col>
                <v-col cols="3">
                  <v-text-field
                    v-model="form.jumlahDana"
                    label="Jumlah Dana"
                    required
                  ></v-text-field>
                </v-col>
                <v-col cols="1" class="pt-4">
                  <b-button
                    variant="success"
                    class="mt-1"
                    @click="totalKriteria++"
                  >
                    <i class="flaticon-plus"></i></b-button
                ></v-col>
              </v-row>

              <b-col cols="12">
                <v-file-input label="Upload Proposal"></v-file-input>
              </b-col>
            </v-row>
            <b-button
              class="mr-2"
              type="button"
              variant="success"
              @click="showAdd = false"
              >Draft</b-button
            >
            <b-button type="button" variant="primary" @click="onClick()"
              >Submit</b-button
            >
          </v-form>
        </v-card-text>
      </v-card>
    </v-dialog>

    <v-card>
      <CustomCard
        :title="this.$route.params.data.nama"
        :deskripsi="this.$route.params.data.nidn"
        :isDetail="false"
        :isEdit="false"
        :isDelete="false"
        :headers="headers"
        :contentTable="contentTablesPenelitian"
        @addNew="addNew"
        @onProposal="proposal"
        @onKemajuan="Kemajuan"
        @onAkhir="Akhir"
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
        <template v-slot:customAksi="{ item }">
          <v-tooltip left>
            <template v-slot:activator="{ on, attrs }">
              <v-icon
                color="green"
                class="mr-2"
                v-bind="attrs"
                v-on="on"
                @click="btnListItem(item)"
              >
                mdi-format-list-bulleted
              </v-icon>
            </template>
            <span>List Publikasi</span>
          </v-tooltip>
        </template>
      </CustomCard>
    </v-card>
  </div>
</template>
<script>
import { SET_BREADCRUMB } from "@/core/services/store/breadcrumbs.module";
import CustomCard from "@/view/content/CustomCard";
import ListPublikasi from "@/view/content/ListPublikasi/ListPublikasi";

export default {
  name: "DetailEditDataLaporanPenelitian",
  components: {
    CustomCard,
    ListPublikasi,
  },
  data() {
    return {
      formPublikasi: {
        status: "",
        jenisPublkasi: "",
        buku: {
          tahunTerbit: "",
          judul: "",
          halaman: "",
          isbn: "",
          penerbit: "",
        },
        jurnal: {
          tahun: "",
          Jenis: "",
          judul: "",
          nama: "",
          issn: "",
          volume: "",
          nomor: "",
          halaman: "",
          url: "",
        },
        mediamasa: {
          calendar: false,
          tanggalCalendar: "",
          tanggal: "",
          Jenis: "",
          media: "",
          volume: "",
          nomor: "",
          halaman: "",
          url: "",
        },
        forumilmiah: {
          tahun: "",
          tingkat: "",
          namaforum: "",
          makalah: "",
          institusi: "",
          waktu: "",
          tempat: "",
        },
        hki: {
          tahun: "",
          judul: "",
          Jenis: "",
          nomor: "",
        },
      },
      showFormSelect: [],
      showFormBuku: false,
      showFormForumIlmiah: false,
      showFormJurnal: false,
      showFormMediaMassa: false,
      showFormHKI: false,
      dialogPublikasi: false,
      listPublikasi: ["Jurnal", "Buku", "Media Massa", "Forum Ilmiah", "HKI"],
      formBerkas: {
        file: "",
        keterangan: "",
      },
      catatan_penilaian: "",
      dialogUploadBerkas: false,
      titleUploadBerkas: "Laporan Kemajuan",
      totalKriteria: 1,
      searchDosen: "",
      showFormDosenLuar: false,
      formDosenLuar: {
        nama: "",
        nidn: "",
        noHPEmail: "",
        falkultas: "",
        universitas: "",
      },
      form: {
        tahunAkademik: "2020/2021",
        semester: "Genap",
        prodi: "",
        nama: "",
        judul: "",
        bidangFokus: "",
        sumberDana: "",
        jenisPublkasi: "",
        tingkatPublikasi: "",
        anggotaDosen: [],
        anggotaMahasiswa: [],
      },
      DataMahasiswa: [
        {
          avatar: "http://localhost:8080/media/users/100_2.jpg",

          nama: "Yurina Anggela Oktaviana",
          nim: "1701010038",
          prodi: "Sistem Informasi",
        },
        {
          avatar: "http://localhost:8080/media/users/100_2.jpg",

          nama: "Ni Luh Gede Devi Darnita",
          nim: "17010100002",
          prodi: "Sistem Informasi Akuntansis",
        },
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

          nama: "Nur Rohman Ashiddiqi",
          nim: "17010100003",
          prodi: "Teknik Infomatika",
        },
      ],
      Dosen: [
        { nama: "Tambah Dosen Luar" },
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

          nama: "I Putu Satwika, S.Kom, M.Kom",
          nidn: "0801088891",
          jabatanFunsional: "rektor",
          programStudi: "Teknik Informatika",
          noHPEmail: "satwika@primakara.ac.id",
        },
        {
          avatar: "http://localhost:8080/media/users/100_2.jpg",

          nama: "Eka Grana Aristyana Dewi, S.Pd,M.Pd",
          nidn: "0817028803",
          jabatanFunsional: "Tenaga Pengajar",
          programStudi: "Sistem Informasi Akuntansi",
          noHPEmail: "aris@primakara.ac.id",
        },
        {
          avatar: "http://localhost:8080/media/users/100_1.jpg",

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
      bentukdanas: [{ text: "In-Cash", value: null }, "In-Kind"],
      bidangfokuss: [
        { text: "Pilih Bidang Fokus", value: null },
        "Techopreneur",
        "Sistem Informasi",
        "IOT",
      ],
      prodis: [
        { text: "Pilih Prodi", value: null },
        "Teknik Informatika",
        "Sistem Informasi",
        "Sistem Informasi Akuntansi",
      ],
      semesters: [{ text: "Select One", value: null }, "Genap", "Ganjil"],
      showAdd: false,
      confirmasi: false,

      filterTahunAkademik: "",
      dataFilterTahunAkademikSemester: [
        { text: "tidak di filter", value: null },

        "2021/2022-genap",
        "2021/2022-ganjil",
        "2020/2021-genap",
        "2020/2021-ganjil",
        "2019/2020-genap",
        "2019/2020-ganjil",
      ],

      showPublikasi: false,
      datalistPublikasi: [],
      tab: "Proposal",
      itemTabs: ["Penelitian", "Pengabdian"],
      headers: [
        { text: "No", value: "no" },
        { text: "Judul", value: "judul" },
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

        { text: "Proposal", value: "proposal" },
        { text: "Laporan Kemajuan", value: "kemajuan" },
        { text: "Laporan Akhir", value: "akhir" },
        { text: "Publikasi", value: "customAksi" },
      ],
      contentTablesPenelitian: [
        {
          no: "1",
          nidn: "000012341",
          nama: "I Putu Satwika",
          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
          tahun_akademik: "2019/2020-Ganjil",
          proses: "InProgress",
          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          kemajuan: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "empty",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: new File(["example.pdf"], "./berkas/example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
          ],
        },

        {
          no: "2",
          nidn: "000012341",
          nama: "I Putu Satwika",

          judul: "Pelatihan Digitalisasi Koperasi Di Kota Denpasar",
          proses: "InProgress",
          tahun_akademik: "2020/2021-Genap",

          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },

          kemajuan: {
            fileName: null,
            keterangan: "",
            status: "rejected",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: null,
            keterangan: "",
            status: "rejected",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
          ],
        },

        {
          no: "3",
          nidn: "000012341",
          nama: "I Putu Satwika",
          judul: "Pelatihan Penggunaan Sistem Keuangan Dan Anggaran",
          proses: "Selesai",
          tahun_akademik: "2020/2021-Genap",

          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },

          kemajuan: {
            fileName: new File(["example.pdf"], "Laporan Kemajuan.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: new File(["example.pdf"], "Laporan Akhir.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "empty",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },
      ],
      contentTablesPengabdian: [
        {
          no: "1",
          nidn: "000012341",
          nama: "I Putu Satwika",
          judul: "Deteksi Tanaman Herbal Berdasarkan Citra Daun",
          proses: "InProgress",
          tahun_akademik: "2020/2021-Genap",

          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },

          kemajuan: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: new File(["example.pdf"], "./berkas/example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },

        {
          no: "2",
          nidn: "000012341",
          nama: "I Putu Satwika",
          judul: "Pelatihan Digitalisasi Koperasi Di Kota Denpasar",
          proses: "InProgress",
          tahun_akademik: "2019/2020-Genap",

          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },

          kemajuan: {
            fileName: null,
            keterangan: "",
            status: "rejected",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: null,
            keterangan: "",
            status: "rejected",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },

        {
          no: "3",
          nidn: "000012341",
          nama: "I Putu Satwika",
          judul: "Pelatihan Penggunaan Sistem Keuangan Dan Anggaran",
          proses: "Selesai",
          tahun_akademik: "2019/2020-Ganjil",
          proposal: {
            fileName: new File(["example.pdf"], "example.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },

          kemajuan: {
            fileName: new File(["example.pdf"], "Laporan Kemajuan.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          akhir: {
            fileName: new File(["example.pdf"], "Laporan Akhir.pdf", {
              type: "text/pdf",
            }),
            keterangan: "ini hanya contoh file",
            status: "success",
            catatan: "ini catatan 3",
            penilaian: {
              header: [
                { text: "No", value: "no", width: "20px" },
                { text: "Kriteria ", value: "kriteria" },
                {
                  text: "Indikator Penilaian",
                  value: "indikator",
                },
                { text: "Bobot" },
                { text: "Nilai", value: "inputNilai", align: "center" },
              ],

              dataNilai: [
                {
                  no: 1,
                  kriteria: "Latar Belakang",
                  indikators: [
                    {
                      name: "Memuat permasalahan yang terdiri dari penyampaian data dan fakta terkini, motivasi peneliti, dan argumen peneliti, sehingga penelitian ini penting di lakukan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Rumusan Masalah dan Tujuan Penelitian",
                  indikators: [
                    {
                      name: "Logis, fokus, jelas dan terhubung dengan permasalahan yang terdapat pada latar belakang.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Originalitas  dan keluaran Penelitian",
                  indikators: [
                    {
                      name: "Hasil penelitian mempunyai nilai kelayakan untuk dipublikasikan di jurnal ilmiah.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Hasil dan Pembahasan",
                  indikators: [
                    {
                      name: "Hasil dan pembahasan penelitian disajikan secara sistematis untuk menjawab rumusan masalah.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Simpulan dan saran",
                  indikators: [
                    {
                      name: "Simpulan adalah jawaban untuk rumusan masalah dan saran yang disajikan berdasarkan pada hasil penelitian.",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  no: "2",
                  kriteria: "Ketepatan menggunakan metode dan teori",
                  indikators: [
                    {
                      name: "Metode dan teori yang digunakan sesuai dan tepat dengan masalah dan tujuan penelitian.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Penggunaan referensi",
                  indikators: [
                    {
                      name: "Penelitian merujuk pada referensi utama/babon dan jurnal ilmiah terbitan mutakhir",
                      bobot: "10",
                      nilai: 4,
                    },
                  ],
                },
                {
                  kriteria: "Kajian hasil riset sebelumnya yang berkaitan",
                  indikators: [
                    {
                      name: "Dapat menunjukkan keterkaitan penelitian dengan literatur-literatur terdahulu, sehingga ditemukan perbedaan-perbedaan dan kesamaan atau sama sekali tidak ada.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  kriteria: "Bahasa dan Sistematika Laporan",
                  indikators: [
                    {
                      name: "Laporan menggunakan bahasa ilmiah dan sistematika sesuai ketentuan yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
                {
                  no: "3",
                  kriteria: "Pembiayaan dan Pelaksanaan",
                  indikators: [
                    {
                      name: "Penggunaan biaya sesuai aturan yang berlaku dan pelaksanaan penelitian sesuai alokasi waktu yang ditetapkan.",
                      bobot: "10",
                      nilai: 3,
                    },
                  ],
                },
              ],
              catatan_penilaian: "ini catatan test",
            },
          },
          publikasi: [
            {
              jenis: "buku",
              tahunTerbit: "2011",
              judulBuku: "Gerak dan Gerik",
              jumlahHalaman: "205",
              isbn: "12345",
              penerbit: "Tidak di ketahui",
            },
            {
              jenis: "jurnal",
              tahunPublikasi: "2011",
              jenisPublikasi: "Nasional",
              judulPublikasi: "grak gerk",
              namaJurnal: "grak",
              issnJurnal: "1234",
              volume: "20",
              nomor: "30",
              halamanJurnal: "20",
              url: "https://hahhahaha",
            },
            {
              jenis: "forumilmiah",
              tahunPelaksanaan: "2011",
              tingkatForumIlmiah: "Nasional",
              namaForum: "forum 101",
              judulMakalah: "makalah grak",
              institusiPenyelenggara: "stmik",
              waktuPelaksanaan: "2020",
              tempatPelaksanaan: "Internasional",
            },
            {
              jenis: "hki",
              tahunPelaksanaan: "2011",
              judulHki: "unik",
              jenisHki: "pengetahuan",
              nomorHki: "1234",
              status: "aprove",
              nomorPendaftaran: "1",
            },
            {
              jenis: "mediamassa",
              tanggalPublikasi: "2011",
              judulPublikasi: "penelitian blah blah blah",
              namaMedia: "suarablahblah ",
              url: "https://suarablahblah",
            },
          ],
        },
      ],
    };
  },
  methods: {
    btnListItem(item) {
      this.showPublikasi = true;
      this.datalistPublikasi = item.publikasi ? item.publikasi : [];
    },
    addNew(value) {
      this.showAdd = value;
    },
    onClick() {
      this.confirmasi = true;
    },

    onChangeDosenSelect(e) {
      console.log(this.searchDosen);
      if (this.searchDosen.toLowerCase() == "tambah dosen luar") {
        this.showFormDosenLuar = true;
      } else {
        let data = this.Dosen.find((e) => {
          return e.nama.toLowerCase() == this.searchDosen.toLowerCase();
        });
        this.form.anggotaDosen.push(data);
      }
    },
    addAnggotaDosenLuar() {
      this.form.anggotaDosen.push(this.formDosenLuar);
      this.showFormDosenLuar = false;
    },
    removeAnggotaDosen(item, data) {
      const index = data.indexOf(item);
      if (index >= 0) data.splice(index, 1);
    },

    remove(item, data) {
      const index = data.indexOf(item.nama);
      if (index >= 0) data.splice(index, 1);
    },
    proposal(proposal) {
      this.showAdd = true;
      if (proposal.status == "empty") {
        return;
      }
      console.log(proposal);
      this.form.tahunAkademik = proposal.tahunAkademik;
      this.form.semester = proposal.semester;
      this.form.prodi = proposal.prodi;
      this.form.nama = this.$route.params.data.nama;
      this.form.judul = proposal.judul;
      this.form.bidangFokus = proposal.bidangFokus;
      this.form.sumberDana = proposal.jenisPublikasi;
      this.form.jenisPublkasi = proposal.jenisPublikasi;
      this.form.tingkatPublikasi = proposal.tingkatPublikasi;
      this.form.anggotaDosen = proposal.anggotaDosen;
      this.form.anggotaMahasiswa = proposal.form.anggotaDosen;
    },
    Kemajuan(kemajuan) {
      if (kemajuan.status == "empty") {
        this.titleUploadBerkas = "Laporan Kemajuan";
        this.dialogUploadBerkas = true;

        return;
      }
      this.formBerkas.file = kemajuan.fileName;
      this.formBerkas.keterangan = kemajuan.keterangan;
      this.formBerkas.status = kemajuan.status;
      this.formBerkas.penilaian = kemajuan.penilaian;
      this.titleUploadBerkas = "Laporan Kemajuan";
      this.dialogUploadBerkas = true;
      this.catatan_penilaian = kemajuan.penilaian.catatan_penilaian;
    },
    Akhir(akhir) {
      if (akhir.status == "empty") {
        this.titleUploadBerkas = "Laporan Kemajuan";
        this.dialogUploadBerkas = true;

        return;
      }

      this.formBerkas.file = akhir.fileName;
      this.formBerkas.keterangan = akhir.keterangan;
      this.formBerkas.status = akhir.status;
      this.formBerkas.penilaian = akhir.penilaian;

      this.titleUploadBerkas = "Laporan Akhir";
      this.dialogUploadBerkas = true;
      this.catatan_penilaian = akhir.penilaian.catatan_penilaian;
    },
    Publikasi(publikasi) {
      this.dialogPublikasi = true;
    },
    checkDisable(status) {
      if (status == "rejected" || status == "aprove" || status == "success") {
        console.log(status);
        return true;
      }
      return false;
    },

    onJenisPublikasi(value) {
      this.showFormSelect.forEach((value) => {
        value.status = false;
      });
      const index = this.showFormSelect.findIndex(
        (select) => select.name == value
      );

      this.showFormSelect[index].status = true;
    },
    onCheckSelectFormStatus(nameStatus) {
      let data = this.showFormSelect.find((s) => {
        return s.name === nameStatus;
      });
      return data ? data.status : false;
    },

    formatDate(date) {
      if (!date) return null;

      const [year, month, day] = date.split("-");
      return `${month}/${day}/${year}`;
    },
    parseDate(date) {
      if (!date) return null;

      const [month, day, year] = date.split("/");
      return `${year}-${month.padStart(2, "0")}-${day.padStart(2, "0")}`;
    },
    getTotalValue(dataNilai) {
      let total = 0;
      dataNilai.forEach((value) => {
        let total_indikators = 0;
        console.log(value);
        if (!value.indikators) return;
        value.indikators.forEach((val) => {
          total_indikators += Number(val.nilai);
        });
        total += total_indikators;
      });
      return total;
    },
  },
  mounted() {},
};
</script>