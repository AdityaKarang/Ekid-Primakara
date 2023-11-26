<template>
  <table>
    <tbody>
      <Recrusive
        v-for="(list, i) in convertArray(listData)"
        :key="i"
        :label="list.label"
        :value="list.value"
        :isSpace="list.isSpace"
        :children="list.children"
      ></Recrusive>
    </tbody>
  </table>
</template>
<script>
import Recrusive from "@/view/content/Recrusive/Recrusive.vue";
export default {
  name: "StaticView",
  components: {
    Recrusive,
  },
  props: {
    listData: Array,
  },
  data() {
    return {
      exampleData: [
        {
          label: "example 1",
          value: "value 1",
        },
        {
          label: "example 2",
          value: "value 2",
          children: [
            {
              label: "chid example 2 ",
              value: "chid value 2",
              children: [
                {
                  label: "chid ex 2 2 ",
                  value: "chid ex 2 2",
                },
              ],
            },
          ],
        },
        {
          label: "example 3",
          value: "value 3",
          children: [
            {
              label: "chid example 3 ",
              value: "chid value 3",
            },
          ],
        },
      ],
    };
  },

  methods: {
    convertArray(array) {
      let newArry = [];
      if (!array) return [];
      array.forEach((element) => {
        newArry.push(element);
        console.log("elemen conver", element);
        if (element.children) {
          this.pushingArray(newArry, element.children);
        }
      });
      return newArry;
    },
    pushingArray(newArray, array) {
      array.forEach((element) => {
        newArray.push(element);
        console.log("elemetn push", element.children);
        if (element.children) {
          this.pushingArray(newArray, element.children);
        }
      });
    },
  },
  mounted() {
    console.log(this.listData);
  },
};
</script>