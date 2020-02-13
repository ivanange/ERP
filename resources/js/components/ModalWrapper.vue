<template>
  <b-modal
    id="app-modal"
    v-model="on"
    busy
    hide-header
    hide-footer
    centered
    scrollable
    :size="size"
    @hidden="$emit('closed')"
    :content-class="classes"
    class="border-0 border-light shadow-sm"
  >
    <slot></slot>
  </b-modal>
</template>

<script>
export default {
  name: "ModalWrapper",
  props: {
    size: {
      type: String,
      default: "lg"
    },
    state: {
      type: Boolean,
      default: true
    },
    id: {
      type: String | Number
    },
    classes: {
      type: String
    }
  },
  data: function() {
    return {
      on: this.state
    };
  },
  watch: {
    id: function() {
      this.on = true;
    },
    state: function() {
      this.on = true;
    }
  }
};
</script>

<style lang="scss" >
</style>
