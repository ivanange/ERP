
<template>
  <div>
    <CategoryList :proplist="searchResult" ref="category" />
    <router-view></router-view>
  </div>
</template>

<script>
import CategoryList from "./CategoryList";

export default {
  name: "Category",
  title: "Categories",
  components: {
    CategoryList
  },
  data: function() {
    return {
      show: false
    };
  },

  mounted: function() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  }
};
</script>

<style lang="scss" scoped>
</style>
