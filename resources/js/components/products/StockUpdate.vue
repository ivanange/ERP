
<template>
  <div>
    <ModalWrapper :state="true" @closed="$router.push('/stock/products')">
      <b-form @submit.prevent="save">
        <div class="m">
          <h5 class="mb-2">Products</h5>
          <b-form-group v-if="Object.keys(this.products).length">
            <div
              v-for="item in Object.keys(this.products).map(id => ({ id: id, name: this.getProduct(id).name, qte: this.products[id] }))"
              :key="item.id"
              class="d-flex justtify-content-center custom p-1 mr-1"
            >
              <span class="d-inline-block mr-5 lead w-50">{{item.name}}</span>
              <span class="d-inline-block text-center lead" style="width: 50px;">{{item.qte}}</span>
              <span class="lead" @click="remove(item.id)">
                <font-awesome-icon class="ml-5" icon="minus-circle" style="color: var(--red);" />
              </span>
            </div>
          </b-form-group>
        </div>

        <b-input-group prepend="Add product" @keyup.enter.stop="add" class="mt-3">
          <b-input-group-prepend>
            <v-select
              v-model="productId"
              :options="productOptionlist"
              :reduce="selected => selected.value"
              placeholder="Product"
              class="custom"
              style="min-width: 300px;"
            ></v-select>
          </b-input-group-prepend>
          <b-form-input
            class
            id="quantity"
            v-model="qte"
            type="number"
            min="1"
            placeholder="Qte"
            style="max-width:100px;"
          ></b-form-input>

          <b-input-group-append>
            <b-button variant="dark" class="my-0 py-0" @click.stop="add">Add</b-button>
          </b-input-group-append>
        </b-input-group>

        <div class="d-flex justify-content-end mt-4 mb-1">
          <b-button type="submit" class="mr-2" variant="dark" style="min-width:70px;">Save</b-button>
        </div>
      </b-form>
    </ModalWrapper>
  </div>
</template>

<script>
import ModalWrapper from "../ModalWrapper";
export default {
  name: "StockUpdate",
  components: {
    ModalWrapper
  },
  data: function() {
    return {
      show: false,
      products: {},
      qte: 1,
      productId: null
    };
  },
  computed: {
    productOptionlist: {
      get: function() {
        return this.productList.map(el => ({
          value: el.id,
          label: el.name
        }));
      },
      set: function(val) {
        return;
      }
    }
  },
  methods: {
    add() {
      if (this.productId && this.qte) {
        this.$set(this.products, this.productId, this.qte);
        this.productId = null;
        this.qte = 1;
      }
    },
    remove(id) {
      this.$delete(this.products, id);
    },
    save() {
      if (Object.keys(this.products).length) {
        this.massUpdate(this.products);
        this.$router.push('/stock/products');
      }
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
