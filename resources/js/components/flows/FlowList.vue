<template>
  <div class="custom-scroll overflow-auto" style="max-height: 100%;">
    <b-list-group v-if="this.flowsList.length && this.listview">
      <b-list-group-item class="d-flex justify-content-between align-items-center w-100">
        <div
          class="d-flex justify-content-between align-items-center"
          style="width: calc( 100% - 50px );"
        >
          <span class="font-weight-bold" style="width: 20%;">Name</span>
          <span class="font-weight-bold" style="width: 10%;">Amount</span>
          <span class="font-weight-bold" style="width: 30%;">Description</span>
          <span class="font-weight-bold" style="width: 10%;">Type</span>
          <span class="font-weight-bold" style="width: 10%;">Frequency</span>
          <span class="font-weight-bold text-center" style="width: 20%;">Category</span>
        </div>
        <span class="font-weight-bold">Actions</span>
      </b-list-group-item>
      <FlowItem
        v-for="flow in this.flowsList"
        articleStyle="max-height: 280px; overflow: auto;"
        :flow="flow"
        target="confirmDelete"
        :key="flow.id"
        @confirm="confirm"
        :style=" listview ? '' : 'max-height:600px; width: 400px;'"
        :class="listview ? '' : 'my-3'"
      />
    </b-list-group>

    <b-card-group
      columns
      v-if="this.flowsList.length && !this.listview"
      class="p-3 custom-scroll ovarflow-auto"
      style="max-height: 100%;"
    >
      <FlowItem
        v-for="flow in this.flowsList"
        articleStyle="max-height: 280px; overflow: auto;"
        :flow="flow"
        target="confirmDelete"
        :key="flow.id"
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
      title="Delete Flow"
      @ok="destroy()"
      class="border-0 border-light shadow-sm"
    >
      <template v-slot:default="{ ok, cancel}">
        <p class="lead mt-2 mb-3">The flow will be permenently deleted.</p>
        <div class="ml-auto w-100 d-flex justify-content-end">
          <b-button variant="danger" class="mr-2" style="min-width:70px;" @click.stop="ok()">OK</b-button>
          <b-button variant="outline-none" class="text-danger" @click.stop="cancel()">Cancel</b-button>
        </div>
      </template>
    </b-modal>
  </div>
</template>

<script>
import FlowItem from "./FlowItem";
export default {
  name: "FlowList",
  components: {
    FlowItem
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
    flowsList: function() {
      return this.proplist || this.flowList;
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
      this.destroyFlow(this.id);
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
