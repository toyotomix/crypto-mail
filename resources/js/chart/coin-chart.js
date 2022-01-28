/* global chartData */

import Chart from 'chart.js/auto';
import { options } from './chart-options';

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
            // tension: 0,
            pointRadius: 0,
            pointHitRadius: 15
        }]
    },
    options // オプション
});
