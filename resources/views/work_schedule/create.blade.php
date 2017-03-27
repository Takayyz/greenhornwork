@extends('partials.user_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>勤務表アップロード</h2>
  </div>
  <p class="pull-right"><a href="{{ url('schedule') }}">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['url' => 'schedule', 'method' => 'post', 'files' => 'true']) !!}
      <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
        {!! Form::label('year', '年'); !!}
        {!! Form::selectRange('year', date('Y'), date('Y')+20, old('year', date('Y'))) !!}
        <span class="help-block">{{ $errors->first('year') }}</span>

      </div>
        <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
          {!! Form::label('month', '月'); !!}
          {!! Form::selectRange('month', 1, 12, date('m')) !!}
          <span class="help-block">{{ $errors->first('month') }}</span>
        </div>

      <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
        {!! Form::file('schedule', null, ['required', 'class' => 'form-control']) !!}
        <span class="help-block">{{ $errors->first('schedule') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
