@extends('partials.admin_nav')

@section('content')

  <h1 class="brand-header">日報一覧</h1>
  <div class="btn-wrapper">
    <a class="btn" href="#openModal">日報を検索</a>  
  </div>

  <div id="openModal" class="modalDialog">
    <div>
      {!! Form::open(['route' => 'admin.report.index', 'method' => 'GET']) !!}
        <a href="#close" title="Close" class="close">X</a>
        <table class="search-table">
          <thead class="search-thead">
          </thead>
          <div class="modal-header">日報検索</div>
          <tbody class="search-tbody">
            <tr>
              <td class="search-td">
                <label>
                  氏名
                </label>
              </td>
              <td class="search-td"></td>
              <td class="search-td">
                {!! Form::input('text', 'last_name', null, ['class' => 'form-control', 'placeholder' => '苗字', 'id' => 'last_name']) !!}
              </td>
              <td class="search-td"></td>
              <td class="search-td">
                {!! Form::input('text', 'first_name', null, ['class' => 'form-control', 'placeholder' => '名前', 'id' => 'first_name']) !!} 
              </td>
            </tr>
            
            <td class="search-td">
              <label>
                始め
          　  </label>
            </td>
            <td class="search-td"></td>
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
              <td colspan="5" class="search-td  hello">
                <div class="bottom-btn-wrapper">
                  {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success']) !!}
                </div>
              </td>
            </tr>
          </tfoot>
        </table>
      {!! Form::close() !!}
    </div>
  </div><!-- modal closing tag -->

  <div class="content-wrapper text-align">
    <table class="table table-hover todo-table">
      <thead>
        <tr>
          <th>苗字</th>
          <th>名前</th>
          <th>日付</th>
          <th>タイトル</th>
        </tr>
      </thead>
      <tbody>
        @foreach($reports as $report)
          <tr>
            <td>{{ $report->user->info->last_name }}</td>
            <td>{{ $report->user->info->first_name }}</td>
            <td>{{ date("Y/m/d", strtotime($report->reporting_time)) }}</td>
            <td>{{ $report->title }}</td>
            <td><a class="btn btn-success" href="{{ route('admin.report.show', $report->id) }}">詳細</a></td>
          </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <div class="bottom-btn-wrapper">
    <a href="{{ route('admin.home') }}" class="bottom-button">ホームへ</a>
  </div>

@endsection
