<template>
  <div>
    <b-list-group-item
      class="d-flex justify-content-between align-items-center w-100"
      v-if="listview && !force"
      :to="{ name:'ShowCommand', params: { propCommand: command, id: command.id } }"
    >
      <div
        class="d-flex justify-content-between align-items-center"
        style="width: calc( 100% - 50px );"
      >
        <span style="width: 20%;">{{this.command.name}}</span>
        <span style="width: 20%;">{{this.issueDate}}</span>
        <span style="width: 20%;">{{this.command.deliveryDate ? deliveryDate : "" }}</span>
        <span style="width: 20%;">{{this.status.text}}</span>
        <span style="width: 20%;">{{this.total}}</span>
      </div>
      <font-awesome-icon
        class="d-inline-block"
        style="cursor:pointer;"
        size="lg"
        icon="print"
        title="print invoice"
        @click.stop="print"
      />
      <font-awesome-icon
        class="d-inline-block ml-4 text-muted font-weight-lighter"
        icon="times"
        size="lg"
        style="cursor:pointer; "
        @click.stop="$emit('confirm', command.id)"
      />
    </b-list-group-item>
    <b-card
      :id="command.id"
      :title="this.command.name"
      class="shadow-sm h-100"
      @click.stop.prevent="$router.push({ name:'ShowCommand', params: { propCommand: command, id: command.id } })"
      v-else
    >
      <b-card-sub-title class="my-2">
        <small
          class="font-weight-normal d-block mb-2"
        >{{`${this.lang =="en" ? "Issued on " : "Crée le "} ${this.issueDate}`}}</small>
        <small
          class="font-weight-normal text-muted d-block ml-auto"
          v-if="this.command.deliveryDate"
        >{{`${this.lang =="en" ? "Delivered on " : "Livré le "} ${deliveryDate}`}}</small>
      </b-card-sub-title>
      <div class="articles mb-3 mt-2" v-if="Object.keys(this.command.articles).length">
        <ArticleWrapper :total="total" :deleteButton="false">
          <div class="custom-scroll" :style="articleStyle">
            <Article
              v-for="article in Object.values(this.command.articles)"
              :article="article"
              :key="article.product.id"
              :deleteButton="false"
            />
          </div>
        </ArticleWrapper>
      </div>
      <b-card-text class="mb-1">
        <span
          :id="'no-print-color'+command.id"
          class="d-inline-block ml-2"
          style=" height:10px; width:10px; border-radius: 50%; box-shadow: 0px 0px 3px 1px; position:relative; bottom:-1px;"
          :style="{color: this.status.color, backgroundColor: this.status.color}"
        ></span>
        <small class="text-muted">{{status.text}}</small>
      </b-card-text>
      <div
        class="ml-auto w-100 d-flex justify-content-end d-print-none mb-0"
        :id="'no-print'+command.id"
      >
        <font-awesome-icon
          class="d-inline-block mr-auto mt-3 text-secondary"
          style="cursor:pointer;"
          icon="print"
          title="print invoice"
          @click.stop="print"
        />
        <b-button
          :to="{ name:'EditCommand', params: { propCommand: this.command, id: this.command.id } }"
          variant="dark"
          class="mr-2"
          style="min-width:70px;"
          @click.stop
        >Edit</b-button>
        <b-button variant="outline-danger" @click.stop="$emit('confirm', command.id)">Delete</b-button>
      </div>
    </b-card>
  </div>
</template>

<script>
import Article from "./Article";
import ArticleWrapper from "./ArticleWrapper";
import { DateTime } from "luxon";
import PrinJS from "print-js";
export default {
  name: "CommandItem",
  components: {
    Article,
    ArticleWrapper
  },
  props: {
    command: {
      type: Object,
      required: true
    },
    articleStyle: {
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
    status: function() {
      if (this.lang) {
      }
      var code = this.command.status;
      var [text, color] =
        code == this.ENSTATUS.ONGOING
          ? [this.getStatusText(code), "var(--warning)"]
          : code == this.ENSTATUS.DELIVERED
          ? [this.getStatusText(code), "var(--success)"]
          : [this.getStatusText(code), "var(--danger)"];

      return {
        text: text,
        color: color
      };
    },
    issueDate: function() {
      return this.setupDate(this.command.issueDate).toLocaleString(
        DateTime.DATETIME_MED
      );
    },

    deliveryDate: function() {
      return this.command.deliveryDate
        ? this.setupDate(this.command.deliveryDate).toLocaleString(
            DateTime.DATETIME_MED
          )
        : null;
    }
  },
  methods: {
    notify() {
      this.$emit("confirm", this.command.id);
    },
    print() {
      printJS({
        printable: this.command.id,
        type: "html",
        header: "ERP",
        headerStyle:
          "font-weight: 500; font-size: 24px; padding-bottom: 0px; margin-bottom: 7px; text-align: center;",
        scanStyles: true,
        targetStyle: [
          "font-family",
          "display",
          "font-weight",
          "line-height",
          "color",
          "background-color",
          "flex",
          "justtify-content",
          "align-items",
          "text-align",
          "text-decoration",
          "margin-top",
          "margin-bottom",
          "margin-left",
          "margin-right",
          "padding-top",
          "padding-bottom",
          "padding-left",
          "padding-right",
          "width"
        ],
        targetStyles: ["margin", "padding", "flex"],
        ignoreElements: [
          "no-print" + this.command.id,
          "no-print-color" + this.command.id
        ],
        documentTitle: "Command_" + this.command.id + "_" + Date().toString()
      });
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
