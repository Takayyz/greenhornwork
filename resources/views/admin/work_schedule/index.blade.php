<?php

$month = [];
for ($i = 1; $i <=12; $i++) {
  array_push( $month, $i);
}
$month = [];

 ?>

@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2 class="page-header">勤務表一覧</h2>
  </div>

  <!-- 検索メニュー -->
  <div class="col-xs-12">
    <div>
      {!! Form::open(['route' => 'admin.schedule.search', 'method' => 'GET']) !!}
        <div class="col-xs-2">
          {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year', date('Y'))) !!}
          {!! Form::label('year', '年'); !!}
        </div>
        <div class="col-xs-2">
          {!! Form::selectRange('month', 1, 12,  old('month', date('m'))) !!}
          {!! Form::label('month', '月'); !!}
        </div>
        <div class="col-xs-3">
          {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字']) !!}
        </div>
        <div class="col-xs-3">
          {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
        </div>
        {!! Form::input('submit', '', '検索', ['class' => 'btn btn-primary btn-sm']) !!}
      {!! Form::close() !!}
    </div>
  </div>

  <div class="panel-body">
    <table class="table table-hover todo-table">
      <thead>
      <tr>
        <th></th>
        <th>氏名</th>
        <th>店舗名</th>
      </tr>
      </thead>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>
            <a href="../{{ $schedule->file_path . $schedule->file_name }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td>{{ $schedule->user->info->last_name }} {{ $schedule->user->info->first_name }}</td>
          <td>{{ $schedule->user->info->store->name }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.') }}" class="btn btn-primary">戻る</a>
</div>
@endsection
