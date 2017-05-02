@extends('partials.user_nav')

@section('content')

  <h2 class="page-header header-gradient">勤務表一覧</h2>

<div class="search-box">
  <div class="inner-box">
  <div class="button-wrapper">
    `<a class="button" href="{{ route('schedule.create') }}">勤務表をアップロード</a>
     <a　class="button" href="#openModal">勤務表を検索</a>
  </div>

  <div id="openModal" class="modalDialog">
  <div>
  {!! Form::open(['route' => 'schedule.index', 'method' => 'GET']) !!}
  <a href="#close" title="Close" class="close">X</a>
    <table class="search-table">
      <thead class="search-thead">
      </thead>
      <div class="modal-header">勤務表を検索</div>
      <tbody class="search-tbody">
      <tr>
          <td class="search-td">
          <label>
              年月
          </label>
          </td>
      <td class="search-td">
        {!! Form::selectRange('year', date('Y')-10, date('Y')+10, old('year'), ['class' => 'form-control', 'placeholder'=>'年']) !!}
      </td>
      <td class="search-td">
        {!! Form::selectRange('month', 1, 12, old('month'), ['class' => 'form-control', 'placeholder'=>'月']) !!}
      </td>
      </<tbody>
      <tfoot class="search-tfoot">
        <tr class="search-tr">
          <td colspan="5" class="search-td">
          <div class="search-button-wrapper">
      {!! Form::input('submit', '', '検索', ['class' => 'btn btn-success btn-sm']) !!}
      </td>
      </tr>
      </tfoot>
    </table>
      {!! Form::close() !!}
</div>
</div>
    
<div class="content-wrapper text-align">
  <table class="table table-hover todo-table">
    <thead><tr>
        <th></th>
        <th></th>
      </tr>
      </thead>
      <tbody>
      <tbody>
        @foreach($schedules as $schedule)
        <tr>
          <td>
            <a href="{{ url($schedule->file_path . $schedule->file_name) }}" target="_blank" >
              {{ $schedule->year }}年
              {{ $schedule->month }}月
              勤務表
            </a>
          </td>
          <td><a class="btn btn-success" href="{{ route('schedule.edit', $schedule->id) }}">変更</a></td>
          <td>
            {!! Form::open(['route' => ['schedule.destroy', $schedule->id], 'method' => 'DELETE']) !!}
              <button class="btn btn-danger" type="submit">削除</button>
            {!! Form::close() !!}
          </td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>
</div>
<div class="bottom-button-wrapper">
    <a href="{{ route('admin.') }}" class="bottom-button">ホームへ</a>
</div>
@endsection
