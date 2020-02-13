<template>
  <div
    class="main-container d-flex justify-content-center align-items-center flex-column custom-scroll"
  >
    <b-form @submit.prevent="serialize" v-if="show" action="/products" method="post">
      <h2 class="mb-3">Product</h2>
      <b-form-input
        id="name"
        v-model="product.name"
        type="text"
        placeholder="Product name"
        class="my-2"
        style="width: 400px; height: 40px;"
      ></b-form-input>
      <div class="d-flex mt-2">
        <b-form-group label="Price">
          <b-form-input
            id="price"
            v-model="product.price"
            type="number"
            step="0.01"
            :placeholder="'Price in '+currency"
            style=" height: 40px;"
            :state="product.price == null || product.price > 0"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Weight" class="mx-2">
          <b-form-input
            id="weight"
            v-model="product.weight"
            type="number"
            step="0.01"
            placeholder="Weight"
            style=" height: 40px;"
            :state="product.weight == null || product.weight > 0"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Quantity">
          <b-form-input
            id="qte"
            v-model="product.qte"
            type="number"
            step="1"
            placeholder="Quantity"
            style=" height: 40px;"
          ></b-form-input>
        </b-form-group>
      </div>
      <b-form-group label="Expire date">
        <datetime
          id="expireDate"
          type="datetime"
          v-model="product.expireDate"
          title="Expirey date"
          placeholder="Expirey date"
          input-class="border rounded  pl-2"
          input-style="width: 200px; height: 40px;"
        ></datetime>
      </b-form-group>
      <b-form-group label="Manufacturer" class="mb-2">
        <v-select
          v-model="product.manufacturer"
          :options="manufacturers"
          placeholder="Manufacturer"
          class="custom"
          style="min-width: 300px;"
        ></v-select>
      </b-form-group>
      <b-form-group label="Category" class="mb-2">
        <v-select
          v-model="product.category_id"
          :options="categoryList.map(el => ({label: el.name, value: el.id }))"
          :reduce="el => el.value"
          placeholder="Category"
          class="custom"
          style="min-width: 300px;"
        ></v-select>
      </b-form-group>
      <b-form-file v-model="file" accept="image/*" class="mt-3"></b-form-file>
      <div class="d-flex justify-content-end mt-3 mb-2">
        <b-button type="submit" class="mr-2" variant="info" style="min-width:70px;">Save</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
import { DateTime } from "luxon";

export default {
  name: "StoreProduct",
  props: {
    id: {
      type: Number | String,
      default: null
    },
    propProduct: {
      type: Object,
      default: function() {
        return {
          id: null,
          name: "",
          price: null,
          weight: null,
          qte: null,
          expireDate: undefined,
          manufacturer: "",
          image: null,
          category_id: null
        };
      }
    }
  },
  data: function() {
    return {
      product: this.propProduct,
      show: true,
      edit: false,
      setup: false,
      imageLoaded: false,
      data: {}
    };
  },
  watch: {
    imageLoaded: function() {
      if (this.imageLoaded) {
        this.save();
      }
    }
  },
  computed: {
    file: {
      get: function() {
        return null;
      },
      set: function(val) {
        this.product.image = val;
      }
    }
  },
  methods: {
    save() {
      this[this.action](this.data);
      this.$emit("saved");
    },
    serialize() {
      //console.log(this.product.image);
      this.data = this.product;
      if (this.product.image && typeof this.product.image != "string") {
        let reader = new FileReader();
        reader.addEventListener(
          "load",
          () => {
            this.product.image = reader.result;
            this.data = this.product;
            this.imageLoaded = true;
          },
          false
        );
        reader.readAsDataURL(this.product.image);
      } else {
        this.imageLoaded = true;
      }
    },
    setupDates() {
      if (this.edit) {
        this.product.expireDate = this.product.expireDate
          ? this.setupDate(this.product.expireDate).toISO()
          : "";
      }
    },
    setupProduct() {
      if (!this.setup) {
        let product = this.getProduct(this.id);
        if (product) {
          this.product = product || this.product;
          this.product.image = !isNaN(parseInt(this.product.image))
            ? null
            : this.product.image;
          this.setupDates();
          this.setup = true;
        }
        return product;
      }
    }
  },

  created: function() {
    if (this.id || this.propProduct.id) {
      this.edit = true;
      this.$store.watch(
        (state, getters) => state.loaded,
        () => {
          if (this.loaded && !this.propProduct.id) {
            if (this.setupProduct()) {
            } else {
              this.$router.push("/products");
            }
          }
        },
        { immediate: true, deep: true }
      );
      this.setupProduct();
    }
    this.action = (this.edit ? "update" : "create") + "Product";
  }
};
</script>

<style lang="scss" scoped>
</style>
