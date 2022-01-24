@if (count($coins) > 0)
    <ul class="list-unstyled list-group mb-5">
        @foreach ($coins as $coin)
            <li class="list-group-item">
                <div class="container">
                    <div class="row">
                        <div class="col-md-1 text-right">
                            {{ $coin['market_cap_rank'] }}
                        </div>
                        {{-- サムネイル／通貨名 --}}
                        <div class="col-md-2 font-weight-bold">
                            <img class="rounded" src="{{ $coin['image'] }}" alt="" width="30" height="30">
                            {{ strtoupper($coin['symbol']) }}
                        </div>
                        {{-- 現在の価格 --}}
                        <div class="col-md-3 text-right">
                            {{ $coin['current_price'] }}円
                        </div>
                        {{-- 時価総額 --}}
                        @if ((float) $coin['price_change_percentage_24h'] < 0)
                            <div class="col-md-3 text-danger">
                                {{ $coin['price_change_percentage_24h'] }}%
                            </div>
                        @else
                            <div class="col-md-3 text-success">
                                {{ $coin['price_change_percentage_24h'] }}%
                            </div>
                        @endif
                        
                        {{-- 時価総額 --}}
                        <div class="col-md-3">
                            {{ $coin['market_cap'] }}円
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
    {{-- ページネーションのリンク --}}
    {{--{{ $microposts->links() }}--}}
@endif