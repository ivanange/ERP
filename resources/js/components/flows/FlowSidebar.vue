<template>
  <div class="d-flex flex-column position-sticky">
    <form class="filter-form bg-light py-4 px-3">
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
        <b-button variant="light" class="ml-3" v-b-toggle.filters>Filters</b-button>
        <font-awesome-icon
          class="ml-auto mr-3"
          size="2x"
          icon="plus-circle"
          style="color: var(--dark); cursor:pointer;"
          @click.stop="$router.push('/accounting/flows/create')"
        />
      </div>
      <b-collapse id="filters">
        <div class="d-flex justify-content-center align-concent-center mt-3">
          <div class="pl-0 mr-3" style="min-width: 300px;">
            <h4 class="w-100 mb-3">Type</h4>
            <b-form-checkbox-group
              id="typees"
              class="border-left px-2 py-3"
              v-model="filters.type"
              :options="options"
              name="typees"
              stacked
            ></b-form-checkbox-group>
          </div>
        </div>
      </b-collapse>
    </form>
  </div>
</template>

<script>
import { debounce } from "lodash";
export default {
  name: "FlowSidebar",
  props: ["categoryid"],
  data: function() {
    return {
      filters: {
        name: "",
        manufacturer: null,
        category: this.categoryid,
        type: []
      },
      result: []
    };
  },
  computed: {
    options: function() {
      return [
        {
          value: "in",
          text: "Cash in"
        },
        {
          value: "out",
          text: "Cash out"
        }
      ];
    }
  },

  watch: {
    filters: {
      handler: function() {
        this.update();
      },
      deep: true,
      immediate: true
    },
    categoryid: function() {
      this.filters.category = this.categoryid;
    }
  },

  methods: {
    update: debounce(function() {
      let result = this.search();
      this.$store.commit("setList", result);
    }, 1500),
    search() {
      let searchList =
        !this.filters.type.length || this.filters.type.length == 2
          ? this.flowList
          : this.flowList.filter(e =>
              []
                .concat(...this.filters.type.map(el => this[el + "Flows"]))
                .find(a => a.id == e.id)
            );

      return searchList.filter(flow =>
        this.filters.name
          ? flow.name &&
            flow.name.toLowerCase().indexOf(this.filters.name.toLowerCase()) !==
              -1
          : true
      );
    }
  },
  created: function() {
    this.$store.watch(
      (state, getters) => getters.flowList,
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
