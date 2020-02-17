<template>
  <div class="d-flex flex-column h-100 w-100">
    <StockNavbar />
    <router-view name="sideBar" :list="$root.searchResult" :categoryid="$root.categoryid"></router-view>
    <router-view></router-view>
  </div>
</template>

<script>
import StockNavbar from "./StockNavbar";
export default {
  name: "StockStats",
  title: "Stats",
  components: {
    StockNavbar
  }
};
</script>

<style lang="scss" scoped>
</style>
