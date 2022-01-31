export const chartOptions = {
    animation: {
        duration: 0, // 一般的なアニメーションの時間
    },
    hover: {
        animationDuration: 0, // アイテムのマウスオーバー時のアニメーションの長さ
    },
    responsiveAnimationDuration: 0, // サイズ変更後のアニメーションの長さ
    plugins: {
        legend: { // 凡例の非表示
            display: false
        },
        //ツールチップの設定
        tooltip: {
            intersect: true,
            displayColors: false,   // グラフカラーの表示
            callbacks: {
                label: function(context) {
                    let label = context.dataset.label || '';
                    if (label) {
                        label += ': ';
                    }
                    if (context.parsed.y !== null) {
                        // label += new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY'}).format(context.parsed.y);
                        label += '\xA5' + Number(context.parsed.y).toLocaleString();
                    }
                    return label;
                }
            }
        },
    },
    elements: {
        line: {
            tension: 0  // ベジェ曲線を無効にする
        }
    },
    scales: {
        x: {
            type: 'time',
            ticks: {
                maxRotation: 0,
                minRotation: 0
            },
            time: {
                unit: "hour",
                stepSize: 3,    // x軸 3時間きざみ
                displayFormats: {
                    hour: "HH:mm"
                }
            }
        },
        y: {
            ticks: {
                callback: function(value, index, ticks) {
                    return '\xA5' + Number(value).toLocaleString();
                    // return new Intl.NumberFormat('ja-JP', { style: 'currency', currency: 'JPY'}).format(value);
                }
            }
        }
    }
}