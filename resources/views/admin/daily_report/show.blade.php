@extends('layouts.app')

@section('content')
<div class="container">
  <div class="row">
    <div class="col-md-8 col-md-offset-2">
      <div class="panel panel-default">
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
               <!-- 氏名 -->
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
    </div>
  </div>
</div>
@endsection
