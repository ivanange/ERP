<template>
  <div class="d-flex justify-content-center align-items-center h-100">
    <router-link
      :to="'/categories'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary="
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Categories</span>
    </router-link>
    <router-link
      :to="'/commands'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Commands</span>
    </router-link>
    <router-link
      :to="'/products'"
      class="d-flex bg-light text-center m-3 font-weight-light align-items-center justify-content-center text-decoration-none text-secondary"
      style="width: 300px; height: 300px;"
    >
      <span class="diplay-3 text-decoration-none text-secondary">Products</span>
    </router-link>
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
