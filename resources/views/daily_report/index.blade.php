@extends('layouts.app')

@section('content')
<div class="container">
<h2 class="page-header">日報一覧</h2>

<div class="search-box">
  <div class="inner-box">
    {!! Form::open(['route' => 'report.index', 'method' => 'GET']) !!}
      {!! Form::input('date', 'start-date', null, ['class' => 'search-box__input-date']) !!}
      から　
      {!! Form::input('date', 'end-date', null, ['class' => 'search-box__input-date']) !!}
      まで　
      {!! Form::input('submit', '', '日報検索', ['class' => 'btn btn-primary btn-sm']) !!}
    {!! Form::close() !!}
  </div>
</div>

<p class="pull-right"><a class="btn btn-success" href="{{ route('report.create') }}">作成</a></p>
<table class="table table-hover todo-table">
  <thead>
  <tr>
    <th>日付</th>
    <th>タイトル</th>
    <th></th>
    <th></th>
  </tr>
  </thead>
  <tbody>
    @foreach($reports as $report)
    <tr>
      <td>{{ date("Y/m/d", strtotime($report->reporting_time)) }}</td>
      <td>{{ $report->title }}</td>
      <td><a class="btn btn-primary" href="report/{{ $report->id }}">詳細</a></td>
      <td>
        {!! Form::open(['route' => ['report.destroy', $report->id], 'method' => 'DELETE']) !!}
          <button class="btn btn-danger" type="submit">削除</button>
        {!! Form::close() !!}
      </td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
