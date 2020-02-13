<template>
  <ModalWrapper :state="true" @closed="$router.push('/categories')">
    <StoreCategory @saved="$router.push('/categories')" />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "./categories/StoreCategory";
import ModalWrapper from "./ModalWrapper";

export default {
  name: "CreateCategory",
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
