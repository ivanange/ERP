<template>
  <div>
    <div class="d-flex justtify-content-end mt-0">
      <span class="ml-auto"></span>
      <span
        class="text-secondary font-weight-bold"
        style="width: 50px;"
        :class="{'mr-1' : this.deleteButton }"
      >Qte</span>
      <span class="ml-5 pl-2" v-if="deleteButton"></span>
    </div>
    <slot></slot>
    <hr />
    <div class="d-flex justtify-content-end">
      <span class="mr-auto text-secondary font-weight-bold">Total</span>
      <span class="text-secondary font-weight-bolder mr-2">{{total+" "+this.currency}}</span>
    </div>
  </div>
</template>

<script>
export default {
  name: "ArticleWrapper",
  props: {
    total: {
      type: String,
      required: true
    },
    deleteButton: {
      type: Boolean,
      default: true
    }
  }
};
</script>

<style lang="scss" >
</style>
