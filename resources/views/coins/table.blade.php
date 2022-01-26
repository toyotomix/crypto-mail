<table class="table table-secondary">
    <tbody class="font-weight-bold">
        <tr>
            <td>時価総額ランク</td>
            <td class="text-right">{{ $coin->market_cap_rank }}</td>
        </tr>
        <tr>
            <td>市場価格</td>
            <td class="text-right">&yen;{{ number_format($coin->market_cap) }}</td>
        </tr>
        <tr>
            <td>価格</td>
            <td class="text-right">&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->current_price, 10)) }}</td>
        </tr>
        <tr>
            <td>24H最高値 / 最安値</td>
            <td class="text-right">&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->high_24h, 10)) }} / &yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->low_24h, 10)) }}</td>
        </tr>
        <tr>
            <td>過去最高値</td>
            <td class="text-right">&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->ath, 10)) }}</td>
        </tr>
        <tr>
            <td>過去最低値</td>
            <td class="text-right">&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->atl, 10)) }}</td>
        </tr>
    </tbody>
</table>