@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="page-header">勤怠アップロード</h2>
  {!! Form::open(['url' => 'user/schedule', 'method' => 'post', 'files' => 'true']) !!}
    <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
      {!! Form::input('month', 'time', null, ['class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('schedule') }}</span>
    </div>

    <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
      {!! Form::file('schedule', null, ['required', 'class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('schedule') }}</span>
    </div>
    <button type="submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}
</div>
@endsection
