<template>
  <div class="d-flex flex-column">
    <form
      action="#searchList.php"
      method="post"
      class="filter-form bg-light py-4 px-3"
      @submit.prevent
    >
      <div class="d-flex justify-content-start align-concent-center px-2">
        <input
          v-model="filters.name"
          class="form-control rounded ml-5"
          type="search"
          placeholder="command name, articles"
          style="max-width: 600px;"
        />
        <b-button variant="light" class="ml-3" v-b-toggle.filters>Filters</b-button>
        <font-awesome-icon
          class="ml-auto mr-3 h2"
          icon="plus-circle"
          style="color: var(--info); cursor:pointer;"
          @click.stop="$router.push('/commands/create')"
        />
      </div>
      <b-collapse id="filters">
        <div class="d-flex justify-content-center align-concent-center mt-3">
          <div class="pl-0 mr-3" style="min-width: 300px;">
            <h4 class="w-100 mb-3">Status</h4>
            <b-form-checkbox-group
              id="statuses"
              class="border-left px-2 py-3"
              v-model="filters.status"
              :options="this.statuses"
              name="statuses"
              stacked
            ></b-form-checkbox-group>
          </div>
          <div class="d-flex flex-column pl-0 ml-3" style="min-width: 300px;">
            <h4 class="w-100 text-center">Custom</h4>
            <div class="formgroup">
              <label for="time" class>Time</label>
              <b-form-select v-model="filters.time" :options="options" placeholder="time interval"></b-form-select>
            </div>
            <div class="form-group mt-3">
              <label for="rating">Total</label>
              <b-form-input
                id="total"
                v-model="filters.total"
                type="range"
                class="custom-range"
                min="0"
                max="15000000"
                step="500"
              ></b-form-input>
            </div>
          </div>
        </div>
      </b-collapse>
    </form>
  </div>
</template>

<script>
import { Interval, DateTime } from "luxon";
import { debounce } from "lodash";
export default {
  name: "CommandSidebar",
  data: function() {
    return {
      filters: {
        name: "",
        status: [],
        time: null,
        total: 1500000000
      },
      result: []
    };
  },
  computed: {
    options: function() {
      let weekStart = DateTime.utc();
      weekStart.set({ weekday: 1 });
      let weekEnd = DateTime.utc();
      weekEnd.set({ weekday: 7 });
      return [
        {
          value: Interval.fromDateTimes(weekStart, weekEnd),
          text: "This week"
        },
        {
          value: Interval.fromDateTimes(
            DateTime.utc().startOf("month"),
            DateTime.utc().endOf("month")
          ),
          text: "This month"
        },
        {
          value: Interval.fromDateTimes(
            DateTime.utc().startOf("year"),
            DateTime.utc().endOf("year")
          ),
          text: "This year"
        }
      ];
    }
  },

  watch: {
    filters: {
      handler: function() {
        this.update();
      },
      deep: true,
      immediate: true
    }
  },

  methods: {
    update: debounce(function() {
      let result = this.search();
      this.$store.commit("setList", result);
    }, 1500),
    search() {
      let searchList =
        !this.filters.status.length || this.filters.status.length == 3
          ? this.commandList
          : [].concat(
              ...this.filters.status.map(el => this.getCommandByStatus(el))
            );

      return searchList.filter(
        command =>
          command.total <= this.filters.total &&
          (this.filters.time
            ? this.filters.time.contains(this.setupDate(command.issueDate))
            : true) &&
          (this.filters.name
            ? command.name &&
              command.name
                .toLowerCase()
                .indexOf(this.filters.name.toLowerCase()) !== -1
            : true)
      );
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
