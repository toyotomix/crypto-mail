@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <!--<div class="text-center">-->
            
        <!--</div>-->
    @endif
    @include('coins.index')
@endsection