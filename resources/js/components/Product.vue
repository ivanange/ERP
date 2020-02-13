
<template>
  <div>
    <ProductList :proplist="searchResult" />
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
import ProductList from "./products/ProductList";

export default {
  name: "Product",
  title: "Products",
  components: {
    ProductList
  },
  data: function() {
    return {
      show: false
    };
  },
  beforeRouteUpdate(to, from, next) {
    if (this.$route.query.category) {
      this.$root.categoryid = this.$route.query.category;
    }
    next();
  },
  created() {
    if (this.$route.query.category) {
      this.$root.categoryid = this.$route.query.category;
    }
  },
  mounted() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  }
};
</script>

<style lang="scss" scoped>
</style>
