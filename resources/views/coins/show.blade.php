@extends('layouts.app')

@section('content')
    <div class="d-flex align-items-center mb-3">
        <div class="mr-2">
            {{-- アイコン --}}
            <img src="{{ $coin->image }}" alt="" width="30" height="30">
        </div>
        <div>
            {{-- 通貨名 --}}
            <h3 class="mb-0">{{ $coin->name }}</h3>
        </div>
    </div>
    <div class="container">
        <div class="row">
            {{-- TODO : チャートグラフ --}}
            <div class="col-md-6">
                @include('coins.chart')
            </div>
            {{-- 通貨詳細テーブル --}}
            <div class="col-md-6">
                @include('coins.table')
            </div>
        </div>
    </div>
@endsection