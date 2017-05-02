@extends('partials.admin_nav')

@section('content')

 
    <h2 class="page-header header-gradient">日報詳細</h2>
<div class="container">
  <ul class="dailyreport-info-list">
    
    <li>
      <h3>苗字</h3> 
      {{ $report->user->info->last_name }}
    </li>

    <li>
      <h3>名前</h3>
      {{ $report->user->info->first_name }}
    </li>

    <li>
      <h3>日付</h3>  
      {{ date("Y/m/d", strtotime($report->reporting_time)) }}
    </li>

    <li>
      <h3>タイトル</h3>
      {{ $report->title }}
    </li>

    <li>
      <h3>本文</h3>
      {{ $report->contents }}
    </li>
  <ul>

  </div>
</div>
<div class="bottom-button-wrapper">
    <a href="{{ route('admin.report.index') }}" class="bottom-button">日報一覧画面へ</a>
@endsection
