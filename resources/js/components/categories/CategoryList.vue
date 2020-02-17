<template>
  <div class="custom-scroll overflow-auto" style="max-height: 100%;">
    <b-list-group v-if="this.categoriesList.length && this.listview">
      <b-list-group-item class="d-flex justify-content-between align-items-center w-100">
        <div
          class="d-flex justify-content-between align-items-center"
          style="width: calc( 100% - 50px );"
        >
          <span class="font-weight-bold" style="width: 150px;">Name</span>
          <span class="font-weight-bold mx-3" style="width: calc( 100% -  350px );">Decription</span>
          <span class="font-weight-bold" style="width: 150px;">Link</span>
        </div>
        <span class="font-weight-bold">Actions</span>
      </b-list-group-item>
      <CategoryItem
        v-for="category in this.categoriesList"
        :category="category"
        target="confirmDelete"
        :key="category.id"
        @confirm="confirm"
        :style="listview ? '' : 'max-height:300px; width: 400px; overflow:hidden;'"
        textstyle="max-height:100px; overflow:hidden;"
        :class=" listview ? '' : 'my-3'"
      />
    </b-list-group>

    <b-card-group
      columns
      v-if="this.categoriesList.length && !this.listview"
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
