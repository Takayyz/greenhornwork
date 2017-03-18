@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
        <div class="panel-heading">
          <h2>勤務表</h2>
        </div>
        <div class="panel-body">
          {!! Form::open(['' => '']) !!}
            <div class="form-group">
              {!! Form::input('month', 'date',  null, ['required', 'class' => 'form-control']) !!}
              {!! Form::input('file', 'schedule', null, ['required', 'class' => 'form-control']) !!}
            </div>
            <button type="submit" class="btn btn-success pull-right">追加</button>
          {!! Form::close() !!}
        </div>
        <div class="panel-heading">
          <h2>日報</h2>
        </div>
        <div class="panel-body">
          {!! Form::open(['route' => 'report.store']) !!}
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
    </div>
  </div>
</div>
@endsection
