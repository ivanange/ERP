<template>
  <ModalWrapper
    :state="true"
    :id="this.$route.params.id"
    @closed="$router.push('/accounting/flows')"
  >
    <StoreFlow
      :propFlow="propFlow"
      :id="this.$route.params.id"
      @saved="$router.push('/accounting/flows')"
    />
  </ModalWrapper>
</template>

<script>
import StoreFlow from "./StoreFlow";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "EditFlow",
  components: {
    StoreFlow,
    ModalWrapper
  },
  props: ["propFlow"],
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
