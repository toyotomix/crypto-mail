@if (count($coins) > 0)
    <ul class="list-unstyled list-group mb-3">
        {{-- ヘッダ --}}
        <li class="list-group-item">
            <div class="container">
                <div class="row">
                    <div class="col-md-1 text-right">#</div>
                        {{-- サムネイル／通貨名 --}}
                        <div class="col-md-4">通貨</div>
                        {{-- 現在の価格 --}}
                        <div class="col-md-2 text-right">価格</div>
                        {{-- 価格変動率（24h） --}}
                        <div class="col-md-2 text-center">変動率(24h)</div>
                        {{-- 時価総額 --}}
                        <div class="col-md-3">時価総額</div>
                </div>
            </div>
        </li>
        {{-- 通貨一覧 --}}
        @foreach ($coins as $coin)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            {{ $coin['market_cap_rank'] }}
                        </div>
                        {{-- サムネイル／通貨名 --}}
                        <div class="col-md-4 font-weight-bold">
                            <img class="rounded" src="{{ $coin['image'] }}" alt="" width="30" height="30">
                            {{-- strtoupper($coin['name']) --}}
                            {{ $coin['name'] }}
                        </div>
                        {{-- 現在の価格 --}}
                        <div class="col-md-2 text-right">
                            &yen;{{ $coin['current_price'] }}
                        </div>
                        {{-- 価格変動率（24h） --}}
                        @if ($coin['price_change_percentage_24h'] < 0)
                            {{-- マイナスの場合、赤 --}}
                            <div class="col-md-2 text-danger text-center">
                                {{ $coin['price_change_percentage_24h'] }}%
                            </div>
                        @else
                            {{-- プラスの場合、グリーン --}}
                            <div class="col-md-2 text-success text-center">
                                {{ $coin['price_change_percentage_24h'] }}%
                            </div>
                        @endif
                        {{-- 時価総額 --}}
                        <div class="col-md-3">
                            &yen;{{ $coin['market_cap'] }}
                        </div>
                    </div>
                </div>
                {{--<div class="media-body">
                    <div>
                        {!! link_to_route('users.show', $micropost->user->name, ['user' => $micropost->user->id]) !!}
                        <span class="text-muted">posted at {{ $micropost->created_at }}</span>
                    </div>
                    <div>
                        <p class="mb-0">{!! nl2br(e($micropost->content)) !!}</p>
                    </div>
                </div>--}}
            </li>
        @endforeach
    </ul>
    <div class="d-flex justify-content-center">
        {{-- ページネーションのリンク --}}
        {{ $coins->links() }}    
    </div>
@endif