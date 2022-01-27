<canvas id="myChart" width="500" height="240"></canvas>
<script>
    {{-- 価格データ --}}
    const prices = @json($prices);
</script>
<script src="{{ asset('js/coin-chart.js') }}"></script>
