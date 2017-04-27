@extends('partials.admin_nav')

@section('content')

<h2 class="page-header header-gradient">日報検索</h2>

<div class="container">
<div class="search-box">
  <div class="inner-box">
    {!! Form::open(['route' => 'admin.report.index', 'method' => 'GET']) !!}
      <div class="bottom-button-wrapper">
      <a class="button delete-margin" href="#openModal">日報を検索</a>  
      </div>
    {!! Form::close() !!}


<div id="openModal" class="modalDialog">
  <div>
    <a href="#close" title="Close" class="close">X</a>
    <table class="search-table">
      <thead class="search-thead">
      </thead>
      <div class="modal-header">日報を検索</div>
      <tbody class="search-tbody">
          <td class="search-td">
            <label>
              名前
            </label>
          </td>
          <td class="search-td">
          </td>
          <td class="search-td">
            {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '名字', 'id' => 'last_name']) !!}
          </td>
          <td class="search-td">
          </td>
          <td class="search-td">
            {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前', 'id' => 'first_name']) !!} 
          </td>
        </tr>

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

      <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
          <div class="search-buton-wrapper">
          {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
          </div>
          </td>
        </tr>
      </tfoot>
    </table>
  {!! Form::close() !!}
  </div>
</div>


  </div>
</div>
<table class="table table-hover todo-table">


<div class="col-md-offset-5">
</div>
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
</div>
</div>
</table>
</div>
  <div class="bottom-button-wrapper">
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
  </div>
</div>
@endsection
