<template>
  <div class="d-flex flex-column h-100 w-100">
    <AccountingNavbar />
    <router-view name="sideBar" :list="$root.searchResult" :categoryid="$root.categoryid"></router-view>
    <router-view></router-view>
  </div>
</template>

<script>
import AccountingNavbar from "./AccountingNavbar";
export default {
  name: "AccountingStats",
  title: "Accounting",
  components: {
    AccountingNavbar
  }
};
</script>

<style lang="scss" scoped>
</style>
