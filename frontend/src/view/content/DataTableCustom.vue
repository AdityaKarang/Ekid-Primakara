<template>
  <v-card>
    <v-card-title>
      {{ title }}
      <v-spacer></v-spacer>
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
    </v-card-title>
    <v-data-table :headers="headers" :items="contentTable" :search="search">
      <template v-slot:[`item.aksi`]="{ item }">
        <div v-if="isEdit || isDelete">
          <b-button
            variant="success"
            class="ml-1"
            size="sm"
            @click="editItem(item)"
            >Edit</b-button
          >
          <b-button
            variant="danger"
            class="ml-1"
            size="sm"
            @click="deleteItem(item)"
            >Hapus</b-button
          >
          <b-button
            variant="primary"
            class="ml-1"
            size="sm"
            @click="detailItem(item)"
            >Detail</b-button
          >
          <!-- <a class="btn btn-sm btn-warning p-auto" @click="editItem(item)">
            <i class="menu-icon flaticon-edit"></i
          ></a>
          <a class="btn btn-sm btn-danger p-auto" @click="deleteItem(item)">
            <i class="menu-icon flaticon-delete"></i>
          </a> -->
        </div>
        <slot name="aksi"></slot>
      </template>
    </v-data-table>
  </v-card>
</template>
<script>
export default {
  name: "DataTable",
  props: {
    title: String,
    headers: Array,
    contentTable: Array,
    isEdit: {
      type: Boolean,
      default: true,
    },
    isDelete: {
      type: Boolean,
      default: true,
    },
  },
  data() {
    return {
      search: "",
    };
  },
  methods: {
    editItem(item) {
      this.$emit("editData", item);
    },
    deleteItem(item) {
      this.$emit("deleteData", item);
    },
    detailItem(item) {
      this.$emit("detailData", item);
    },
  },
};
</script>