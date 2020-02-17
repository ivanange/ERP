<template>
  <ModalWrapper :state="true" :id="this.$route.params.id" @closed="$router.push('/stock/commands')">
    <StoreCommand :propCommand="propCommand" :id="this.$route.params.id" @saved="$router.push('/stock/commands')" />
  </ModalWrapper>
</template>

<script>
import StoreCommand from "./StoreCommand";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "EditCommand",
  components: {
    StoreCommand,
    ModalWrapper
  },
  props: ["propCommand"],
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
