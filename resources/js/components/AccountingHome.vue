<template>
  <div class="d-flex justify-content-center align-items-center h-100">
    <router-link
      :to="'/accounting/flows'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary="
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Flows</span>
    </router-link>
    <router-link
      :to="'/accounting/flowcategories'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Flow Categories</span>
    </router-link>
    <router-link
      :to="'/accounting/stats'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Stats & Financial resume</span>
    </router-link>

  </div>
</template>

<script>
export default {
  name: "AccountingHome",
  title: "Accounting"
};
</script>

<style lang="scss" scoped>
</style>
