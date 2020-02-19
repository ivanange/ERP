<template>
  <ModalWrapper :state="true" @closed="$router.push('/accounting/categories')">
    <StoreCategory @saved="$router.push('/accounting/flowcategories')" :categoryType="'FlowCategory'" />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "../categories/StoreCategory";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "CreateFlowCategory",
  components: {
    StoreCategory,
    ModalWrapper
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
