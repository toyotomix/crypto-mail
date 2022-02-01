@if (Auth::check())
    @if (Auth::user()->is_alerts($coin->id))
        {{-- 登録ボタンのフォーム --}}
        {!! Form::open(['route' => ['alerts.unalert', $coin->id], 'method' => 'delete']) !!}
            {!! Form::submit('解除', ['class' => "btn btn-danger btn-lg btn-block"]) !!}
        {!! Form::close() !!}
    @else
        {{-- 解除ボタンのフォーム --}}
        {!! Form::open(['route' => ['alerts.alert', $coin->id]]) !!}
            {!! Form::submit('メール配信', ['class' => "btn btn-success btn-lg btn-block"]) !!}
        {!! Form::close() !!}
    @endif
@endif
