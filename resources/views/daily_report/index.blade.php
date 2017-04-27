@extends('partials.user_nav')

@section('content')
<h2 class="page-header header-gradient">日報一覧</h2>
<div class="container">
  <div class="panel-body">
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
      <td><a class="btn btn-success" href="report/{{ $report->id }}">詳細</a></td>
    </tr>
    @endforeach
  </tbody>
</table>
</div>
<div class="col-md-offset-5">
    <a href="{{ route('admin.') }}" class="button">ホーム画面に戻る</a>
</div>
@endsection
