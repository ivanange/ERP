<template>
  <ModalWrapper :state="true"  @closed="$router.push('/stock/commands')">
    <StoreCommand @saved="$router.push('/stock/commands')"/>
  </ModalWrapper>
</template>

<script>
import StoreCommand from "./StoreCommand";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "CreateCommand",
  components: {
    StoreCommand,
    ModalWrapper
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
