<template>
  <div
    class="main-container d-flex justify-content-center align-items-center flex-column custom-scroll"
  >
    <b-form @submit.prevent="save" v-if="show" action="/stock/flows" method="post">
      <h2 class="mb-3">Flow</h2>
      <b-form-input
        id="name"
        v-model="flow.name"
        type="text"
        placeholder="Flow name"
        class="my-2"
        style="width: 400px; height: 40px;"
        required
      ></b-form-input>
      <b-form-group label="Amount">
        <b-form-input
          id="amount"
          v-model="flow.amount"
          type="number"
          step="0.01"
          :placeholder="'Amount in '+currency"
          style=" height: 40px;"
          :state="flow.amount == null || flow.amount > 0"
        ></b-form-input>
      </b-form-group>
      <b-form-group class="mb-4 mt-2" label-class="font-weight-bold text-secondary">
        <label class="font-weight-bold text-secondary">
          <h5 class="mb-0">Type</h5>
        </label>
        <b-form-radio-group
          variant="secondary"
          class="custom-radio"
          v-model="flow.type"
          name="type"
          :options="types"
          required
        ></b-form-radio-group>
      </b-form-group>
      <div class="mt-2">
        <h5 class="w-100 mb-2">Frequency</h5>
        <b-form-group label="Years" class="mx-2">
          <b-form-input
            id="years"
            v-model="years"
            type="number"
            step="1"
            min="0"
            placeholder="0"
            style=" height: 40px; width: 50px;"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Months" class="mx-2">
          <b-form-input
            id="months"
            v-model="months"
            type="number"
            step="1"
            min="0"
            placeholder="0"
            style=" height: 40px; width: 50px;"
          ></b-form-input>
        </b-form-group>
        <b-form-group label="Days" class="mx-2">
          <b-form-input
            id="days"
            v-model="days"
            type="number"
            step="1"
            min="0"
            placeholder="0"
            style=" height: 40px; width: 50px;"
          ></b-form-input>
        </b-form-group>
      </div>

      <b-form-group label="Category" class="mb-2">
        <v-select
          v-model="flow.category_id"
          :options="flowcategoryList.map(el => ({label: el.name, value: el.id }))"
          :reduce="el => el.value"
          placeholder="Category"
          class="custom"
          style="min-width: 300px;"
          required
        ></v-select>
      </b-form-group>
      <b-form-textarea
        id="textarea"
        v-model="flow.desc"
        :state="flow.desc && flow.desc.length <= 1000"
        placeholder="Flow description"
        rows="3"
        max-rows="6"
      ></b-form-textarea>
      <div class="d-flex justify-content-end mt-3 mb-2">
        <b-button type="submit" class="mr-2" variant="dark" style="min-width:70px;">Save</b-button>
      </div>
    </b-form>
  </div>
</template>

<script>
export default {
  name: "StoreFlow",
  props: {
    id: {
      type: Number | String,
      default: null
    },
    propFlow: {
      type: Object,
      default: function() {
        return {
          id: null,
          name: "",
          amount: null,
          type: null,
          frequency: null,
          desc: "",
          category_id: null
        };
      }
    }
  },
  data: function() {
    return {
      flow: this.propFlow,
      show: true,
      edit: false,
      setup: false,
      types: [{ text: "Cash in", value: 1 }, { text: "Cash out", value: 2 }],
      years: null,
      months: null,
      days: null
    };
  },
  computed: {
    frequency() {
      return (
        (this.years != 0 ? " + " + this.years + " years " : "") +
        (this.months != 0 ? " + " + this.months + " months " : "") +
        (this.days != 0 ? " + " + this.days + " days " : "")
      );
    }
  },
  methods: {
    save() {
      this[this.action]({ ...this.flow, frequency: this.frequency });
      this.$emit("saved");
    },
    setupFlow() {
      if (!this.setup) {
        let flow = this.getFlow(this.id);
        if (flow) {
          this.flow = flow || this.flow;
          this.setup = true;
        }
        return flow;
      }
    }
  },

  created: function() {
    if (this.id || this.propFlow.id) {
      this.edit = true;
      this.$store.watch(
        (state, getters) => state.loaded,
        () => {
          if (this.loaded && !this.propFlow.id) {
            if (this.setupFlow()) {
            } else {
              this.$router.push("/stock/flows");
            }
          }
        },
        { immediate: true, deep: true }
      );
      this.setupFlow();
    }
    this.action = (this.edit ? "update" : "create") + "Flow";
  }
};
</script>

<style lang="scss" scoped>
</style>
