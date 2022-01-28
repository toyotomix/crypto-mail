/* global chartData */

import Chart from 'chart.js/auto';
import { chartOptions } from './chart-options';
import 'chartjs-adapter-moment';

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.labels,
        datasets: [{
            // label: 'My First Dataset',
            data: chartData.data,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            lineTension: 0,
            spanGaps: true,
            pointRadius: 0,
            pointHitRadius: 10,
        }]
    },
    options: chartOptions,

});
