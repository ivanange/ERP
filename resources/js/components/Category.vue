
<template>
  <div>
    <CategoryList :proplist="searchResult" ref="category" />
    <router-view></router-view>
    <font-awesome-icon
      icon="chevron-up"
      class="p-3 text-dark position-fixed"
      style="bottom: 50px; left: 50px; border-radius: 50%;"
      @click.stop="scrollToTop()"
      size="lg"
      v-if="show"
    ></font-awesome-icon>
  </div>
</template>

<script>
import CategoryList from "./categories/CategoryList";

export default {
  name: "Category",
  title: "Categories",
  components: {
    CategoryList
  },
  data: function() {
    return {
        show: false,
    };
  },

  mounted: function() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  },

};
</script>

<style lang="scss" scoped>
</style>
