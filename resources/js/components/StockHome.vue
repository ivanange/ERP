<template>
  <div class="d-flex justify-content-center align-items-center h-100">
    <router-link
      :to="'/stock/categories'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary="
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Categories</span>
    </router-link>
    <router-link
      :to="'/stock/commands'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Commands</span>
    </router-link>
    <router-link
      :to="'/stock/products'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Products</span>
    </router-link>
    <router-link
      :to="'stock/stats'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Stats</span>
    </router-link>
  </div>
</template>

<script>
export default {
  name: "StockHome",
  title: "Stock"
};
</script>

<style lang="scss" scoped>
</style>
