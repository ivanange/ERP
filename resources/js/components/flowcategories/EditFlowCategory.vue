<template>
  <ModalWrapper
    :state="true"
    :id="this.$route.params.id"
    @closed="$router.push('/accounting/flowcategories')"
  >
    <StoreCategory
      :propCategory="propCategory"
      :id="this.$route.params.id"
      @saved="$router.push('/accounting/flowcategories')"
      :categoryType="'FlowCategory'"
    />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "../categories/StoreCategory";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "EditFlowCategory",
  components: {
    StoreCategory,
    ModalWrapper
  },
  props: ["propCategory"],
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
