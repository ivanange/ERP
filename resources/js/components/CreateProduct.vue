<template>
  <ModalWrapper :state="true"  @closed="$router.push('/products')">
    <StoreProduct @saved="$router.push('/products')"/>
  </ModalWrapper>
</template>

<script>
import StoreProduct from "./products/StoreProduct";
import ModalWrapper from "./ModalWrapper";

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
