@extends('partials.admin_nav')

@section('content')
<div class="container">
<h2 class="page-header">日報一覧</h2>
<div class="col-xs-10">
</div>
<div class="col-xs-2">
    <a href="{{ route('admin.') }}" class="btn btn-primary ">戻る</a>
</div>

<div class="search-box">
  <div class="inner-box">
    {!! Form::open(['route' => 'admin.report.index', 'method' => 'GET']) !!}
      <h3>日報検索</h3>
      <div class="col-xs-12">
        <div class="col-xs-1">
          苗字
        </div>
        <div class="col-xs-3">
          {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字']) !!}
        </div>
        <div class="col-xs-1">
          名前
        </div>
        <div class="col-xs-3">
          {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前']) !!}
        </div>
      </div>

      <div class="col-xs-12">
        <div class="col-xs-1">
          始め
        </div>
        <div class="col-xs-3">
          {!! Form::input('date', 'start-date', null, ['class' => 'form-control']) !!}　
        </div>　
        <div class="col-xs-1">
          終わり
        </div>
        <div class="col-xs-3">
          {!! Form::input('date', 'end-date', null, ['class' => 'form-control']) !!}　
        </div>
      </div>

      <div class="col-xs-9"></div>
      <div class="col-xs-3">
        {!! Form::input('submit', '', '検索', ['class' => 'btn btn-primary']) !!}
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
