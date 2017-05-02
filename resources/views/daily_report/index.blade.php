@extends('partials.user_nav')

@section('content')
<h2 class="page-header header-gradient">日報一覧</h2>
<div class="search-box">
  <div class="inner-box">
      <div class="button-wrapper">
      <a class="button" href="#openModal">日報を検索</a> 
      <a class="button" href="{{ route('report.create') }}">作成</a> 
      </div>

<div id="openModal" class="modalDialog">
  <div>
  {!! Form::open(['route' => 'report.index', 'method' => 'GET']) !!}
    <a href="#close" title="Close" class="close">X</a>
    <table class="search-table">
      <thead class="search-thead">
      </thead>
      <div class="modal-header">日報検索</div>
      <tbody class="search-tbody">
    <td class="search-td">
         <label>
          始め
        　</label>
        </td>
        <td class="search-td">
        </td>
        <td class="search-td">
          {!! Form::input('date', 'start-date', null, ['class' => 'form-control']) !!}　
        </td>　
        <td class="search-td">
        <label>
          終わり
        </label>
        </td>
        <td class="search-td">
          {!! Form::input('date', 'end-date', null, ['class' => 'form-control']) !!}　
        </td>
      </tbody>

      <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
          <div class="bottom-button-wrapper">
          {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
          </div>
          </td>
        </tr>
      </tfoot>
    </table>
  {!! Form::close() !!}
  </div>
</div>

<div class="content-wrapper">
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
</div>
<div class="col-md-offset-5">
    <a href="{{ route('admin.home') }}" class="button">ホームへ</a>
</div>
@endsection
