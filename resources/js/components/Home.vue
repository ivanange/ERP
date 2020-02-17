<template>
  <div class="d-flex justify-content-center align-items-center h-100">
    <router-link
      :to="'/stock'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary="
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Stock</span>
    </router-link>
    <a
      :href="'/accounting'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Accounting</span>
    </a>
    <a
      :href="'/payroll'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Payroll</span>
    </a>
  </div>
</template>

<script>
export default {
  name: "Home",
  title: "Home"
};
</script>

<style lang="scss" scoped>
</style>
