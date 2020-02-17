
<template>
  <div>
    <CommandList :proplist="searchResult" />
    <router-view></router-view>

  </div>
</template>

<script>
import CommandList from "./CommandList";

export default {
  name: "Command",
  title: "Commands",
  components: {
    CommandList
  },
  data: function() {
    return {
      show: false
    };
  },

  mounted: function() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  },
  updated() {
    this.show = this.$el.clientHeight > 1.5 * window.innerHeight;
  }
};
</script>

<style lang="scss" scoped>
</style>
