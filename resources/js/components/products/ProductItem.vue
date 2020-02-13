<template>
  <div>
    <b-card
      no-body
      :id="product.id"
      class="shadow-sm h-100"
      @click.stop.prevent="$router.push({ name:'ShowProduct', params: { propProduct: product, id: product.id } })"
    >
      <b-row no-gutters>
        <div
          v-if="product.image && isNaN(parseInt(product.image))"
          class="h-100"
          style="width: 200px;"
        >
          <b-card-img :src=" image" class="rounded-0"></b-card-img>
        </div>
        <b-col>
          <b-card-body :title="this.product.name">
            <b-card-sub-title class="my-2">
              <span
                class="font-weight-normal d-block mb-2"
                v-if="product.category"
              >{{product.category.name}}</span>
              <span class="font-weight-normal d-block mb-2">By {{product.manufacturer}}</span>
            </b-card-sub-title>
            <b-card-text class="mt-3 mb-2">
              <h6 class="my-2 text-dark">
                Price:
                <span class="font-weight-normal text-muted">{{price}}</span>
              </h6>
              <h6 class="my-2 text-dark">
                Weight:
                <span class="font-weight-normal text-muted">{{weight}}</span>
              </h6>
              <h6 class="my-2 text-dark">
                Quanity:
                <span class="font-weight-normal text-muted">{{product.qte}}</span>
              </h6>
              <h6 class="text-muted mt-3">{{status}}</h6>
            </b-card-text>
            <div class="ml-auto w-100 d-flex justify-content-end">
              <b-button
                :to="{ name:'EditProduct', params: { propProduct: product, id: product.id } }"
                variant="info"
                class="mr-2"
                style="min-width:70px;"
                @click.stop
              >Edit</b-button>
              <b-button variant="outline-danger" @click.stop="$emit('confirm', product.id)">Delete</b-button>
            </div>
          </b-card-body>
        </b-col>
      </b-row>
    </b-card>
  </div>
</template>

<script>
import { DateTime } from "luxon";
export default {
  name: "ProductItem",
  props: {
    product: {
      type: Object,
      required: true
    },
    articleStyle: {
      type: String,
      default: ""
    }
  },
  data: function() {
    return {};
  },
  computed: {
    price: function() {
      return this.product.price + " " + this.currency;
    },
    weight: function() {
      let weight = this.product.weight;
      return weight < 1000 ? weight + "g" : (weight / 1000).toFixed(2) + "Kg";
    },
    expireDate: function() {
      return this.setupDate(this.product.expireDate).toLocaleString(
        DateTime.DATETIME_MED
      );
    },
    image: function() {
      return typeof this.product.image == "string"
        ? (this.product.image.startsWith("data:") ? "" : "./storage/images/") +
            this.product.image
        : null;
    },

    status: function() {
      let expireDate = this.setupDate(this.product.expireDate);
      let nearlyExpired = DateTime.utc();
      nearlyExpired.plus(this.expiryInterval);
      return expireDate <= DateTime.utc()
        ? "Expired"
        : expireDate <= nearlyExpired
        ? "Nearly expired"
        : "Good";
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
