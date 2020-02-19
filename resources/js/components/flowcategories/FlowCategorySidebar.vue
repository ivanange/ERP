<template>
  <div class="d-flex flex-column position-sticky">
    <form action="#searchList.php" method="post" class="filter-form bg-light py-4 px-3">
      <div class="d-flex justify-content-start align-concent-center px-2">
        <div class="items mt-1 p-0">
          <font-awesome-icon
            :icon="['fas', 'long-arrow-alt-up']"
            style="color: var(--dark); cursor:pointer;"
            class="mb-0 mx-2"
            size="lg"
            title="back to top"
            @click="scrollToTop"
          />
          <font-awesome-icon
            :icon="this.listview ? ['fas', 'th-large'] : ['fas', 'th-list'] "
            style="color: var(--dark); cursor:pointer;"
            class="mb-0 mx-2"
            size="lg"
            :title="'change to ' + (this.listview ? 'gallery' : 'list') + ' view'"
            @click.prevent.stop="toggleView"
          />
        </div>
        <input
          v-model="filters.name"
          class="form-control rounded ml-5"
          type="search"
          placeholder="command name, articles"
          style="max-width: 600px;"
        />
        <font-awesome-icon
          class="ml-auto mr-3 h2"
          icon="plus-circle"
          style="color: var(--dark); cursor:pointer;"
          @click.stop="$router.push('/stock/flowcategories/create')"
        />
      </div>
    </form>
  </div>
</template>

<script>
import { debounce } from "lodash";
export default {
  name: "FlowCategorySidebar",
  data: function() {
    return {
      filters: {
        name: ""
      },
      result: []
    };
  },
  watch: {
    filters: {
      handler: function() {
        this.update();
      },
      deep: true,
      immediate: true
    }
  },

  methods: {
    update: debounce(function() {
      let result = this.search();
      this.$store.commit("setList", result);
    }, 1500),

    search() {
      return this.flowcategoryList.filter(
        category =>
          (category.name + category.desc)
            .toLowerCase()
            .indexOf(this.filters.name.toLowerCase()) !== -1
      );
    }
  },
  created: function() {
    this.$store.watch(
      (state, getters) => getters.flowcategoryList,
      () => {
        this.update();
      },
      {
        immediate: true,
        deep: true
      }
    );
  }
};
</script>

<style lang="scss" scoped>
</style>
