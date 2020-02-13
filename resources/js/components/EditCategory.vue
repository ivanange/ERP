<template>
  <ModalWrapper :state="true" :id="this.$route.params.id" @closed="$router.push('/categories')">
    <StoreCategory :propCategory="propCategory" :id="this.$route.params.id" @saved="$router.push('/categories')" />
  </ModalWrapper>
</template>

<script>
import StoreCategory from "./categories/StoreCategory";
import ModalWrapper from "./ModalWrapper";

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
