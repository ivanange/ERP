<template>
  <div class="d-flex bg-light flex-column m-3 font-weight-light text-secondary w-100 py-3">
    <div class="time-filter d-flex justify-content-center align-items-center">
      From
      <datetime
        class="mx-2"
        id="from"
        type="date"
        v-model="fromDate"
        title="Start date"
        placeholder="Start date"
        input-class="border rounded  pl-2"
        input-style="width: 200px; height: 40px;"
      ></datetime>to
      <datetime
        class="mx-2"
        id="to"
        type="date"
        v-model="toDate"
        title="End date"
        placeholder="End date"
        input-class="border rounded  pl-2"
        input-style="width: 200px; height: 40px;"
      ></datetime>
    </div>
    <div class="charts d-flex justify-content-center align-items-center my-2">
      <div class="cash-flow w-100 d-flex flex-column justify-content-center align-items-center">
        <LineChart :chart-data="cashFlowChart.data" :options="cashFlowChart.options" class="w-75" />
        <div class="charts d-flex mt-3">
          <span class="mr-5">Total Cash In: {{totalIns.toFixed(4) + " " + currency}}</span>
          <span class="mr-5">Total Cash Out: {{totalOuts.toFixed(4) + " " + currency}}</span>
          <span>
            Total Benefits:
            <span
              :class="totalBenefits > 0 ? 'text-success' : 'text-danger'"
            >{{totalBenefits.toFixed(4) + " " + currency}}</span>
          </span>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import LineChart from "./LineChart.js";
import { DateTime, Interval } from "luxon";

/*
show filter Cash-Flows, sales, workers
produce charts : ( with time filter )
for benefits ( cash-in - cash-out) axes y: amount, x: time , line
for sales axes y: amount, x: time , line
for cash ins and outs without category axes y: amount, x: time , line
for each flow category axes y: amount, x: category,  bar & pie
for each product ( amount sold ) y: amount, x: product, bar & pie
for each department axes y: amount, x: category,  bar & pie
for each worker ( amount spent ) y: amount, x: product, bar & pie

*/
export default {
  name: "AccountingStats",
  title: "Stats",
  components: {
    LineChart
  },
  data() {
    return {
      fromDate: DateTime.utc()
        .startOf("year")
        .toISODate(),
      toDate: DateTime.utc().toISODate(),
      options: { responsive: true, maintainAspectRatio: false }
    };
  },
  computed: {
    from() {
      return DateTime.fromISO(this.fromDate);
    },
    to() {
      return DateTime.fromISO(this.toDate);
    },
    interval() {
      return Interval.fromDateTimes(this.from, this.to);
    },

    commands() {
      return this.deliveredCommands.filter(command =>
        this.interval.contains(this.setupDate(command.deliveryDate))
      );
    },

    sales() {
      return this.commands.map(command => ({
        amount: command.total,
        created_at: command.deliveryDate
      }));
    },

    totalSales() {
      return this.commands.reduce((total, el) => (total += el.total), 0);
    },
    flows() {
      return this.dues.filter(due =>
        this.interval.contains(this.setupDate(due.created_at))
      );
    },
    inFlows() {
      return this.flows.filter(flow => this.isIn(flow));
    },
    outFlows() {
      return this.flows.filter(flow => !this.isIn(flow));
    },

    ins() {
      return this.sales.concat(this.inFlows);
    },

    outs() {
      return this.outFlows;
    },
    totalIns() {
      return this.ins.reduce(
        (total, ins) => (total += parseFloat(ins.amount)),
        0
      );
    },

    totalOuts() {
      return this.outs.reduce(
        (total, out) => (total += parseFloat(out.amount)),
        0
      );
    },

    totalBenefits() {
      return this.totalIns - this.totalOuts;
    },

    cashInData() {
      return {
        label: "Cash In",
        data: this.ins
          .sort(this.sort)
          .map(el => ({ x: el.created_at, y: el.amount })),
        backgroundColor: "rgba(255, 99, 132, 0.2)",
        borderColor: "rgba(255, 99, 132, 1)",
        borderWidth: 1
      };
    },

    cashOutData() {
      return {
        label: "Cash Out",
        data: this.outs
          .sort(this.sort)
          .map(el => ({ x: el.created_at, y: el.amount })),
        backgroundColor: "rgba(55, 9, 112, 0.2)",
        borderColor: "rgba(55, 9, 112, 1)",
        borderWidth: 1
      };
    },
    cashFlowChart() {
      return {
        data: {
          datasets: [this.cashInData, this.cashOutData]
        },
        options: {
          ...this.options,
          title: {
            display: true,
            text: "Cash Flow"
          },
          scales: {
            xAxes: [
              {
                scaleLabel: {
                  display: true,
                  labelString: "Time"
                },
                type: "time",
                time: {
                  unit:
                    this.interval.length("year") >= 2
                      ? "year"
                      : this.interval.length("year") >= 0.5
                      ? "quarter"
                      : this.interval.length("month") >= 2
                      ? "month"
                      : this.interval.length("week") >= 2
                      ? "week"
                      : "day"
                }
              }
            ],
            yAxes: [
              {
                scaleLabel: {
                  display: true,
                  labelString: "Amount in " + this.currency
                }
              }
            ]
          }
        }
      };
    }
  },
  methods: {
    isIn(due) {
      return due.dueable_type.toLowerCase().indexOf("worker") !== -1
        ? false
        : due.dueable.type === 1;
    },
    sort(a, b) {
      return this.setupDate(a.created_at) < this.setupDate(b.created_at)
        ? -1
        : 1;
    }
  }
};
</script>

<style lang="scss" scoped>
</style>
