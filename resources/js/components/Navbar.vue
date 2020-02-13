<template>
  <div>
    <b-navbar type="dark" variant="info" sticky>
      <b-navbar-brand :to="'/home'" class="mr-5 pr-5">Pharma</b-navbar-brand>
      <b-navbar-nav class="mx-5 pr-5"></b-navbar-nav>
      <b-navbar-nav class="ml-5 pl-5">
        <b-nav-item :to="'/home'">Home</b-nav-item>
        <b-nav-item :to="'/categories'">Categories</b-nav-item>
        <b-nav-item :to="'/commands'">Commands</b-nav-item>
        <b-nav-item-dropdown text="Products" v-if="categoryList.length">
          <b-dropdown-item :to="'/products'">All</b-dropdown-item>
          <b-dropdown-item
            v-for="category in categoryList"
            :to="{path: 'products', query:{ category: category.id} }"
            :key="category.id"
          >{{category.name}}</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item :to="'/products'" v-else>Products</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>
export default {
  //style="max-height: 40vh;" class="custom-scroll overflow-auto"
  name: "Navbar"
};
</script>

<style lang="scss" scoped>
</style>
