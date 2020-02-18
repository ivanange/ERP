<template>
  <div class="d-flex bg-light flex-wrap m-3 font-weight-light text-secondary w-100 py-3">
    <h4
      class="text-decoration-none text-secondary d-block font-weight-bold w-100 mb-3 text-center"
    >Total sold : {{stats.total}}</h4>

    <span class="font-weight-bold w-100 text-center mb-3 diplay-2">Quantity per product</span>
    <span
      class="diplay-2 text-decoration-none text-secondary d-block my-2"
      style="width: 300px;"
      v-for="name in Object.keys(stats.perProductTotal)"
      :key="name"
    >{{name}} : {{stats.perProductTotal[name]}}</span>
  </div>
</template>

<script>
export default {
  name: "StockStats",
  title: "Stats",
  data() {
    return {};
  },
  computed: {
    products() {
      return Object.values(this.$store.state.products).reduce((obj, el) => {
        obj[el.id] = el.name;
        return obj;
      });
    },
    stats() {
      let stats = {
        perProductTotal: {},
        total: 0
      };
      Object.values(this.$store.state.commands).forEach(command => {
        Object.keys(command.articles).forEach(pid => {
          let qte = command.articles[pid].qte;
          stats.perProductTotal[this.products[pid]] =
            (stats.perProductTotal[this.products[pid]] || 0) + qte;
          stats.total += qte;
        });
      });
      return stats;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
