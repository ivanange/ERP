<template>
  <div class="d-flex justtify-content-end custom p-1 mr-1">
    <span class="d-inline-block mr-auto lead">{{article.product.name}}</span>
    <span class="d-inline-block text-center lead" style="width: 50px;">{{article.qte}}</span>
    <!--     <span class="d-inline-block text-right lead" style="width: 100px;">{{total}}</span> -->
    <span class="lead" @click="close" v-if="deleteButton">
      <font-awesome-icon class="ml-5" icon="minus-circle" style="color: var(--red);" />
    </span>
  </div>
</template>

<script>
export default {
  name: "Article",
  props: {
    article: {
      type: Object,
      required: true,
      default: function() {
        return {};
      }
    },
    deleteButton: {
      type: Boolean,
      default: true
    }
  },
  computed: {
    total: function() {
      return (this.article.product.price * this.article.qte).toFixed(2);
    }
  },
  methods: {
    close() {
      this.$emit("remove", this.article.product.id);
      this.$destroy();
    }
  },
    beforeDestroy() {
    this.$el.parentNode.removeChild(this.$el);
  }
};
</script>

<style lang="scss" scoped>
.custom .lead {
  font-size: 1.21rem;
}
</style>
