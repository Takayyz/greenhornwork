@extends('partials.user_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>勤務表更新</h2>
  </div>
  <p class="pull-right"><a href="{{ route('schedule.index') }}">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['route' => ['schedule.update', $schedule->id], 'method' => 'put' , 'files' => 'true']) !!}
      <div class="form-group {{ Session::has($errors->first('year')) ? 'has-error' :'' }}">
        {!! Form::label('year', '年'); !!}
        {!! Form::selectRange('year', date('Y'), date('Y')+20, $schedule->year ) !!}
        <span class="help-block">{{ $errors->first('year') }}</span>
      </div>
      <div class="form-group {{ Session::has($errors->first('month')) ? 'has-error' :'' }}">
        {!! Form::label('month', '月'); !!}
        {!! Form::selectRange('month', 1, 12, $schedule->month ) !!}
        <span class="help-block">{{ $errors->first('month') }}</span>
      </div>
      @if (Session::has('flash_message'))
        <div class="has-error">
          <span class="help-block">{{ Session('flash_message') }}</span>
        </div>
      @endif
      <div class="form-group">
        <span class="help-block">※勤務表の変更が不要な場合はファイルを選択する必要はありません</span>
      </div>
      <div class="form-group {{ Session::has($errors->first('schedule')) ? 'has-error' :'' }}">
        {!! Form::file('schedule', null) !!}
        <span class="help-block">{{ $errors->first('schedule') }}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
