@extends('layouts.app')

@section('content')
<div class="container">
<h2 class="page-header">日報一覧</h2>
<div class="search-box">
  <div class="inner-box">
    {!! Form::open(['route' => 'admin.report.search', 'method' => 'GET']) !!}
      {!! Form::input('date', 'start-date', null, ['class' => 'search-box__input-date']) !!}
      から　
      {!! Form::input('date', 'end-date', null, ['class' => 'search-box__input-date']) !!}
      まで　
      <div class="search-box__name-box">
        性：{!! Form::input('text', 'last_name', null, ['class' => 'search-box__firstname-input', 'placeholder' => '熱田']) !!}
        名：{!! Form::input('text', 'first_name', null, ['class' => 'search-box__firstname-input', 'placeholder' => '亮']) !!}
      </div>
      <div class="search-box__btn-box">
        {!! Form::input('submit', '', '日報検索', ['class' => 'btn btn-primary btn-sm']) !!}
      </div>
    {!! Form::close() !!}
  </div>
</div>
<table class="table table-hover todo-table">
  <thead>
  <tr>
    <th>日付</th>
    <th>氏名</th>
    <th>タイトル</th>
    <th></th>
  </tr>
  </thead>
  <tbody>
    @foreach($reports as $report)
    <tr>
      <td>{{ date("Y/m/d", strtotime($report->reporting_time)) }}</td>
      <td>{{ $report->user->info->last_name }} {{ $report->user->info->first_name }}</td>
      <td>{{ $report->title }}</td>
      <td><a class="btn btn-primary" href="{{ route('admin.report.show', $report->id) }}">詳細</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
