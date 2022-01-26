@extends('layouts.app')

@section('content')
    <div class="text-fontweight-bold">
        {{ $coin->name }}
    </div>
    <div class="container">
        <div class="row">
            <div class="col-md-6 text-right">
                <img class="rounded" src="{{ $coin->image }}" alt="" width="150" height="150">
            </div>
            <div class="col-md-6 text-left">
                
            </div>
        </div>
    </div>
@endsection