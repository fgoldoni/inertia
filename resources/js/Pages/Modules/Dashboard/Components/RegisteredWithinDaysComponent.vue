<template>
    <div class="relative w-full h-full overflow-auto">
        <Chart :options="chartOptions"></Chart>
    </div>
</template>

<script setup>
import {Chart} from 'highcharts-vue'
import {onMounted, ref} from "vue";
import moment from 'moment'

const props = defineProps({
    data: Object,
});

const chartOptions = ref({
    chart: {
        type: 'line'
    },
    title: {
        text: 'Daily Registered Users'
    },
    xAxis: {
        type: 'datetime',
    },
    yAxis: {
        title: {
            text: 'Users'
        }
    },
    series: [{
        name: 'Users',
        data: []
    }]
})

const generateData =  (items) => {
    let data = []
    items.forEach((item, index) => {
        data.push([moment(item.date, 'YYYY-MM-DD').utc(+1).valueOf(), item.items_count])
    })
    return data
}

onMounted(() => {
    chartOptions.value.series[0].data = generateData(props.data.users)
})

</script>

<style scoped>

</style>
