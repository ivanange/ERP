<template>
  <div
    class="main-container d-flex justify-content-center align-items-center flex-column custom-scroll"
  >
    <b-form @submit.prevent="save" v-if="show" action="/commands" method="post">
      <h2 class="mb-3">Command</h2>
      <b-form-input
        id="name"
        v-model="command.name"
        type="text"
        placeholder="Optional command name"
        class="my-2"
        style="width: 400px; height: 40px;"
      ></b-form-input>

      <div class="d-flex">
        <b-form-group label="Issue date" label-class="mb-0">
          <datetime
            id="issueDate"
            type="datetime"
            v-model="issueDateF"
            title="Issue date"
            placeholder="Issue date"
            readonly
            input-class="border rounded my-2 mr-3 pl-1"
            input-style="width: 200px; height: 40px;"
          ></datetime>
        </b-form-group>
        <b-form-group
          label="Delivery date"
          label-class="mb-0"
          v-if="command.status != this.ENSTATUS.ONGOING"
        >
          <datetime
            id="deliveryDate"
            type="datetime"
            v-model="command.deliveryDate"
            title="Delivery date"
            placeholder="Delivery date"
            input-class="border rounded my-2  pl-2"
            input-style="width: 200px; height: 40px;"
            :required="command.status != this.ENSTATUS.ONGOING"
          ></datetime>
        </b-form-group>
      </div>

      <b-form-group class="mb-4 mt-2" label-class="font-weight-bold text-secondary">
        <label class="font-weight-bold text-secondary">
          <h5 class="mb-0">Status</h5>
        </label>
        <b-form-radio-group
          variant="secondary"
          class="custom-radio"
          v-model="command.status"
          name="status"
          :options="statuses"
        ></b-form-radio-group>
      </b-form-group>
      <div class="my-4">
        <b-form-group id="articles" v-if="Object.values(this.command.articles).length">
          <label class="font-weight-bold text-secondary mb-0">
            <h5 class="mb-0">Articles</h5>
          </label>
          <ArticleWrapper :total="total">
            <div class="custom-scroll overflow-auto" style="max-height: calc(100vh - 650px);">
              <Article
                v-for="article in Object.values(this.command.articles)"
                :article="article"
                :key="article.product.id"
                @remove="remove($event)"
              />
            </div>
          </ArticleWrapper>
        </b-form-group>
      </div>

      <b-input-group prepend="Add article" @keyup.enter.stop="add" class="mt-3">
        <b-input-group-prepend>
          <v-select
            v-model="article.product"
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
          :max="max"
          placeholder="Qte"
          style="max-width:100px;"
        ></b-form-input>

        <b-input-group-append>
          <b-button variant="info" class="my-0 py-0" @click.stop="add">Add</b-button>
        </b-input-group-append>
      </b-input-group>

      <div class="d-flex justify-content-end mt-4 mb-1">
        <b-button type="submit" class="mr-2" variant="info" style="min-width:70px;">Save</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
import Article from "./Article";
import ArticleWrapper from "./ArticleWrapper";
import { DateTime } from "luxon";

export default {
  name: "StoreCommand",
  components: {
    Article,
    ArticleWrapper
  },
  props: {
    id: {
      type: Number | String,
      default: null
    },
    propCommand: {
      type: Object,
      default: function() {
        return {
          id: null,
          name: "",
          issueDate: DateTime.utc().toISO(),
          deliveryDate: DateTime.utc().toISO(),
          status: 1,
          articles: {}
        };
      }
    }
  },
  data: function() {
    return {
      article: { product: {}, qte: 1 },
      command: this.propCommand,
      show: true,
      edit: false,
      setup: false
    };
  },
  computed: {
    total: function() {
      return Object.values(this.command.articles)
        .reduce(
          (acc, val) =>
            (acc += parseInt(val.product.price) * parseInt(val.qte)),
          0
        )
        .toFixed(2);
    },
    issueDateF: {
      get: function() {
        return this.command.issueDate;
      },
      set: function(val) {
        return;
      }
    },
    productOptionlist: {
      get: function() {
        return this.availableProductsList.map(el => ({
          value: el,
          label: `${el.name} : ${el.price} ${this.currency}`
        }));
      },
      set: function(val) {
        return;
      }
    },
    qte: {
      get: function() {
        return this.article.qte;
      },
      set: function(val) {
        if (this.hasActiveProduct()) {
          return (this.article.qte = this.max >= val ? val : this.max);
        }
      }
    },
    max: function() {
      return this.hasActiveProduct()
        ? this.$store.state.products[this.article.product.id].qte
        : 1;
    }
  },
  methods: {
    add() {
      if (Object.values(this.article.product).length && this.article.qte) {
        this.$set(this.command.articles, this.article.product.id, {
          product: this.article.product,
          qte: this.article.qte
        });
        this.article = { product: {}, qte: 1 };
      }
    },
    hasActiveProduct() {
      return Object.keys(this.article.product || {}).length;
    },
    remove(id) {
      this.$delete(this.command.articles, id);
    },
    save() {
      if (this.validate()) {
        let data = this.serialize();
        this[this.action](data);
        this.$emit("saved");
      }
    },
    validate() {
      return (
        Object.keys(this.command.articles).length &&
        (this.command.deliveryDate
          ? DateTime.fromISO(this.command.deliveryDate) >=
            DateTime.fromISO(this.command.issueDate)
          : true)
      );
    },
    serialize() {
      return {
        ...this.command,
        articles: Object.keys(this.command.articles).reduce((acc, key) => {
          acc[key] = { qte: this.command.articles[key].qte };
          return acc;
        }, {})
      };
    },
    setupDates() {
      if (this.edit) {
        this.command.issueDate = this.command.issueDate
          ? this.setupDate(this.command.issueDate).toISO()
          : "";

        this.command.deliveryDate = this.command.deliveryDate
          ? this.setupDate(this.command.deliveryDate).toISO()
          : "";
      }
    },
    setupCommand() {
      if (!this.setup) {
        let command = this.getCommand(this.id);
        if (command) {
          this.command = command || this.command;
          this.setupDates();
          this.setup = true;
        }
        return command;
      }
    }
  },

  created: function() {
    if (this.id || this.propCommand.id) {
      this.edit = true;
      this.$store.watch(
        (state, getters) => state.loaded,
        () => {
          if (this.loaded && !this.propCommand.id) {
            if (this.setupCommand()) {
            } else {
              this.$router.push("/commands");
            }
          }
        },
        { immediate: true, deep: true }
      );
      this.setupCommand();
    }
    this.action = (this.edit ? "update" : "create") + "Command";
  }
};
</script>

<style lang="scss" scoped>
</style>
