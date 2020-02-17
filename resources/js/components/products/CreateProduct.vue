<template>
  <ModalWrapper :state="true" @closed="$router.push('/stock/products')">
    <StoreProduct @saved="$router.push('/stock/products')" />
  </ModalWrapper>
</template>

<script>
import StoreProduct from "./StoreProduct";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "CreateProduct",
  components: {
    StoreProduct,
    ModalWrapper
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
