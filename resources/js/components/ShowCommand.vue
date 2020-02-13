<template>
  <div class="custom-modal">
    <ModalWrapper
      style=" background-color: transparent;"
      :state="true"
      :id="this.$route.params.id"
      classes="custom-content"
      @closed="$router.push('/commands')"
    >
      <div
        class="border-0 d-flex justify-content-center align-items-center w-100"
        style=" background-color: transparent;"
      >
        <CommandItem
          :command="command"
          v-if="command"
          class="shadow"
          style="width: 500px;"
          articleStyle="max-height: calc(100vh - 350px); overflow: auto;"
        />
      </div>
    </ModalWrapper>
  </div>
</template>

<script>
import CommandItem from "./commands/CommandItem";
import ModalWrapper from "./ModalWrapper";

export default {
  name: "ShowCommand",
  components: {
    CommandItem,
    ModalWrapper
  },
  props: ["propCommand"],
  computed: {
    command: function() {
      return this.propCommand || this.getCommand(this.$route.params.id);
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
