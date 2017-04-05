@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">日報一覧</h2>
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
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.') }}" class="btn btn-primary ">戻る</a>
</div>
@endsection
