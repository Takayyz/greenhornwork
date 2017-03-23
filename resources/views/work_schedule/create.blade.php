@extends('layouts.app')

@section('content')
<div class="container">
  <h2 class="page-header">勤怠アップロード</h2>
  {!! Form::open(['url' => 'user/upload', 'method' => 'post', 'files' => 'true']) !!}

    <div class="form-group @if(!empty($errors->first('schedule'))) has-error @endif">
      {!! Form::input('file', 'schedule', null, ['required', 'class' => 'form-control']) !!}
      <span class="help-block">{{ $errors->first('schedule') }}</span>
    </div>
    <button type="submit" class="btn btn-success pull-right">追加</button>
  {!! Form::close() !!}
</div>
@endsection
