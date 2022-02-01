@extends('layouts.app')

@section('content')
    {{-- ナビゲーション --}}
    @include('commons.nav')
    <div class="d-flex align-items-center mb-3">
        {{-- アイコン --}}
        <div class="mr-2">
            <img src="{{ $coin->image }}" alt="" width="30" height="30">
        </div>
        {{-- 通貨名 --}}
        <div>
            <h3 class="mb-0">{{ $coin->name }}</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{-- チャートグラフ --}}
            <div class="col-md-7">
                <h3 class="text-center">価格チャート(24H)</h3>
                @include('coins.chart')
            </div>
            {{-- 通貨詳細テーブル --}}
            <div class="col-md-5">
                <h3 class="text-center">情報</h3>
                @include('coins.table')
            </div>
        </div>
    </div>
    <div class="d-flex justify-content-center">
        {{-- 配信登録／解除 --}}
        <div class="mr-3">
            @include('alerts.alerts_button')
        </div>
    </div>
@endsection