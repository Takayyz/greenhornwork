@extends('partials.user_nav')

@section('content')
    <h2 class="page-header header-gradient">勤務表更新</h2>
  <div class="container">
  <div class="panel-body">
    {!! Form::open(['route' => ['schedule.update', $schedule->id], 'method' => 'put' , 'files' => 'true']) !!}
      <div class="form-group {{ Session::has('flash_message') ? 'has-error' :''}}">
        {!! Form::label('year', '年'); !!}
        <td class="search-td">
        {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control-custom', 'placeholder'=>'年']) !!}
      </td>
        <span class="help-block">{{ $errors->first('year') }}</span>
      </div>
      <div class="form-group {{ Session::has('flash_message') ? 'has-error' :''}} ">
        {!! Form::label('month', '月'); !!}
        <td class="search-td">
        {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control-custom', 'placeholder'=>'月']) !!}
      </td>
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
      <div class="form-group {{ $errors->has('schedule') ? 'has-error' :''}} ">
        {!! Form::file('schedule', null) !!}
        <span class="help-block">{{ $errors->first('schedule') }}</span>
      </div>
      <div>
        <img src="{{ url($schedule->file_path . $schedule->file_name) }}" alt="" width="350" height="350">
      </div>
      <button type="submit" class="btn btn-success pull-right">更新</button>
    {!! Form::close() !!}
  </div>
</div>
<div class="bottom-button-wrapper">
    <a href="{{ route('schedule.index') }}" class="bottom-button">ホームへ</a>
</div>
@endsection
