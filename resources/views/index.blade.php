@extends('layouts.app')

@section('content')
    {{-- ナビゲーション --}}
    @include('commons.nav')
    {{-- 通貨一覧 --}}
    @include('coins.coins')
@endsection