<template>
  <div class="card card-custom card-stretch gutter-b">
    <template v-if="title">
      <div class="card-header">
        <div
          class="
            d-flex
            flex-column
            align-items-start
            card-title
            font-weight-bolder
          "
        >
          <h3 class="text-dark text-left">{{ title }}</h3>
          <h5 class="text-dark" v-if="deskripsi">{{ deskripsi }}</h5>
        </div>
        <div class="card-toolbar" v-if="isTopAction">
          <button class="btn btn-success" @click="changed(true)">
            <i class="menu-icon flaticon2-add-1"></i> Tambah {{ isTopAction }}
          </button>
        </div>
      </div>
    </template>
    <div class="card-body">
      <v-text-field
        v-model="search"
        append-icon="search"
        label="Search"
        single-line
        hide-details
      ></v-text-field>
      <v-data-table :headers="headers" :items="contentTable" :search="search">
        <template v-slot:[`item.aksi`]="{ item }">
          <div class="btn-group" v-if="isEdit || isDelete">
            <a class="btn btn-sm btn-primary" @click="editItem(item)">
              <i class="menu-icon flaticon-edit"></i
            ></a>
            <a class="btn btn-sm btn-danger" @click="deleteItem(item)">
              <i class="menu-icon flaticon-delete"></i>
            </a>
          </div>
          <slot name="aksi"></slot>
        </template>
      </v-data-table>
    </div>
  </div>
</template>
<script>
export default {
  name: "CustomCard",
  props: {
    title: String,
    deskripsi: String,
    headers: Array,
    contentTable: Array,
    isTopAction: {
      type: Boolean,
      default: true,
    },
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
    changed(value) {
      this.$emit("addNew", value);
    },
  },
};
</script>