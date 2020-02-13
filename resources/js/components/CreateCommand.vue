<template>
  <ModalWrapper :state="true"  @closed="$router.push('/commands')">
    <StoreCommand @saved="$router.push('/commands')"/>
  </ModalWrapper>
</template>

<script>
import StoreCommand from "./commands/StoreCommand";
import ModalWrapper from "./ModalWrapper";

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
