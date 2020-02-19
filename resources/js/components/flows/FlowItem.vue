<template>
  <div>
    <b-list-group-item
      class="d-flex justify-content-between align-items-center w-100"
      v-if="listview && !force"
      @click.stop="$router.push({ name:'ShowFlow', params: { propFlow: flow, id: flow.id } })"
    >
      <div
        class="d-flex justify-content-between align-items-center"
        style="width: calc( 100% - 50px );"
      >
        <span style="width: 20%;" class="pr-2">{{this.flow.name}}</span>
        <span style="width: 10%;" class="pr-2">{{this.amount}}</span>
        <span style="width: 30%;">{{this.flow.desc}}</span>
        <span style="width: 10%;">{{this.type}}</span>
        <span style="width: 10%;">{{this.frequency}}</span>
        <span
          class="text-center"
          style="width: 20%;"
        >{{this.flow.category ? flow.category.name : ''}}</span>
      </div>
      <font-awesome-icon
        class="d-inline-block mr-4 text-muted font-weight-lighter"
        icon="times"
        size="lg"
        style="cursor:pointer; "
        @click.stop="$emit('confirm', flow.id)"
      />
    </b-list-group-item>

    <b-card
      :id="flow.id"
      class="shadow-sm h-100"
      @click.stop.prevent="$router.push({ name:'ShowFlow', params: { propFlow: flow, id: flow.id } })"
      v-else
    >
      <b-card-body :title="this.flow.name">
        <b-card-sub-title class="my-2">
          <span class="font-weight-normal d-block mb-2" v-if="flow.category">{{flow.category.name}}</span>
          <small class="font-weight-normal d-block mb-2 text-runcate">{{flow.desc}}</small>
        </b-card-sub-title>
        <b-card-text class="mt-3 mb-2">
          <h6 class="my-2 text-dark" v-if="flow.amount">
            Amount:
            <span class="font-weight-normal text-muted">{{amount}}</span>
          </h6>
          <h6 class="my-2 text-dark" v-if="flow.frequency">
            Frequency:
            <span class="font-weight-normal text-muted">{{frequency}}</span>
          </h6>
          <h6 class="text-muted mt-3">{{type}}</h6>
        </b-card-text>
        <div class="ml-auto w-100 d-flex justify-content-end">
          <b-button
            :to="{ name:'EditFlow', params: { propFlow: flow, id: flow.id } }"
            variant="dark"
            class="mr-2"
            style="min-width:70px;"
            @click.stop
          >Edit</b-button>
          <b-button variant="outline-danger" @click.stop="$emit('confirm', flow.id)">Delete</b-button>
        </div>
      </b-card-body>
    </b-card>
  </div>
</template>

<script>
import { DateTime } from "luxon";
export default {
  name: "FlowItem",
  props: {
    flow: {
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
    amount: function() {
      return this.flow.amount ? this.flow.amount + " " + this.currency : "";
    },
    frequency: function() {
      return this.flow.frequency
        ? "each " + this.flow.frequency.replace("+", "")
        : "";
    },
    type: function() {
      return this.flow.type == 1 ? "Cash in" : "Cash out";
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
