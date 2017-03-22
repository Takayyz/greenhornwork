
<?php
//日報の日付をstringからdatetimeに変換
 $reporting_time = date("Y-m-d", strtotime($report->reporting_time));
 ?>

@extends('layouts.app')

@section('content')
<div class="container">
  <p class="pull-right"><a href="{{ url('user/report') }}">一覧に戻る</a></p>
  <div class="panel-heading">
    <h2>日報詳細・編集</h2>
  </div>
  <div class="panel-body">
    {!! Form::open(['url' => ['user/report', $report->id], 'method' => 'PUT']) !!}
      <div class="form-group @if(!empty($errors->first('date'))) has-error @endif">
        {{ Form::input('date', 'date', $reporting_time, ['class' => 'form-control']) }}
        <span class="help-block">{{$errors->first('date')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('title'))) has-error @endif">
        {!! Form::input('text', 'title', $report->title, ['class' => 'form-control', 'placeholder' => 'Title']) !!}
        <span class="help-block">{{$errors->first('title')}}</span>
      </div>
      <div class="form-group @if(!empty($errors->first('contents'))) has-error @endif">
        {!! Form::textarea('contents', $report->contents, ['class' => 'form-control', 'placeholder' => '本文']) !!}
        <span class="help-block">{{$errors->first('contents')}}</span>
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div>
</div>
@endsection
