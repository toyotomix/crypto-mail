/* global prices */

import Chart from 'chart.js/auto';
import moment from 'moment';

// チャートデータ取得
const chartData = getChartData();

const ctx = document.getElementById('myChart').getContext('2d');
const myChart = new Chart(ctx, {
    type: 'line',
    data: {
        labels: chartData.labels,
        datasets: [{
            // label: 'My First Dataset',
            data: chartData.datas,
            fill: false,
            borderColor: 'rgb(75, 192, 192)',
            // tension: 0,
            pointRadius: 0,
            pointHitRadius: 15
        }]
    },
    options: {
        animation: {
            duration: 0, // 一般的なアニメーションの時間
        },
        hover: {
            animationDuration: 0, // アイテムのマウスオーバー時のアニメーションの長さ
        },
        responsiveAnimationDuration: 0, // サイズ変更後のアニメーションの長さ
        //ツールチップの設定
        tooltips: {
            displayColors: false
        },
        plugins: {
            legend: { // 凡例の非表示
                display: false
            }
        },
        scalse: {
            xAxes: [{
                ticks: {
                    autoSkip: true,
                    maxTicksLimit: 4, //値の最大表示数
                    maxRotation: 0, //下のと合わせて表示される角度を決める
                    minRoation: 0 //横幅を最小にしたときに縦に表示される
                }
            }]
        }
    }

});

function getChartData() {
    const labels = [];
    for (let i = 0; i < prices.length; i++) {
        let date = moment(prices[i].created_at);
        labels.push(date.format('HH:mm'));
    }

    const datas = [];
    for (let i = 0; i < prices.length; i++) {
        datas.push(prices[i].price);
    }
    // 'created_at'で降順ソートされているため、逆にする
    labels.reverse();
    datas.reverse();
    
    return {
        labels: labels,
        datas: datas
    }
}
