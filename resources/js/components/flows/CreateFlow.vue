<template>
  <ModalWrapper :state="true" @closed="$router.push('/accounting/flows')">
    <StoreFlow @saved="$router.push('/accounting/flows')" />
  </ModalWrapper>
</template>

<script>
import StoreFlow from "./StoreFlow";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "CreateFlow",
  components: {
    StoreFlow,
    ModalWrapper
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
