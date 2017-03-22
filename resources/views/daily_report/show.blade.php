@extends('layouts.app')

@section('content')
<div class="container">
  <p class="pull-right"><a href="{{ url('user/report') }}">一覧に戻る</a></p>
  <div class="panel-heading">
    <h2>日報詳細</h2>
  </div>
  <div class="panel-body">
      <div>
        <h3>日付</h3>
        {{ date("Y/m/d", strtotime($report->reporting_time)) }}
      </div>
      <div>
        <h3>タイトル</h3>
        {{ $report->title }}
      </div>
      <div>
        <h3>本文</h3>
        {{ $report->contents }}
      </div>
  </div>
  <p class="pull-right"><a class="btn btn-primary" href="{{ $report->id }}/edit">編集</a></p>
</div>
@endsection
