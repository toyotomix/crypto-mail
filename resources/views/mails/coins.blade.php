<p>--------------------------------------<br>
暗号通貨 価格配信サービス<br>
--------------------------------------</p>
@foreach ($coins as $coin)
    <p>
        ●{{$coin->name}}<br>
        価格：&yen;{{ number_format($coin->current_price) }}<br>
        変動率(24H)：{{ $coin->price_change_percentage_24h }}%<br>
        最高値(24H)：&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->high_24h, 10)) }}<br>
        最低値(24H)：&yen;{{ preg_replace("/\.?0+$/", "", number_format($coin->low_24h, 10)) }}<br>
        市場価格：&yen;{{ number_format($coin->market_cap) }}<br>
    </p>
@endforeach