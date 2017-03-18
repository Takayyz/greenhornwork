@extends('layouts.app')

@section('content')
<div class="container">
<h2 class="page-header">日報一覧</h2>
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
      <td><a class="btn btn-primary" href="{{ $report->id }}/edit">詳細</a></td>
      {!! Form::open(['route' => ['report.destroy', $report->id], 'method' => 'DELETE']) !!}
        <td>
          <button class="btn btn-danger" type="submit">削除</button>
        </td>
      {!! Form::close() !!}
    </tr>
    @endforeach
  </tbody>
</table>
</div>
@endsection
