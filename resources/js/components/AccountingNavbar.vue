<template>
  <div>
    <b-navbar type="light" sticky>
      <b-navbar-brand :to="'/accounting'" class="mr-5 pr-5">Accounting</b-navbar-brand>
      <b-navbar-nav class="mx-5 pr-5"></b-navbar-nav>
      <b-navbar-nav class="ml-5 pl-5">
        <b-nav-item :to="'/accounting'">Home</b-nav-item>
        <b-nav-item :to="'/accounting/flows'">Flows</b-nav-item>
        <b-nav-item-dropdown
          text="Flow Categories"
          v-if="categoryList.length"
          class="custom-scroll"
        >
          <b-dropdown-item :to="'/accounting/flowcategories'">All</b-dropdown-item>
          <b-dropdown-item
            v-for="category in flowcategoryList"
            :to="{path: 'products', query:{ category: category.id} }"
            :key="category.id"
          >{{category.name}}</b-dropdown-item>
        </b-nav-item-dropdown>
        <b-nav-item :to="'/accounting/flowcategories'" v-else>Flow Categories</b-nav-item>

        <b-nav-item :to="'/accounting/stats'">Stats</b-nav-item>
      </b-navbar-nav>
    </b-navbar>
  </div>
</template>

<script>
export default {
  //style="max-height: 40vh;" class="custom-scroll overflow-auto"
  name: "AccountingNavbar"
};
</script>

<style lang="scss" scoped>
</style>
