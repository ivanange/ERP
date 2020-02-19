
<template>
  <div>
    <FlowCategoryList :proplist="searchResult" ref="flowcategory" />
    <router-view></router-view>
  </div>
</template>

<script>
import FlowCategoryList from "./FlowCategoryList";

export default {
  name: "FlowCategory",
  title: "Flow Categories",
  components: {
    FlowCategoryList
  },
  data: function() {
    return {
      show: false
    };
  },

  mounted: function() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  }
};
</script>

<style lang="scss" scoped>
</style>
