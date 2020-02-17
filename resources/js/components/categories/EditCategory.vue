<template>
  <ModalWrapper :state="true" :id="this.$route.params.id" @closed="$router.push('/stock/categories')">
    <StoreCategory :propCategory="propCategory" :id="this.$route.params.id" @saved="$router.push('/stock/categories')" />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "./StoreCategory";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "EditCategory",
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
