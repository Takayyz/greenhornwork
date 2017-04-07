@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2>日報詳細</h2>
  </div>
  <div class="panel-body">
      <div>
        <h3>日付</h3>
        {{ date("Y/m/d", strtotime($report->reporting_time)) }}
      </div>
      <div>
        <h3>氏名</h3>
         {{ $report->user->info->last_name }} {{ $report->user->info->first_name }}
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
</div>
<div class="col-xs-12 col-md-offset-5">
    <a href="{{ route('admin.report.index') }}" class="btn btn-primary">戻る</a>
</div>
@endsection
