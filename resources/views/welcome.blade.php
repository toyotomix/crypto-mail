@extends('layouts.app')

@section('content')
    @if (Auth::check())
        {{ Auth::user()->name }}
    @else
        <div class="text-center">
            <h1>Welcome!!</h1>
        </div>
    @endif
@endsection