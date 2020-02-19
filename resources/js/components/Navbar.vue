<template>
  <div>
    <b-navbar type="dark" variant="dark" sticky>
      <b-navbar-brand :to="'/home'" class="mr-5 pr-5">ERP</b-navbar-brand>
      <b-navbar-nav class="mx-5 pr-5"></b-navbar-nav>
      <b-navbar-nav class="ml-5 pl-5">
        <b-nav-item :to="'/home'">Home</b-nav-item>
        <b-nav-item :to="'/stock/'">Categories</b-nav-item>
        <b-nav-item :to="'/accounting'">Acounting</b-nav-item>
        <b-nav-item :href="'/payroll'">Payroll</b-nav-item>
      </b-navbar-nav>
      <font-awesome-icon
        class="ml-auto mr-3 text-white"
        icon="sign-out-alt"
        size="lg"
        style="cursor:pointer; "
        title="logout"
        v-if="this.logged"
        @click.stop="logout"
      />
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
