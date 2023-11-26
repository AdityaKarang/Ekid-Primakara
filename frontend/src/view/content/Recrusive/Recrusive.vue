<template>
  <tr>
    <td v-if="label">
      <h5 :class="checkIsSpace">{{ label }}</h5>
    </td>
    <td v-if="value">
      <h5>: {{ value }}</h5>
    </td>
  </tr>
</template>
<script>
export default {
  name: "Child",
  props: {
    label: String,
    value: String,
    isSpace: { type: Boolean, default: false },
  },
  computed: {
    checkIsSpace() {
      return this.isSpace ? "pl-2" : "";
    },
  },
};
</script>