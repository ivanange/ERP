<template>
  <div class="custom-modal">
    <ModalWrapper
      style=" background-color: transparent;"
      :state="true"
      :id="this.$route.params.id"
      classes="custom-content"
      @closed="$router.push('/accounting/flows')"
    >
      <div
        class="border-0 d-flex justify-content-center align-items-center w-100"
        style=" background-color: transparent;"
      >
        <FlowItem
          :flow="flow"
          v-if="flow"
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
import FlowItem from "./FlowItem";
import ModalWrapper from "../ModalWrapper";

export default {
  name: "ShowFlow",
  components: {
    FlowItem,
    ModalWrapper
  },
  props: ["propFlow"],
  computed: {
    flow: function() {
      return this.propFlow || this.getFlow(this.$route.params.id);
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
