<template>
  <div>
    <b-card
      class="shadow-sm h-100"
      @click.stop.prevent="$router.push({ name:'ShowCategory', params: { propCategory: category, id: category.id } })"
    >
      <b-card-text class="h3 truncate" style="color: #023000;">{{this.category.name}}</b-card-text>
      <b-card-text class="my-3" :style="textstyle">{{this.category.desc}}</b-card-text>

      <div class="ml-auto w-100 d-flex justify-content-end mt-3" @click.stop>
        <router-link
          :to="{path: 'products', query:{ category: category.id} }"
          class="text-decoration-none mr-auto text-muted"
          style="text-decoration: none"
          :id="category.id"
          @click.stop
        >Afficher les produits</router-link>
        <font-awesome-icon
          class="d-inline-block mr-4"
          icon="pencil-alt"
          size="lg"
          style="cursor:pointer;"
          @click.stop="$router.push({ name:'EditCategory', params: { propCategory: category, id: category.id } })"
        />

        <font-awesome-icon
          class="d-inline-block mr-0"
          :icon="['far', 'trash-alt']"
          size="lg"
          style="cursor:pointer;"
          @click.stop="$emit('confirm', category.id)"
        />
      </div>
    </b-card>
  </div>
</template>

<script>
export default {
  name: "CategoryItem",
  props: {
    category: {
      type: Object,
      required: true
    },
    textstyle: {
      type: String,
      default: ""
    }
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
