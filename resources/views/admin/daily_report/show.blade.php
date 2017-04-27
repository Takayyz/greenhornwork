@extends('partials.admin_nav')

@section('content')
<div class="container">
  <div class="panel-heading">
    <h2 class="page-header header-gradient">日報詳細</h2>
  </div>
  <ul class="dailyreport-info-list">
    <li>
     　<div class="profile icon"></div>
      <h3>日付</h3>  
      {{ date("Y/m/d", strtotime($report->reporting_time)) }}
    </li>

    <li>
      <div class="profile icon"></div>
      <h3>氏名</h3> 
      {{ $report->user->info->last_name }} {{ $report->user->info->first_name }}
    </li>

    <li>
      <div class="profile icon"></div>
      <h3>タイトル</h3>
      {{ $report->title }}
    </li>

    <li>
      <div class="profile icon"></div>
      <h3>本文</h3>
      {{ $report->contents }}
    </li>
  <ul>

  </div>
</div>
<div class="col-md-offset-5">
<div class="bottom-button-wrapper">
    <a href="{{ route('admin.report.index') }}" class="bottom-button">日報一覧画面へ</a>
@endsection
