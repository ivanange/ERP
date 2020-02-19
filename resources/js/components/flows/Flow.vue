
<template>
  <div>
    <FlowList :proplist="searchResult" />
    <router-view></router-view>

  </div>
</template>

<script>
import FlowList from "./FlowList";

export default {
  name: "Flow",
  title: "Flows",
  components: {
    FlowList
  },
  data: function() {
    return {
      show: false
    };
  },
  beforeRouteUpdate(to, from, next) {
    if (this.$route.query.category) {
      this.$root.categoryid = this.$route.query.category;
    }
    next();
  },
  created() {
    if (this.$route.query.category) {
      this.$root.categoryid = this.$route.query.category;
    }
  },
  mounted() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  }
};
</script>

<style lang="scss" scoped>
</style>
