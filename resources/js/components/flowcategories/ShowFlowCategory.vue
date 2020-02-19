<template>
  <div class="custom-modal">
    <ModalWrapper
      style=" background-color: transparent;"
      :state="true"
      :id="this.$route.params.id"
      classes="custom-content"
      @closed="$router.push('/accounting/flowcategories')"
    >
      <div
        class="border-0 d-flex justify-content-center align-items-center w-100"
        style=" background-color: transparent;"
      >
        <FlowCategoryItem
          :category="category"
          v-if="category"
          :force="true"
          class="shadow"
          style="width: 500px;"
          articleStyle="max-height: calc(100vh - 350px); overflow: auto;"
        />
      </div>
    </ModalWrapper>
  </div>
</template>

<script>
import FlowCategoryItem from "./FlowCategoryItem";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "ShowFlowCategory",
  components: {
    FlowCategoryItem,
    ModalWrapper
  },
  props: ["propCategory"],
  computed: {
    category: function() {
      return this.propCategory || this.getFlowCategory(this.$route.params.id);
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
