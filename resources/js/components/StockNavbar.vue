<template>
  <div>
    <b-navbar type="light" sticky>
      <b-navbar-brand :to="'/stock'" class="mr-5 pr-5">Stock</b-navbar-brand>
      <b-navbar-nav class="mx-5 pr-5"></b-navbar-nav>
      <b-navbar-nav class="ml-5 pl-5">
        <b-nav-item :to="'/stock'">Home</b-nav-item>
        <b-nav-item :to="'/stock/categories'">Categories</b-nav-item>
        <b-nav-item :to="'/stock/commands'">Commands</b-nav-item>
        <b-nav-item-dropdown text="Products" v-if="categoryList.length">
          <b-dropdown-item :to="'/stock/products'">All</b-dropdown-item>
          <b-dropdown-item
            v-for="category in categoryList"
            :to="{path: 'products', query:{ category: category.id} }"
            :key="category.id"
          >{{category.name}}</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item :to="'/stock/products'" v-else>Products</b-nav-item>
        <b-nav-item :to="'/stock/stats'">Stats</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>
export default {
  //style="max-height: 40vh;" class="custom-scroll overflow-auto"
  name: "StockNavbar"
};
</script>

<style lang="scss" scoped>
</style>
