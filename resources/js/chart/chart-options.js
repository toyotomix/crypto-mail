export const options = {
    animation: {
        duration: 0, // 一般的なアニメーションの時間
    },
    hover: {
        animationDuration: 0, // アイテムのマウスオーバー時のアニメーションの長さ
    },
    responsiveAnimationDuration: 0, // サイズ変更後のアニメーションの長さ
    //ツールチップの設定
    tooltips: {
        // グラフカラー表示
        displayColors: false
    },
    plugins: {
        legend: { // 凡例の非表示
            display: false
        }
    },
    scalse: {
        // X軸
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