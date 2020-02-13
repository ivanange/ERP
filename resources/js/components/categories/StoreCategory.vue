<template>
  <div
    class="main-container d-flex justify-content-center align-items-center flex-column custom-scroll"
  >
    <b-form @submit.prevent="save" v-if="show" action="/categories" method="post">
      <h2 class="mb-3">Category</h2>

      <b-form-group label="Name">
        <b-form-input
          id="name"
          v-model="category.name"
          :state="category.name && category.name.length > 0"
          type="text"
          placeholder="Category name"
          class="my-2"
          style="width: 400px; height: 40px;"
          required
        ></b-form-input>
      </b-form-group>
      <b-form-group label="Description">
        <b-form-textarea
          id="textarea"
          v-model="category.desc"
          :state="category.desc && category.desc.length <= 1000"
          placeholder="Category description"
          rows="3"
          max-rows="6"
        ></b-form-textarea>
      </b-form-group>
      <div class="d-flex justify-content-end mt-4 mb-5">
        <b-button type="submit" class="mr-2" variant="info" style="min-width:70px;">Save</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  name: "StoreCategory",
  props: {
    id: {
      type: Number | String,
      default: null
    },
    propCategory: {
      type: Object,
      default: function() {
        return {
          id: null,
          name: null,
          desc: null
        };
      }
    }
  },
  data: function() {
    return {
      category: this.propCategory,
      show: true,
      edit: false,
      setup: false
    };
  },
  computed: {},
  methods: {
    save() {
      this[this.action](this.category);
      this.$emit("saved");
    },
    setupCategory() {
      if (!this.setup) {
        let category = this.getCategory(this.id);
        if (category) {
          this.category = category || this.category;
          this.setup = true;
        }
        return category;
      }
    }
  },

  created: function() {
    if (this.id || this.propCategory.id) {
      this.edit = true;
      this.$store.watch(
        (state, getters) => state.loaded,
        () => {
          if (this.loaded && !this.propCategory.id) {
            if (this.setupCategory()) {
            } else {
              this.$router.push("/categories");
            }
          }
        },
        { immediate: true, deep: true }
      );
      this.setupCategory();
    }
    this.action = (this.edit ? "update" : "create") + "Category";
  }
};
</script>

<style lang="scss" scoped>
</style>
