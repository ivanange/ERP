import {
    Line,
    mixins
} from "vue-chartjs";
const {
    reactiveProp
} = mixins;

export default {
    name: "LineChart",
    extends: Line,
    mixins: [reactiveProp],
    props: ["options"],
    watch: {
        options: {
            handler: function () {
                if (this.$data._chart) {
                    this.$data._chart.destroy();
                }

                this.renderChart(this.chartData, this.options);
            },
            deep: true,
            immediate: true,
        }
    },
    mounted() {
        // this.chartData is created in the mixin.
        // If you want to pass options please create a local options object
        this.renderChart(this.chartData, this.options);
    }
};
