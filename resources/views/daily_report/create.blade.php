@extends('layouts.app')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>日報</h2>
  </div>
  <p class="pull-right"><a href="{{ url('user/report') }}">一覧に戻る</a></p>
  <div class="panel-body">
    {!! Form::open(['action' => ['DailyReportController@store']]) !!}
      <div class="form-group @if(!empty($errors->first('date'))) has-error @endif">
        {!! Form::input('date', 'date', null, ['class' => 'form-control']) !!}
        <span class="help-block">{{$errors->first('date')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::input('text', 'title', null, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{$errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
        {!! Form::textarea('contents', null, ['class' => 'form-control', 'placeholder' => '本文']) !!}
        <span class="help-block">{{$errors->first('contents')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">追加</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
