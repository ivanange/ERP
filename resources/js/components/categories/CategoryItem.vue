<template>
  <div>
    <b-list-group-item
      class="d-flex justify-content-between align-items-center w-100"
      v-if="listview && !force"
      :to="{ name:'ShowCategory', params: { propCategory: category, id: category.id } }"
    >
      <div
        class="d-flex justify-content-between align-items-center"
        style="width: calc( 100% - 50px );"
      >
        <span style="width: 150px;">{{this.category.name}}</span>
        <span
          class="text-truncate mx-3"
          style="width: calc( 100% -  350px );"
        >{{this.category.desc}}</span>
        <router-link
          :to="{path: 'products', query:{ category: category.id} }"
          class="text-dark"
          style=" width: 150px;"
          :id="category.id"
          @click.stop
        >Show products</router-link>
      </div>
      <font-awesome-icon
        class="d-inline-block mr-4 text-muted font-weight-lighter"
        icon="times"
        size="lg"
        style="cursor:pointer; "
        @click.stop="$emit('confirm', category.id)"
      />
    </b-list-group-item>

    <b-card
      class="shadow-sm h-100"
      @click.stop.prevent="$router.push({ name:'ShowCategory', params: { propCategory: category, id: category.id } })"
      v-else
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
        >Show products</router-link>
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
    },
    force: {
      type: Boolean,
      default: false
    }
  },
  data: function() {
    return {};
  }
};
</script>

<style lang="scss" scoped>
</style>
