<template>
  <ModalWrapper :state="true" :id="this.$route.params.id" @closed="$router.push('/products')">
    <StoreProduct :propProduct="propProduct" :id="this.$route.params.id" @saved="$router.push('/products')" />
  </ModalWrapper>
</template>

<script>
import StoreProduct from "./products/StoreProduct";
import ModalWrapper from "./ModalWrapper";

export default {
  name: "EditProduct",
  components: {
    StoreProduct,
    ModalWrapper
  },
  props: ["propProduct"],
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
