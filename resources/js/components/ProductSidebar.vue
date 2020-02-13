<template>
  <div class="d-flex flex-column">
    <form action="#searchList.php" method="post" class="filter-form bg-light py-4 px-3">
      <div class="d-flex justify-content-start align-concent-center px-2">
        <input
          v-model="filters.name"
          class="form-control rounded ml-5"
          type="search"
          placeholder="command name, articles"
          style="max-width: 600px;"
        />
        <b-button variant="light" class="ml-3" v-b-toggle.filters>Filters</b-button>
        <font-awesome-icon
          class="ml-auto mr-3 h2"
          icon="plus-circle"
          style="color: var(--info); cursor:pointer;"
          @click.stop="$router.push('/products/create')"
        />
      </div>
      <b-collapse id="filters">
        <div class="d-flex justify-content-center align-concent-center mt-3">
          <div class="pl-0 mr-3" style="min-width: 300px;">
            <h4 class="w-100 mb-3">Status</h4>
            <b-form-checkbox-group
              id="statuses"
              class="border-left px-2 py-3"
              v-model="filters.status"
              :options="options"
              name="statuses"
              stacked
            ></b-form-checkbox-group>
          </div>
          <div class="d-flex flex-column pl-0 ml-3" style="min-width: 300px;">
            <h4 class="w-100 text-center">Custom</h4>
            <b-form-group label="Manufacturers">
              <v-select
                v-model="filters.manufacturer"
                :options="manufacturers"
                placeholder="Manufacturer"
                class="custom"
              ></v-select>
            </b-form-group>

            <b-form-group label="Categories">
              <v-select
                v-model="filters.category"
                :options="categoryList.map(el => ({ label:el.name, value: el.id}))"
                :reduce="el => el.value"
                placeholder="Category"
                class="custom"
              ></v-select>
            </b-form-group>
          </div>
        </div>
      </b-collapse>
    </form>
  </div>
</template>

<script>
import { debounce } from "lodash";
export default {
  name: "ProductSidebar",
  props: ["categoryid"],
  data: function() {
    return {
      filters: {
        name: "",
        manufacturer: null,
        category: this.categoryid,
        status: []
      },
      result: []
    };
  },
  computed: {
    options: function() {
      return [
        {
          value: "expired",
          text: "Expired"
        },
        {
          value: "nearlyExpired",
          text: "Nearly expired"
        },
        {
          value: "good",
          text: "Good"
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
        !this.filters.status.length || this.filters.status.length == 3
          ? this.productList
          : [].concat(...this.filters.status.map(el => this[el + "Products"]));

      return searchList.filter(
        product =>
          (this.filters.name
            ? product.name &&
              product.name
                .toLowerCase()
                .indexOf(this.filters.name.toLowerCase()) !== -1
            : true) &&
          (this.filters.manufacturer
            ? product.manufacturer &&
              product.manufacturer
                .toLowerCase()
                .indexOf(this.filters.manufacturer.toLowerCase()) !== -1
            : true) &&
          (this.filters.category
            ? product.category && product.category.id == this.filters.category
            : true)
      );
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
