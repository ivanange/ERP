<template>
  <div class="custom-scroll overflow-auto" style="max-height: 100%;">
    <b-card-group
      columns
      v-if="this.productsList.length"
      class="p-3 custom-scroll ovarflow-auto"
      style="max-height: 100%;"
    >
      <ProductItem
        v-for="product in this.productsList"
        articleStyle="max-height: 280px; overflow: auto;"
        :product="product"
        target="confirmDelete"
        :key="product.id"
        @confirm="confirm"
        style=" max-height:600px; width: 400px;"
        class="my-3"
      />
    </b-card-group>
    <span class="text-light font-weight-bold display-5 d-block my-5" v-else>Nothing</span>
    <b-modal
      id="confirmDelete"
      busy
      hide-footer
      hide-backdrop
      title="Delete Product"
      @ok="destroy()"
      class="border-0 border-light shadow-sm"
    >
      <template v-slot:default="{ ok, cancel}">
        <p class="lead mt-2 mb-3">The product will be permenently deleted.</p>
        <div class="ml-auto w-100 d-flex justify-content-end">
          <b-button variant="danger" class="mr-2" style="min-width:70px;" @click.stop="ok()">OK</b-button>
          <b-button variant="outline-none" class="text-danger" @click.stop="cancel()">Cancel</b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import ProductItem from "./ProductItem";
export default {
  name: "ProductList",
  components: {
    ProductItem
  },
  props: {
    proplist: {
      type: Array,
      default: () => null,
      required: false
    }
  },
  data: function() {
    return {
      id: null
    };
  },
  computed: {
    productsList: function() {
      return this.proplist || this.productList;
    }
  },
  watch: {
    proplist: {
      handler: function() {
        this.$forceUpdate();
      },
      deep: true,
      immediate: true
    }
  },
  methods: {
    destroy: function() {
      this.destroyProduct(this.id);
    },
    confirm($event) {
      this.id = $event;
      this.$bvModal.show("confirmDelete");
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
