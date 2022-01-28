@if (Auth::check())
    @if (Auth::user()->is_alerts($coin->id))
        {{-- 登録ボタンのフォーム --}}
        {!! Form::open(['route' => ['alerts.unalert', $coin->id], 'method' => 'delete']) !!}
            {!! Form::submit('解除', ['class' => "btn btn-success btn-sm"]) !!}
        {!! Form::close() !!}
    @else
        {{-- 解除ボタンのフォーム --}}
        {!! Form::open(['route' => ['alerts.alert', $coin->id]]) !!}
            {!! Form::submit('アラート登録', ['class' => "btn btn-secondary btn-sm"]) !!}
        {!! Form::close() !!}
    @endif
@endif
