<template>
  <div class="custom-modal">
    <ModalWrapper
      style=" background-color: transparent;"
      :state="true"
      :id="this.$route.params.id"
      classes="custom-content"
      @closed="$router.push('/stock/products')"
    >
      <div
        class="border-0 d-flex justify-content-center align-items-center w-100"
        style=" background-color: transparent;"
      >
        <ProductItem
          :product="product"
          v-if="product"
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
import ProductItem from "./ProductItem";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "ShowProduct",
  components: {
    ProductItem,
    ModalWrapper
  },
  props: ["propProduct"],
  computed: {
    product: function() {
      return this.propProduct || this.getProduct(this.$route.params.id);
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
