<template>
  <ModalWrapper :state="true" @closed="$router.push('/stock/categories')">
    <StoreCategory @saved="$router.push('/stock/categories')" />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "./StoreCategory";
import ModalWrapper from "../ModalWrapper";

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
