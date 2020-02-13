<template>
  <div class="custom-scroll overflow-auto" style="max-height: 100%;">
    <b-card-group
      columns
      v-if="this.categoriesList.length"
      class="p-3 custom-scroll ovarflow-auto"
      style="max-height: 100%;"
    >
      <CategoryItem
        v-for="category in this.categoriesList"
        :category="category"
        target="confirmDelete"
        :key="category.id"
        @confirm="confirm"
        style=" max-height:300px; width: 400px; overflow:hidden;"
        textstyle="max-height:100px; overflow:hidden;"
        class="my-3"
      />
    </b-card-group>
    <span class="text-light font-weight-bold display-5 d-block my-5" v-else>Nothing</span>
    <b-modal
      id="confirmDelete"
      busy
      hide-footer
      hide-backdrop
      title="Delete Category"
      @ok="destroy()"
      class="border-0 border-light shadow-sm"
    >
      <template v-slot:default="{ ok, cancel}">
        <p class="lead mt-2 mb-3">The category will be permenetly deleted.</p>
        <div class="ml-auto w-100 d-flex justify-content-end">
          <b-button variant="danger" class="mr-2" style="min-width:70px;" @click.stop="ok()">OK</b-button>
          <b-button variant="outline-none" class="text-danger" @click.stop="cancel()">Cancel</b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import CategoryItem from "./CategoryItem";
export default {
  name: "CategoryList",
  components: {
    CategoryItem
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
    categoriesList: function() {
      return this.proplist || this.categoryList;
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
      this.destroyCategory(this.id);
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
