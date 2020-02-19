<template>
  <div class="d-flex bg-light flex-wrap m-3 font-weight-light text-secondary w-100 py-3">
    <div class="in w-50">
      <h2>Cash In</h2>
      <div class="d-flex flex-column">
        <span
          v-for="name in Object.keys(stats.in)"
          :key="name"
          class="lead my-3"
        >{{name}} : {{stats.in[name].toFixed(2)}} {{currency}}</span>
      </div>
    </div>
    <div class="out w-50">
      <h2>Cash Out</h2>
      <div class="d-flex flex-column">
        <span
          v-for="name in Object.keys(stats.out)"
          :key="name"
          class="lead my-3"
        >{{name}} : {{stats.out[name].toFixed(2)}} {{currency}}</span>
      </div>
    </div>
    <h2 class="display-4 text-center w-100">Benefit : {{stats.benefit.toFixed(2)}} {{currency}}</h2>
  </div>
</template>

<script>
export default {
  name: "AccountingStats",
  title: "Stats",
  data() {
    return {};
  },
  computed: {
    totalSales() {
      return Object.values(this.$store.state.commands).reduce(
        (total, el) => (total += el.total),
        0
      );
    },
    stats() {
      let stats = {
        in: {
          Total: 0,
          Sales: this.totalSales
        },
        out: {
          Total: 0,
          Salaries: this.totalSalary
        },
        benefit: 0
      };
      Object.values(this.$store.state.flows).forEach(flow => {
        let totalDue = flow.dues.reduce(
          (total, due) => (total += parseFloat(due.amount)),
          0
        );
        let cat = flow.type == 1 ? "in" : "out";
        stats[cat][flow.name] = (stats[cat][flow.name] || 0) + totalDue;
        stats[cat].Total += totalDue;
      });
      stats.benefits = stats.in.Total - stats.out.Total;
      return stats;
    }
  },

  created: function() {
    this.getTotalSalary();
  },
  updated() {
    this.getTotalSalary();
  }
};
</script>

<style lang="scss" scoped>
</style>
